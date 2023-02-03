<?php

namespace Drupal\nhsc_cadastro_unico_api;

use Drupal\nhsc_cadastro_unico_api\Controller\SoapController as SoapClient;
use Symfony\Component\HttpKernel\Exception\ServiceUnavailableHttpException;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * Class ApiService.
 */
class ApiService
{

    // API Configuration.
    private $api_config;

    // API Url
    private $url;

    // User profile type
    private $profile_type;

    /**
     * Constructs a new ValidateService object.
     */
    public function __construct()
    {
        $config = \Drupal::config('nhsc_cadastro_unico_api.settings');
        $this->api_config = $config;
        $this->url = $config->get('cadu_url') . '?singleWsdl';

        $uid = \Drupal::currentUser()->id();
        $this->profile_type = \Drupal::service('user.data')->get('nhsc_user_profile', $uid, 'user_profile');
    }

    /**
     * Call a Soap Method.
     *
     * @param string $method Method name to call.
     * @param array $arguments An array of arguments to send to the method.
     * @param string $profile_type The type of user profile to use.
     *
     * @return object An object returned by the method.
     */
    public function call($method, $arguments = null, $profile_type = 'hcp')
    {
        $config = $this->api_config;
        $url = $this->url;
        $response = null;

        use_soap_error_handler('_drupal_exception_handler');

        try {
            $opts = [
                'http' => [
                    'user_agent' => 'PHPSoapClient',
                ],
                'ssl' => [
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true,
                ],
            ];
            $context = stream_context_create($opts);

            $soapClientOptions = array(
                'stream_context' => $context,
                'cache_wsdl' => WSDL_CACHE_NONE,
                'trace' => 1,
                'exception' => 1,
                'connection_timeout' => 5,
            );

            if ($config->get('proxy_enable') == 1) {
                $soapClientOptions['proxy_host'] = $config->get('proxy_host');
                $soapClientOptions['proxy_port'] = $config->get('proxy_port');;
                $soapClientOptions['proxy_login'] = $config->get('proxy_login');;
                $soapClientOptions['proxy_password'] = $config->get('proxy_password');;
            }

            $client = new SoapClient($url, $soapClientOptions);

            $headers[] = new \SoapHeader('ns', 'PartnerCode', $config->get('partner_code'));

            switch ($profile_type) {
                case "institute":
                    $headers[] = new \SoapHeader('ns', 'CryptoAreaSite', $config->get('institute_crypto_area_site'));
                    break;
                case "student":
                    $headers[] = new \SoapHeader('ns', 'CryptoAreaSite', $config->get('student_crypto_area_site'));
                    break;
                case "hcp":
                default:
                    $headers[] = new \SoapHeader('ns', 'CryptoAreaSite', $config->get('hcp_crypto_area_site'));
                    break;
            }

            $client->__setSoapHeaders($headers);

            if ($cache = \Drupal::cache('data')->get('nhsc_cadastro_unico_api_service_check')) {
                $service_check = $cache->data;
            } else {
                $service_check = $client->IsServiceAvailable();
                $expire = strtotime('+15 seconds');
                \Drupal::cache('data')->set('nhsc_cadastro_unico_api_service_check', $service_check, $expire);
            }

            if ($service_check->IsServiceAvailableResult == 1) {
                $response = $client->$method($arguments);
            }

            \Drupal::logger('nhsc_cadastro_unico_api ARGUMENTS')->notice('Method: '.$method .', '.json_encode($arguments));

            \Drupal::logger('nhsc_cadastro_unico_api RESPONCE')->notice('Method: '.$method .', '.json_encode($response));
            \Drupal::logger('nhsc_cadastro_unico_api LAST REQUEST')->notice('Method: '.$method .", REQUEST: " . $client->__getLastRequest());
        } catch (\Exception $e) {
            $message = sprintf("SOAP Call failed with the following response: %s.", $e->getMessage());
            \Drupal::logger('nhsc_cadastro_unico_api')->error('Method: '.$method .', '. $message);
            return null;
        }

        return $response;
    }

    /**
     * Check is user is registered already.
     *
     * @param string $data Email address of a user.
     *
     * @return boolean
     */
    public function isRegistered($data)
    {
        $call = $this->call('GetUserStatus', ['email' => $data]);

        switch ($call->GetUserStatusResult) {
            case "Success":
            case "Incomplete":
            case "Unconfirmed":
                return TRUE;
                break;
            case "AccessDenied":
            case "InvalidLogin":
            case "Blocked":
            case "Inactive":
            case "UserNotFound":
            case "Error":
            case "None":
            default:
                return FALSE;
                break;
        }
    }

    /**
     * Get list of user profile fields.
     *
     * @param string $profile_type Used to get the fields for a certain user type.
     *
     * @return array The response of the API call.
     */
    public function getFields($profile_type)
    {

        if ($cache = \Drupal::cache('data')->get('nhsc_cadastro_unico_api_fields')) {
            return $cache->data;
        }

        $call = $this->call('RetrieveFields', null, $profile_type);
        $fields = [];

        foreach ($call->RetrieveFieldsResult->Field as $field) {
            $fields[(string)$field->Name]['#title'] = (string)$field->FriendlyName;

            if (isset($field->Items->Item) && !empty($field->Items->Item)) {
                $options = [];
                foreach ($field->Items->Item as $item) {
                    $options[trim($item->Description)] = trim($item->Description);
                }

                $fields[$field->Name]['#type'] = 'select';
                $fields[$field->Name]['#size'] = 1;
                $fields[$field->Name]['#options'] = $options;
            }
        }

        if (!empty($fields)) {
            $expire = strtotime('+1 hour');
            \Drupal::cache('data')->set('nhsc_cadastro_unico_api_fields', $fields, $expire);
        }

        return $fields;
    }

    /**
     * Create a user.
     *
     * @param $first_name
     * @param $last_name
     * @param $email
     * @param $password
     * @param $id_number
     * @param $birth_date
     * @return mixed The response of the API call.
     */
    public function createUser($first_name, $last_name, $email, $password, $identification_number, $birth_date)
    {
        // change format
        $dob = str_replace('/', '-', $birth_date['date']);
        $birth_date =  date('Y-m-d',strtotime((string)$dob));

        $user_data = [
            'nome' => sprintf('%s %s', $first_name, $last_name),
            'email' => $email,
            'senha' => $password,
            'cpf'=> $identification_number,
            'dataNascimento' => $birth_date,  // should be 1986-11-11
            'dataCriacao' => date('c'),
            'dataAlteracao' => null,
            'dataUltimoLogin' => null,
            'questaoSeguranca' => null,
            'respostaQuestaoSeguranca' => null,
            'cpfResponsavel' => null,
            'emailResponsavel' => null,
            'nameResponsavel' => null,
        ];

        $call = $this->call('CreateUser', $user_data, $this->profile_type);

        if (empty((array)$call->CreateUserResult)) {
            $this->sendConfirmationEmail($email);
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * Update a user.
     *
     * @param object $data Information about a user.
     * @param string $profile_type The type of user profile to use.
     *
     * @return array The response of the API call.
     */
    public function updateUser($data, $profile_type)
    {
        $call = $this->call('UpdateUser', ['user' => $data], $profile_type);
        return $call->UpdateUserResult;
    }

    /**
     * Retrieve a user.
     *
     * @param string $email Username of a user.
     *
     * @return mixed The response of the API call.
     */
    public function getUser($email)
    {
        $call = $this->call('GetUser', ['username' => $email], $this->profile_type);

        if (isset($call->GetUserResult)) {
            return $call->GetUserResult;
        } else {
            return false;
        }
    }

    /**
     * Retrieve a user.
     *
     * @param string $email Username of a user.
     *
     * @return mixed The response of the API call.
     */
    public function getUserByCPF($identification_number)
    {
        $call = $this->call('GetUser', ['cpf' => $identification_number]);

        if (isset($call->GetUserResult)) {
            \Drupal::logger('nhsc_cadastro_unico_api')->notice('CPF found');
            return $call->GetUserResult;
        } else {
            \Drupal::logger('nhsc_cadastro_unico_api')->notice('CPF NOT found');
            return false;
        }
    }

    /**
     * @param $identification_number
     * @param $birth_date
     * @return mixed
     */
    public function getEmail($identification_number, $birth_date) {
        $call = $this->call('RetrieveEmail', ['cpf' => $identification_number, 'dataDeNascimento' => $birth_date], $this->profile_type);

        if (isset($call->RetrieveEmailResult)) {
            \Drupal::logger('nhsc_cadastro_unico_api')->notice('CPF found' .$birth_date);
            return $call->RetrieveEmailResult;
        } else {
            \Drupal::logger('nhsc_cadastro_unico_api')->notice('CPF NOT found'.$birth_date);
            return false;
        }
    }

    /**
     * Delete a user.
     *
     * @param string $username Username of a user.
     * @param string $profile_type The type of user profile to use.
     *
     * @return array The response of the API call.
     */
    public function deleteUser($username)
    {
        $call = $this->call('DeleteUser', ['username' => $username], $this->profile_type);

        return $call->DeleteUserResult;
    }

    /**
     * Retrieve a user.
     *
     * @param string $token Username of a user.
     * @param string $profile_type The type of user profile to use.
     *
     * @return array The response of the API call.
     */
    public function getAttributes($email, $profile_type)
    {
        $call = $this->call('GetAttributes', ['userName' => $email], $profile_type);

        return $call->GetAttributesResult;
    }

    /**
     * Retrieve a user.
     *
     * @param array $data An array of attributes.
     * @param string $profile_type The type of user profile to use.
     *
     * @return array The response of the API call.
     */
    public function saveAttributes($data)
    {
        $call = $this->call('SaveAttributes', $data,  $this->profile_type);

        return $call->SaveAttributesResult;
    }

  /**
   * Retrieve a user property.
   *
   * @param string $token Username of a user.
   * @param string $profile_type The type of user profile to use.
   *
   * @return array The response of the API call.
   */
  public function getProperty($email, $name)
  {
    $call = $this->call('GetPropertyValues', ['userName' => $email, 'propertyName' => $name]);

    return $call->GetPropertyValuesResult;
  }

  /**
   * Set a user property.
   *
   * @param array $data An array of attributes.
   * @param string $profile_type The type of user profile to use.
   *
   * @return array The response of the API call.
   */
  public function setProperty($email, $name, $value)
  {
    $call = $this->call('SetPropertyValues', ['userName' => $email, 'propertyName' => $name, 'value' => $value]);

    return $call->SetPropertyValuesResult;
  }

    /**
     * Reset a users password.
     *
     * @param string $username Username of a user.
     * @param string $profile_type The type of user profile to use.
     *
     * @return array The response of the API call.
     */
    public function resetPassword($username, $profile_type)
    {
        $call = $this->call('ResetPassword', ['username' => $username], $profile_type);

        return $call->ResetPasswordResult;
    }

    /**
     * Reset a users password.
     *
     * @param string $username Username of a user.
     * @param string $profile_type The type of user profile to use.
     *
     * @return array The response of the API call.
     */
    public function resetPasswordWithToken($username, $token, $new_password)
    {
        $call = $this->call('ChangePasswordByToken', ['username' => $username, 'token' => $token, 'newPassword' => $new_password], $this->profile_type);

        return $call->ChangePasswordByTokenResult;
    }

    /**
     * Reset a users password.
     *
     * @param string $username Username of a user.
     * @param string $new_password New password.
     * @param string $old_password Old Password.
     *
     * @return array The response of the API call.
     */
    public function changePassword($username, $new_password, $old_password)
    {
        $call = $this->call('ChangePassword', ['username' => $username, 'newPassword' => $new_password, 'oldPassword' => $old_password], $this->profile_type);

        return $call->ChangePasswordResult;
    }

    /**
     * Send password reset mail.
     *
     * @param string $email Email address of the user.
     *
     * @return mixed The response of the API call.
     */
    public function sendPasswordResetEmail($email)
    {
        $domain = \Drupal::request()->getHttpHost();
        $call = $this->call('SendEmailForgotPasswordWithDomain', ['email' => $email, 'domainName' => $domain], $this->profile_type);

        return $call->SendEmailForgotPasswordWithDomainResult;
    }

    /**
     * Send confirmation reset mail.
     *
     * @param string $email Email address of the user.
     *
     * @return mixed The response of the API call.
     */
    public function sendConfirmationEmail($email)
    {
        $domain = \Drupal::request()->getHttpHost();
        $call = $this->call('SendConfirmationEmailWithDomain', ['email' => $email, 'domainName' => $domain], $this->profile_type);

        return $call->SendConfirmationEmailWithDomainResult;
    }

    /**
     * Send confirmation reset mail.
     *
     * @param string $email Email address of the user.
     *
     * @return mixed The response of the API call.
     */
    public function confirmUser($token)
    {
        $call = $this->call('GetUserByConfirmationToken', ['token' => $token], $this->profile_type);

        if ($call->GetUserByConfirmationTokenResult->Email) {
            $call2 = $this->call('UserConfirmation', ['email' => $call->GetUserByConfirmationTokenResult->Email, 'token' => $token], $this->profile_type);
            return $call2->UserConfirmationResult;
        }

        return null;
    }

    /**
     * Generate a password reset token.
     *
     * @param string $token The token from the password reset email.
     *
     * @return mixed The response of the API call.
     */
    public function validatePasswordResetToken($token) {
        $call = $this->call('ValidateTokenForgotPassword', ['token' => $token], $this->profile_type);

        return $call->ValidateTokenForgotPasswordResult;
    }

    /**
     * Retrieve a user.
     *
     * @param array $data Username and password of a user.
     *
     * @return boolean.
     */
    public function validate($username, $password)
    {
        static $status;

        if (isset($status)) {
            return $status;
        }

        $call = $this->call('ValidateUser', ['username' => $username, 'password' => $password]);

        switch ($call->ValidateUserResult->Status) {
            case "Unconfirmed":
                $this->sendConfirmationEmail($username);
            case "Incomplete":
            case "Success":
                $status = $call->ValidateUserResult->SessionToken;
                return $call->ValidateUserResult->SessionToken;
                break;
            case "AccessDenied":
            case "InvalidLogin":
            case "Blocked":
            case "Inactive":
            case "Error":
            case "None":
                $status = FALSE;
                return FALSE;
                break;
            case "UserNotFound":
            default:
                $status = NULL;
                return NULL;
                break;
        }
    }
}
