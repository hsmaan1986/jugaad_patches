<?php

namespace Drupal\nhsc_user_profile_via\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Drupal\Core\Url;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

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
        $profile_type = \Drupal::service('user.data')->get('nhsc_user_profile_via', $user->id(), 'user_profile');
        \Drupal::service('page_cache_kill_switch')->trigger();

        if ($profile_type == 'student') {
            return [
                '#type' => 'markup',
                '#markup' => null,
            ];
        } else {
            $url = Url::fromRoute('nhsc_user_profile_via.edit')->toString();
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
        $config = $this->config('nhsc_user_profile_via.config');

        return [
            '#type' => 'markup',
            '#title' => $config->get('registration_message_title'),
            '#markup' => $config->get('registration_message'),
        ];
    }

    public function getConfigs()
    {
        $config = $this->config('nhsc_user_profile_via.config');
        return $config;
    }

    /**
     * Forgot Password Confirmation .
     *
     * @return array
     *   Return null string.
     */
    public function forgotPasswordConfirm()
    {
        $config = $this->config('nhsc_user_profile_via.config');

        return [
            '#type' => 'markup',
            '#title' => $config->get('forgot_password_message_title'),
            '#markup' => $config->get('forgot_password_message'),
        ];
    }

    public function getCountrylist () {
        $list = [
            'United Kingdom' => t('United Kingdom'),
            'Afghanistan' => t('Afghanistan'),
            'Albania' => t('Albania'),
            'Algeria' => t('Algeria'),
            'America' => t('America'),
            'Andorra' => t('Andorra'),
            'Angola' => t('Angola'),
            'Antigua' => t('Antigua'),
            'Argentina' => t('Argentina'),
            'Armenia' => t('Armenia'),
            'Australia' => t('Australia'),
            'Austria' => t('Austria'),
            'Azerbaijan' => t('Azerbaijan'),
            'Bahamas' => t('Bahamas'),
            'Bahrain' => t('Bahrain'),
            'Bangladesh' => t('Bangladesh'),
            'Barbados' => t('Barbados'),
            'Belarus' => t('Belarus'),
            'Belgium' => t('Belgium'),
            'Belize' => t('Belize'),
            'Benin' => t('Benin'),
            'Bhutan' => t('Bhutan'),
            'Bissau' => t('Bissau'),
            'Bolivia' => t('Bolivia'),
            'Bosnia' => t('Bosnia'),
            'Botswana' => t('Botswana'),
            'Brazil' => t('Brazil'),
            'British' => t('British'),
            'Brunei' => t('Brunei'),
            'Bulgaria' => t('Bulgaria'),
            'Burkina' => t('Burkina'),
            'Burma' => t('Burma'),
            'Burundi' => t('Burundi'),
            'Cambodia' => t('Cambodia'),
            'Cameroon' => t('Cameroon'),
            'Canada' => t('Canada'),
            'Cape Verde' => t('Cape Verde'),
            'Central African Republic' => t('Central African Republic'),
            'Chad' => t('Chad'),
            'Chile' => t('Chile'),
            'China' => t('China'),
            'Colombia' => t('Colombia'),
            'Comoros' => t('Comoros'),
            'Congo' => t('Congo'),
            'Costa Rica' => t('Costa Rica'),
            'country debt' => t('country debt'),
            'Croatia' => t('Croatia'),
            'Cuba' => t('Cuba'),
            'Cyprus' => t('Cyprus'),
            'Czech' => t('Czech'),
            'Denmark' => t('Denmark'),
            'Djibouti' => t('Djibouti'),
            'Dominica' => t('Dominica'),
            'East Timor' => t('East Timor'),
            'Ecuador' => t('Ecuador'),
            'Egypt' => t('Egypt'),
            'El Salvador' => t('El Salvador'),
            'Emirate' => t('Emirate'),
            'England' => t('England'),
            'Eritrea' => t('Eritrea'),
            'Estonia' => t('Estonia'),
            'Ethiopia' => t('Ethiopia'),
            'Fiji' => t('Fiji'),
            'Finland' => t('Finland'),
            'France' => t('France'),
            'Gabon' => t('Gabon'),
            'Gambia' => t('Gambia'),
            'Georgia' => t('Georgia'),
            'Germany' => t('Germany'),
            'Ghana' => t('Ghana'),
            'Great Britain' => t('Great Britain'),
            'Greece' => t('Greece'),
            'Grenada' => t('Grenada'),
            'Grenadines' => t('Grenadines'),
            'Guatemala' => t('Guatemala'),
            'Guinea' => t('Guinea'),
            'Guyana' => t('Guyana'),
            'Haiti' => t('Haiti'),
            'Herzegovina' => t('Herzegovina'),
            'Honduras' => t('Honduras'),
            'Hungary' => t('Hungary'),
            'Iceland' => t('Iceland'),
            'in usa' => t('in usa'),
            'India' => t('India'),
            'Indonesia' => t('Indonesia'),
            'Iran' => t('Iran'),
            'Iraq' => t('Iraq'),
            'Ireland' => t('Ireland'),
            'Israel' => t('Israel'),
            'Italy' => t('Italy'),
            'Ivory Coast' => t('Ivory Coast'),
            'Jamaica' => t('Jamaica'),
            'Japan' => t('Japan'),
            'Jordan' => t('Jordan'),
            'Kazakhstan' => t('Kazakhstan'),
            'Kenya' => t('Kenya'),
            'Kiribati' => t('Kiribati'),
            'Korea' => t('Korea'),
            'Kosovo' => t('Kosovo'),
            'Kuwait' => t('Kuwait'),
            'Kyrgyzstan' => t('Kyrgyzstan'),
            'Laos' => t('Laos'),
            'Latvia' => t('Latvia'),
            'Lebanon' => t('Lebanon'),
            'Lesotho' => t('Lesotho'),
            'Liberia' => t('Liberia'),
            'Libya' => t('Libya'),
            'Liechtenstein' => t('Liechtenstein'),
            'Lithuania' => t('Lithuania'),
            'Luxembourg' => t('Luxembourg'),
            'Macedonia' => t('Macedonia'),
            'Madagascar' => t('Madagascar'),
            'Malawi' => t('Malawi'),
            'Malaysia' => t('Malaysia'),
            'Maldives' => t('Maldives'),
            'Mali' => t('Mali'),
            'Malta' => t('Malta'),
            'Marshall' => t('Marshall'),
            'Mauritania' => t('Mauritania'),
            'Mauritius' => t('Mauritius'),
            'Mexico' => t('Mexico'),
            'Micronesia' => t('Micronesia'),
            'Moldova' => t('Moldova'),
            'Monaco' => t('Monaco'),
            'Mongolia' => t('Mongolia'),
            'Montenegro' => t('Montenegro'),
            'Morocco' => t('Morocco'),
            'Mozambique' => t('Mozambique'),
            'Myanmar' => t('Myanmar'),
            'Namibia' => t('Namibia'),
            'Nauru' => t('Nauru'),
            'Nepal' => t('Nepal'),
            'Netherlands' => t('Netherlands'),
            'New Zealand' => t('New Zealand'),
            'Nicaragua' => t('Nicaragua'),
            'Niger' => t('Niger'),
            'Nigeria' => t('Nigeria'),
            'Norway' => t('Norway'),
            'Oman' => t('Oman'),
            'Pakistan' => t('Pakistan'),
            'Palau' => t('Palau'),
            'Panama' => t('Panama'),
            'Papua' => t('Papua'),
            'Paraguay' => t('Paraguay'),
            'Peru' => t('Peru'),
            'Philippines' => t('Philippines'),
            'Poland' => t('Poland'),
            'Portugal' => t('Portugal'),
            'Qatar' => t('Qatar'),
            'Romania' => t('Romania'),
            'Russia' => t('Russia'),
            'Rwanda' => t('Rwanda'),
            'Samoa' => t('Samoa'),
            'San Marino' => t('San Marino'),
            'Sao Tome' => t('Sao Tome'),
            'Saudi Arabia' => t('Saudi Arabia'),
            'scotland' => t('scotland'),
            'scottish' => t('scottish'),
            'Senegal' => t('Senegal'),
            'Serbia' => t('Serbia'),
            'Seychelles' => t('Seychelles'),
            'Sierra Leone' => t('Sierra Leone'),
            'Singapore' => t('Singapore'),
            'Slovakia' => t('Slovakia'),
            'Slovenia' => t('Slovenia'),
            'Solomon' => t('Solomon'),
            'Somalia' => t('Somalia'),
            'South Africa' => t('South Africa'),
            'South Sudan' => t('South Sudan'),
            'Spain' => t('Spain'),
            'Sri Lanka' => t('Sri Lanka'),
            'St. Kitts' => t('St. Kitts'),
            'St. Lucia' => t('St. Lucia'),
            'St Kitts' => t('St Kitts'),
            'St Lucia' => t('St Lucia'),
            'Saint Kitts' => t('Saint Kitts'),
            'Santa Lucia' => t('Santa Lucia'),
            'Sudan' => t('Sudan'),
            'Suriname' => t('Suriname'),
            'Swaziland' => t('Swaziland'),
            'Sweden' => t('Sweden'),
            'Switzerland' => t('Switzerland'),
            'Syria' => t('Syria'),
            'Taiwan' => t('Taiwan'),
            'Tajikistan' => t('Tajikistan'),
            'Tanzania' => t('Tanzania'),
            'Thailand' => t('Thailand'),
            'Tobago' => t('Tobago'),
            'Togo' => t('Togo'),
            'Tonga' => t('Tonga'),
            'Trinidad' => t('Trinidad'),
            'Tunisia' => t('Tunisia'),
            'Turkey' => t('Turkey'),
            'Turkmenistan' => t('Turkmenistan'),
            'Tuvalu' => t('Tuvalu'),
            'Uganda' => t('Uganda'),
            'Ukraine' => t('Ukraine'),
            'United States' => t('United States'),
            'Uruguay' => t('Uruguay'),
            'USA' => t('USA'),
            'Uzbekistan' => t('Uzbekistan'),
            'Vanuatu' => t('Vanuatu'),
            'Vatican' => t('Vatican'),
            'Venezuela' => t('Venezuela'),
            'Vietnam' => t('Vietnam'),
            'wales' => t('wales'),
            'welsh' => t('welsh'),
            'Yemen' => t('Yemen'),
            'Zambia' => t('Zambia'),
            'Zimbabwe' => t('Zimbabwe'),
        ];

        return $list;
    }

    public function getHearlist() {
        $list = [
            'Vitaflo representative visit' => t('Vitaflo representative visit'),
            'Magazine advert' => t('Magazine advert'),
            'Email' => t('Email'),
            'Vitaflo conference/event' => t('Vitaflo conference/event'),
            'Referral from colleague' => t('Referral from colleague'),
            'Search engine E.g Google search' => t('Search engine e.g Google search'),
            'Twitter' => t('Twitter@VitafloRDs'),
        ];

        return $list;
    }

    function get_taxonomy_term($vid) {

        $terms =\Drupal::entityTypeManager()->getStorage('taxonomy_term')->loadTree($vid);

        foreach ($terms as $term) {
            $term_data[$term->name] =  $term->name;
        }

        return $term_data;
    }



    public function cacheClear()
    {
        \Drupal::database()->truncate('cache_bootstrap')->execute();
        \Drupal::database()->truncate('cache_config')->execute();
        \Drupal::database()->truncate('cache_container')->execute();
        \Drupal::database()->truncate('cache_data')->execute();
        \Drupal::database()->truncate('cache_default')->execute();
        \Drupal::database()->truncate('cache_discovery')->execute();
//        \Drupal::database()->truncate('cache_dynamic_page_cache')->execute();
        \Drupal::database()->truncate('cache_entity')->execute();
        \Drupal::database()->truncate('cache_menu')->execute();
        \Drupal::database()->truncate('cache_render')->execute();
        \Drupal::database()->truncate('cache_rest')->execute();
        \Drupal::database()->truncate('cache_toolbar')->execute();

        if(drupal_flush_all_caches()){
            \Drupal::messenger()->addMessage('Cache Cleared', 'status');
        }else{
            \Drupal::messenger()->addMessage('Failed To Clear Cache', 'error');
        }

        $url = Url::fromRoute('<front>')->toString();
        return new RedirectResponse($url, 302);

    }

}
