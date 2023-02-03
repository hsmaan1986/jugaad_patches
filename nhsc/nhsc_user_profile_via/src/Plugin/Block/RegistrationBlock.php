<?php

namespace Drupal\nhsc_user_profile_via\Plugin\Block;

use Drupal\Core\Annotation\Translation;
use Drupal\Core\Block\Annotation\Block;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Entity\EntityFormBuilderInterface;
use Drupal\Core\Entity\EntityManagerInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\Core\Session\AccountInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\user\UserInterface;
use Drupal\Core\Access\AccessResult;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\nhsc_user_profile_via\Controller\PageController;
/**
 * Provides a 'RegistrationBlock' block.
 *
 * @Block(
 *  id = "registration_block",
 *  admin_label = @Translation("Registration block"),
 * )
 */
class RegistrationBlock extends BlockBase implements ContainerFactoryPluginInterface {

    /**
     * The entity manager
     *
     * @var \Drupal\Core\Entity\EntityManagerInterface.
     */
    protected $entityManager;

    /**
     * The entity form builder
     *
     * @var \Drupal\Core\Entity\EntityManagerInterface.
     */
    protected $entityFormBuilder;

    /**
     * Constructs a new UserRegisterBlock plugin
     *
     * @param array $configuration
     *   A configuration array containing information about the plugin instance.
     * @param string $plugin_id
     *   The plugin_id for the plugin instance.
     * @param mixed $plugin_definition
     *   The plugin implementation definition.
     * @param \Drupal\Core\Entity\EntityManagerInterface $entityManager
     *   The entity manager.
     * @param \Drupal\Core\Entity\EntityFormBuilderInterface $entityFormBuilder
     *   The entity form builder.
     */
    public function __construct(array $configuration, $plugin_id, $plugin_definition, EntityTypeManagerInterface $entity_type_manager, EntityFormBuilderInterface $entityFormBuilder) {
        parent::__construct($configuration, $plugin_id, $plugin_definition);
        $this->entityManager = $entity_type_manager;
        $this->entityFormBuilder = $entityFormBuilder;
    }

    /**
     * @inheritdoc
     */
    public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
        return new static(
            $configuration,
            $plugin_id,
            $plugin_definition,
            $container->get('entity_type.manager'),
            $container->get('entity.form_builder')
        );
    }


    /**
     * Implements \Drupal\block\BlockBase::build().
     */
    public function build() {
        $build = array();
        $controller = new PageController();
        $config                 = $controller->getConfigs();
        $terms_link             = $config->get('terms_link');
        $policy_link             = $config->get('policy_link');

        $account = $this->entityManager->getStorage('user') ->create(array());
        $build['form'] = $this->entityFormBuilder->getForm($account, 'register');

        $build['form']['account']['mail']['#description'] = t('');

        // remove username
//        unset($build['form']['account']['name']);
        $build['form']['account']['name']['#access'] = FALSE;
        // remove password policy table
        unset($build['form']['account']['password_policy_status']);

        // add old class
        $build['form']['#attributes']['class'] = ['nhsc-user-profile-via-register-form'];
        // fix occupation
        $build['form']['field_occupation']['widget']['#default_value'] = false;
        $build['form']['field_occupation']['widget']['#options']['_none'] = t('Please select your job role');
        // fix patient
        $build['form']['field_patients']['widget']['#options']['_none'] = t('Please select your patients');

        // update restricted field label
        $build['form']['field_restricted']['widget']['value']["#title"] = t("I’m aware that this site is restricted to health professionals and I assume full responsibility for the veracity of the Information above");
        // update terms and conditions
        $build['form']['field_accept_terms']['widget']['value']["#title"] = t("I agree to Vitaflo's <a href='" .$terms_link. "' target='_blank'>terms and conditions</a> and <a href='" .$policy_link. "' target='_blank'>privacy policy</a>");
        // update submit label
        $build['form']['actions']['submit']['#value'] = t('Register');

        $build['form']['cancel'] = [
            '#markup' => '<div class="already-register-login"><a href="user/login"><span>'.$this->t('Already Registered').'</span>?</a></div>',
            '#weight' => $build['form']['actions']['#weight'],
        ];

//        dump($build['form']);

        return $build;
    }

    /**
     *Implements \Drupal\block\BlockBase::blockAccess().
     *
     * @param \Drupal\Core\Session\AccountInterface $account
     *
     * @return bool|\Drupal\Core\Access\AccessResult
     */
    public function blockAccess(AccountInterface $account) {

        if (($account->isAnonymous()) && (\Drupal::config('user.settings')->get('register') != UserInterface::REGISTER_ADMINISTRATORS_ONLY)) {
            return AccessResult::allowed();
        }
    }



}
