<?php
/**
 * @file
 * Contains \Drupal\nhsc_cadastro_unico_api\Controller\CadastroUnicoController.
 */
namespace Drupal\nhsc_cadastro_unico_api\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Drupal\Core\Url;

class CadastroUnicoController extends ControllerBase {

    /**
     * Handler for autocomplete request.
     */
    public function addressAutocomplete(Request $request, $search_text) {
        $api = \Drupal::service('nhsc_cadastro_unico_api');
        $results = [];

        if (preg_match('/[0-9]{5}-?[0-9]{3}/', $search_text)) {
            $cep = $api->call('BuscarEnderecoPorCep', ['cep' => $search_text]);
            if ($cep != null) {
                $results[] = $cep->BuscarEnderecoPorCepResult;
            }
        }

        return new JsonResponse($results);
    }

    /**
     * Confirm User Account.
     */
    public function confirmUser(Request $request, $token = null) {
        $api = \Drupal::service('nhsc_cadastro_unico_api');
        $api->confirmUser($token);
        \Drupal::messenger()->addMessage(t('Your account has been verified.'), 'status');
        $url = Url::fromRoute('user.login')->toString();
        return new RedirectResponse($url, 302);
    }

    /**
     * Error Page
     */
    public function error(Request $request) {
        return [
            '#type' => 'markup',
            '#title' => $this->t('API Error'),
            '#markup' => $this->t('There was a problem connecting to the Cadastro Unico API.'),
        ];
    }

    /**
     * Handler for cadastroUserCheck request.
     */
    public function cadastroUserCheck(Request $request, $email) {
        $api = \Drupal::service('nhsc_cadastro_unico_api');
        $results = [];

        $results = $api->getUser($email);

        return new JsonResponse($results);
    }

    /**
     * Handler for cadastroUserCheck CPF request.
     */
    public function cadastroUserCheckCPF(Request $request, $cpf) {
        $api = \Drupal::service('nhsc_cadastro_unico_api');
        $return = [];

        $results = $api->getUser($cpf);

        if ($results->CPF){

            $error = '<div class="alert alert-danger alert-dismissible">' .
                t('Esse CPF já é cadastrado na Nestlé. Faça o seu login usando o e-mail @email no campo usuário.',
                    ['@email' => $this->mask_email($results->Email)]) .
                "<a href='/user/login' class='button js-form-submit form-submit btn-primary btn icon-before'>Fazer Login</a>".
                '</div>';

            $return = [
                'CPF' => $results->CPF,
                'error_place' => $error
            ];
        }

        return new JsonResponse($return);
    }

    public function mask_email($email)
    {
        $em   = explode("@",$email);
        $name = implode(array_slice($em, 0, count($em)-1), '@');
        $len  = floor(strlen($name)/2);

        return substr($name,0, $len) . str_repeat('*', $len) . "@" . end($em);
    }
}
