<?php


namespace Drupal\nhsc_learn_to_grow_survey\Form;

use Drupal\Core\Form\FormStateInterface;
use Drupal\nhsc_learn_to_grow_survey\Controller\LearnToGrowController;
use Drupal\Core\Form\FormBase;

class IntroductionForm extends FormBase
{
    /**
     * {@inheritdoc}
     */
    public function getFormId() {
        return 'learn_introduction_form';
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state)
    {
        $controller = new LearnToGrowController();
        $elements = $controller->getIntroFormElements();


        $form = [];
        foreach ($elements as $key => $element){
            $form[$key] =$element;

            $form[$key]['#attributes'] = [
                'class' => ['form-inline']
            ];

            $form[$key]['#prefix'] = '<div class="col-md-3">';
            $form[$key]['#suffix'] = '</div>';
        }

        $form2['actions']['#type'] = 'actions';
        $form2['actions']['button'] = array(
            '#type' => 'button',
            '#value' => t('See Results'),
            '#attributes' => [
                'class' => ['results-button'],
            ],
            '#button_type' => 'primary',
            '#prefix' => '<div class="col-xs-12 text-center results-button-container">',
            '#suffix' => '</div>',
        );


        return [
            'introduction_form' => $form,
            'results_button' => $form2
        ];

    }

    /**
     * {@inheritdoc}
     */
    public function submitForm(array &$form, FormStateInterface $form_state)
    {
        // TODO: Implement submitForm() method.
    }

}