<?php

namespace Drupal\nhsc_user_profile\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Drupal\Core\Url;

/**
 * Class PageController.
 */
class PageController extends ControllerBase
{

    /**
     * Homepage.
     *
     * @return array
     *   Return null string.
     */
    public function homepage()
    {
        return [
            '#type' => 'markup',
            '#markup' => null,
        ];
    }

    /**
     * Agenda.
     *
     * @return array
     *   Return null string.
     */
    public function agenda()
    {
        return [
            '#type' => 'markup',
            '#markup' => null,
        ];
    }

    /**
     * Achievements.
     *
     * @return array
     *   Return null string.
     */
    public function achievements()
    {
        return [
            '#type' => 'markup',
            '#markup' => null,
        ];
    }

    /**
     * Settings.
     *
     * @return array
     *   Return null string.
     */
    public function settings()
    {
        return [
            '#type' => 'markup',
            '#markup' => null,
        ];
    }

    /**
     * Profile.
     *
     * @return array
     *   Return null string.
     */
    public function profile()
    {
        return [
            '#type' => 'markup',
            '#markup' => null,
        ];
    }

    /**
     * Profile Upgrade.
     *
     * @return array
     *   Return null string.
     */
    public function profileUpgrade()
    {
        $user = \Drupal::currentUser();
        $profile_type = \Drupal::service('user.data')->get('nhsc_user_profile', $user->id(), 'user_profile');
        \Drupal::service('page_cache_kill_switch')->trigger();

        if ($profile_type == 'student') {
            return [
                '#type' => 'markup',
                '#markup' => null,
            ];
        } else {
            $url = Url::fromRoute('nhsc_user_profile.edit', [], ['absolute' => true])->toString();
            return new RedirectResponse($url, 302);
        }
    }

    /**
     * Register Next.
     *
     * @return array
     *   Return null string.
     */
    public function registerNext()
    {
        $config = $this->config('nhsc_user_profile.config');

        return [
            '#type' => 'markup',
            '#title' => $this->t($config->get('registration_message_title')),
            '#markup' => $this->t($config->get('registration_message')),
        ];
    }

    /**
     * Forgot Password Confirmation .
     *
     * @return array
     *   Return null string.
     */
    public function forgotPasswordConfirm()
    {
        $config = $this->config('nhsc_user_profile.config');

        return [
            '#type' => 'markup',
            '#title' => $this->t($config->get('forgot_password_message_title')),
            '#markup' => $this->t($config->get('forgot_password_message')),
        ];
    }

    public function getConfigs(){
        $config = $this->config('nhsc_user_profile.config');

        return $config;
    }

}
