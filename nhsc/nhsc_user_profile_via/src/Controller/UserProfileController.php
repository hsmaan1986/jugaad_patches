<?php

namespace Drupal\nhsc_user_profile_via\Controller;

use Drupal\Component\Utility\Crypt;
use Drupal\Component\Utility\Xss;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Datetime\DateFormatterInterface;
use Drupal\user\Form\UserPasswordResetForm;
use Drupal\user\UserDataInterface;
use Drupal\user\UserInterface;
use Drupal\user\UserStorageInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

/**
 * Controller routines for user routes.
 */
class UserProfileController extends ControllerBase {
    /**
     * The date formatter service.
     *
     * @var \Drupal\Core\Datetime\DateFormatterInterface
     */
    protected $dateFormatter;

    /**
     * The user storage.
     *
     * @var \Drupal\user\UserStorageInterface
     */
    protected $userStorage;

    /**
     * The user data service.
     *
     * @var \Drupal\user\UserDataInterface
     */
    protected $userData;

    /**
     * A logger instance.
     *
     * @var \Psr\Log\LoggerInterface
     */
    protected $logger;

    /**
     * Constructs a UserController object.
     *
     * @param \Drupal\Core\Datetime\DateFormatterInterface $date_formatter
     *   The date formatter service.
     * @param \Drupal\user\UserStorageInterface $user_storage
     *   The user storage.
     * @param \Drupal\user\UserDataInterface $user_data
     *   The user data service.
     * @param \Psr\Log\LoggerInterface $logger
     *   A logger instance.
     */
    public function __construct(DateFormatterInterface $date_formatter, UserStorageInterface $user_storage, UserDataInterface $user_data, LoggerInterface $logger) {
        $this->dateFormatter = $date_formatter;
        $this->userStorage = $user_storage;
        $this->userData = $user_data;
        $this->logger = $logger;
    }
    
}