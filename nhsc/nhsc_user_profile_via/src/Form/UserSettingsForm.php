<?php

namespace Drupal\nhsc_user_profile_via\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Link;
use Drupal\Core\Url;
use Drupal\user\Entity\User;
use Drupal\taxonomy\Entity\Term;
use Drupal;

class UserSettingsForm extends FormBase {

    /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state) {

        $account = $this->currentUser();
        $user = User::load($account->id());
        $field_subjects = $user->get('field_subjects')->getValue();
        $field_notifications = $user->get('field_notifications')->getValue();
        $subjects = [];

        foreach ($field_subjects as $subject) {
            if (isset($subject['target_id'])) {
                $id = $subject['target_id'];
                $subjects[$id] = $id;
            }
        }

        $field_settings = Drupal::entityTypeManager()->getStorage('field_config')
            ->load('user.user.field_subjects')
            ->get('settings');
        $taxonomies = $field_settings['handler_settings']['target_bundles'];

        $subject_options = [];

        foreach ($taxonomies as $taxonomy) {
            $query = Drupal::entityQuery('taxonomy_term');
            $query->condition('vid', $taxonomy);
            $query->sort('weight');
            $tids = $query->execute();
            $terms = Term::loadMultiple($tids);

            foreach ($terms as $term) {
                $id = $term->id();
                $name = $term->getName();

                $subject_options[$id] = $name;
            }
        }

        if (empty($user_settings)) {
            $user_settings = [
                'newsletter' => 1,
                'subjects' => $subject_options
            ];
        }

        $form['description'] = [
            '#type' => 'item',
            '#markup' => '<h3 class="title">' . $this->t('Your notification preferences') . '</h3>',
        ];

        $form['newsletter'] = [
            '#type' => 'checkbox',
            '#title' => $this->t('I want to receive Vitaflo Education Portal notifications'),
            '#default_value' => $field_notifications[0]['value'],
        ];

        $form['subjects'] = [
            '#type' => 'checkboxes',
            '#title' => $this->t('What subjects would you like to know more about?'),
            '#options' => $subject_options,
            '#default_value' => $subjects,
        ];

        // Add a submit button that handles the submission of the form.
        $form['actions']['submit'] = [
            '#type' => 'submit',
            '#value' => $this->t('Submit'),
        ];

        // Add a reset button that handles the submission of the form.
        $cancel_url = Url::fromRoute('nhsc_user_profile_via.page_controller_homepage');
        $form['cancel'] = [
            '#markup' => Link::fromTextAndUrl($this->t('Cancel'), $cancel_url)->toString(),
        ];

        return $form;
    }

    /**
     * {@inheritdoc}
     */
    public function getFormId() {
        return 'nhsc_user_profile_via_user_settings_form';
    }

    /**
     * {@inheritdoc}
     */
    public function submitForm(array &$form, FormStateInterface $form_state) {

        // Gather the current user so the new record has ownership.
        $account = $this->currentUser();
        $values = $form_state->getValues();

        $user = User::load($account->id());
        $subjects = $values['subjects'];

        foreach ($subjects as $key => $subject) {
            if ($subject == 0) {
                unset($subjects[$key]);
            }
        }

        $user->field_notifications = $values['newsletter'];
        $user->field_subjects = $subjects;
        $user->save();

        \Drupal::messenger()->addMessage(t('User settings updated'), 'status');
    }
}
