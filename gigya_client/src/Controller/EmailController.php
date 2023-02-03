<?php

namespace Drupal\gigya_client\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Mail\Plugin\Mail\PhpMail;
use Symfony\Component\HttpFoundation\JsonResponse;
use Zend\Feed\Reader\Http\Response;

const SETTINGS_KEY = 'gigya_client.settings';

/**
 * Class EmailController
 * @package Drupal\gigya_client\Controller
 */
class EmailController extends ControllerBase {


    public function sendEmail($locale){

        $config = \Drupal::config(SETTINGS_KEY);
        $email_template = $config->get('gigya_client.gigya_email_template');
        $is_email_enabled = $config->get('gigya_client.gigya_send_welcome_email');
        $secondary_language = $config->get('gigya_client.gigya_lang_2');
        $secret = $config->get('gigya_client.gigya_secret_key');
        $key = $_POST['key'];

        $signature = base64_encode(hash_hmac('sha1', $key, base64_decode($secret)));

        $is_request_valid = $this->isValidSignature($secret, $_POST['first_name'], $_POST['mail'],$signature);

        if($locale == $secondary_language){
            $email_template = $config->get('gigya_client.gigya_email_template_2');
        }

        if($is_email_enabled){
            if($is_request_valid){
                try {

                    $this->mailUser($_POST['mail'], $_POST['first_name'],$email_template, $_POST['message_subject']);
                    $res = new JsonResponse('success');

                }
                catch (\Exception $e) {
                    $res = new JsonResponse('fail');
                }
            }else{
                $res = new JsonResponse('fail');
            }

        }else{
            $res = new JsonResponse('Email is not enabled');
        }



        return $res;

    }

    private function isValidSignature ($secret, $firstname, $email, $signature){
        $constructedSignature = $this->constructSignature($secret, $firstname, $email);
        return ($signature == $constructedSignature);
    }

    private function constructSignature ($secret, $firstname, $email){
        return (base64_encode(hash_hmac('sha1', sha1($firstname.$email), base64_decode($secret))));
    }

    function mailUser($email, $first_name, $msg , $message_subject){
        $to = $email;
        $message = [];


        $params['title'] = $message_subject;
        $params['message'] = $msg; ;

        $system_site_config = \Drupal::config('system.site');
        $site_email = $system_site_config->get('mail');
        $site_name = $system_site_config->get('name');
        $send_mail = new PhpMail();

        $message['headers'] = array(
            'content-type' => 'text/html',
            'MIME-Version' => '1.0',
            'reply-to' => $site_email,
            'from' => $site_name . ' <'.$site_email.'>'
        );
        $message['to'] = $to;
        $message['subject'] = $params['title'];
        $message['body'] = str_replace('{firstname}',$first_name, $params['message']);
        $result = $send_mail->mail($message);
        if ($result != true) {
            $message = t('There was a problem sending your email notification to @email.', array('@email' => $to));

            \Drupal::logger('mail-log')->error($message);
            return false;
        }
        $message = t('An email notification has been sent to @email ', array('@email' => $to));

        \Drupal::logger('mail-log')->notice($message);
        return true;
    }

}