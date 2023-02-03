<?php

namespace Drupal\nppe_module_event\Controller;

use Drupal\Component\Utility\Html;
use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\Request;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use \Drupal\node\Entity\Node;
use \Drupal\taxonomy\Entity\Term;


/**
 * Class EventController.
 */
class EventController extends ControllerBase implements ContainerInjectionInterface
{
    /**
     * @var array
     */
    private $events = [],
        $dateFilter = '',
        $filterVal = '';

    /**
     * @param null $token
     * @param null $filter
     * @return array
     */
    public function eventlist($token = null, $filter = null)
    {
        if ($token !== null) {
            $this->dateFilter = Html::escape($token);
        } else {
            $this->dateFilter = date('Y-m');
        }

        $this->filterVal = $filter;
        $nodes = $this->getEntity('event', $this->dateFilter);

        return [
            '#theme' => 'nppe_module_event_list',
            '#data' => $this->createEventList($nodes),
            '#eventType' => $this->getTaxonomy("event_type"),
            '#paginationBack' => $this->validatePagination(date("F Y", strtotime($this->dateFilter)), 'back'),
            '#paginationCurrent' => date("F Y", strtotime($this->dateFilter)),
            '#paginationNext' => $this->validatePagination(date("F Y", strtotime($this->dateFilter)), 'forward'),
        ];
    }

    /**
     * @param null $token
     * @param null $filter
     * @return array
     */
    public function agendalist($token = null, $filter = null)
    {
        if ($token !== null) {
            $this->dateFilter = Html::escape($token);
        } else {
            $this->dateFilter = date('Y-m');
        }

        $this->filterVal = $filter;
        $nodes = $this->getEntity('event', $this->dateFilter);

        $myAgenda = $this->getEnrolledEvents($nodes);

        return [
            '#theme' => 'nppe_module_agenda_list',
            '#markup' => '',
            '#data' => $this->createEventList($myAgenda),
            '#eventType' => $this->getTaxonomy("event_type"),
            '#paginationBack' => $this->validatePagination(date("F Y", strtotime($this->dateFilter)), 'back'),
            '#paginationCurrent' => date("F Y", strtotime($this->dateFilter)),
            '#paginationNext' => $this->validatePagination(date("F Y", strtotime($this->dateFilter)), 'forward'),
        ];
    }

    public function myachievements()
    {
        $nodes = $this->getEntity('event', $this->dateFilter);
        $myAchievements = $this->createEventList($this->getEnrolledEvents($nodes, true));

        $config = \Drupal::config('nppe_module_event.settings');
        $creditEndpoint = json_decode($config->get('my_achievements'));

        return [
            '#theme' => 'nppe_module_my_achievements_list',
            '#markup' => '',
            '#blockdata' => $creditEndpoint,
            '#data' => $myAchievements,
        ];
    }

    /**
     * @param $nodes
     * @return array
     */
    private function createEventList($nodes)
    {
        foreach ($nodes as $key => $value) {
            $startDate = $nodes[$key]->get('field_start_date')->getString();
            $endDate = $nodes[$key]->get('field_end_date')->getString();

            $dateObj = date_diff(date_create($startDate), date_create($endDate), false);
            $duration = ($dateObj->d > 0) ? $dateObj->d . ' day(s)' : date("H:i", strtotime($startDate)) . ' - ' . date("H:i", strtotime($endDate));
            $webinarview = !empty($nodes[$key]->webinarview->percentage) ? $nodes[$key]->webinarview->percentage : null;

            $event = [
                'nid' => $nodes[$key]->get('nid')->getString(),
                'field_event_name' => $nodes[$key]->get('field_event_name')->getString(),
                'field_start_date' => $startDate,
                'field_end_date' => $nodes[$key]->get('field_event_tag')->getString(),
                'field_duration' => $duration,
                'field_description' => $nodes[$key]->get('field_description')->getString(),
                'field_tags' => $this->getTaxonomy("event_tag", $nodes[$key]->get('field_event_tag')->getString()),
                'field_event_type' => $nodes[$key]->get('field_event_type')->getString(),
                'field_webinarview' => $webinarview,
                'field_credit_type' => $nodes[$key]->get('field_event_credit_type')->getString(),
                'field_credit' => $nodes[$key]->get('field_event_credit')->getString(),
            ];
            array_push($this->events, $event);
        }

        return $this->events;
    }

    /**
     * @param $type
     * @param null $condition
     * @return \Drupal\Core\Entity\EntityInterface[]|static[]
     */
    private function getEntity($type, $condition = null)
    {
        $nids = \Drupal::entityQuery('node');

        if ($condition !== null && $this->filterVal !== null) {
            $nids->condition('field_event_type', $this->filterVal, '=');
            $nids->condition('field_start_date', $condition . '%', 'LIKE');
        } elseif ($condition !== null && $this->filterVal === null) {
            $nids->condition('field_start_date', $condition . '%', 'LIKE');
        }

        $nids->condition('status', 1);
        $nids->condition('type', $type);
        $nids->sort('field_start_date', 'ASC');
        $nid = $nids->execute();

        return Node::loadMultiple($nid);
    }

    /**
     * @param $nodes
     * @return array
     */
    private function getEventsMonthYear($nodes)
    {
        $eventsCalendar = [];
        foreach ($nodes as $key => $value) {
            $startDate = date("F Y", strtotime($nodes[$key]->get('field_start_date')->getString()));
            array_push($eventsCalendar, $startDate);
        }

        return $eventsCalendar;
    }

    /**
     * @param $date
     * @return null
     */
    private function validatePagination($date, $direction)
    {
        $eventDate = $this->getEventsMonthYear($this->getEntity('event'));
        $currentDateKey = array_keys($eventDate, $date);
        $trackKey = ($direction === 'back') ? current($currentDateKey) - 1 : end($currentDateKey) + 1;

        return (isset($eventDate[$trackKey])) ? date("Y-m", strtotime($eventDate[$trackKey])) : null;
    }

    /**
     * @param $type
     * @param null $tid
     * @return array
     */
    private function getTaxonomy($type, $tid = null)
    {
        $list = [];
        if ($tid !== null) {
            $tids = \Drupal::entityQuery('taxonomy_term')
                ->condition('vid', $type)
                ->condition('tid', explode(',', $tid), 'in')
                ->execute();
        } else {
            $tids = \Drupal::entityQuery('taxonomy_term')
                ->condition('vid', $type)
                ->execute();
        }

        $terms = Term::loadMultiple($tids);

        foreach ($terms as $term) {
            $list[$term->id()] = $term->getName();
        }

        return $list;
    }

    private function getEnrolledEvents($nodes, $getCredits = false)
    {
        $user = \Drupal::currentUser();
        $uid = $user->id();
        $myAgenda = [];

        if ($getCredits)
            $nodes = $this->getEntity('event');

        foreach ($nodes as $keys => $value) {

            $event_manager = \Drupal::service('rng.event_manager');
            $event_meta = $event_manager->getMeta($value);
            $registrantList = $event_meta->getRegistrants();

            if (count($registrantList) > 0) {
                foreach ($registrantList as $key => $registrant) {
                    if ($registrant->getIdentityId()['entity_id'] == $uid) {
                        if (!in_array($nodes[$keys], $myAgenda)) {
                            if ($getCredits) {
                                $nodes[$keys]->webinarview = !empty($nodes[$keys]->get('field_webinar_key')->getString()) ? $this->getPercentage($nodes[$keys]->get('field_webinar_key')->getString()) : null;
                            }
                            array_push($myAgenda, $nodes[$keys]);
                        }
                    }
                }
            }
        }
        return $myAgenda;
    }

    private function getPercentage($webinarCode)
    {
        try {
            $config = \Drupal::config('nppe_module_event.settings');
            $creditEndpoint = $config->get('credit_endpoint');
            $accessKey = $config->get('access_key');

            $timestamp = time();
            $key = strtolower(md5($timestamp . $accessKey));
            $user = \Drupal::currentUser();

            /*$body = [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'X-WM-Timestamp' => $timestamp,
                    'X-WM-Master-Key' => $key,
                ],
                'body' => json_encode([
                    'code' => $webinarCode,
                    'user_email' => $user->getEmail(),
                ]),
            ];*/

             $body = [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Cache-Control'=>'no-cache',
                    'X-WM-Timestamp' => '1523629696',
                    'X-WM-Master-Key' => 'e9256d20a5ff35b51c45b3958d69f0b5',
                ],
                'body' => json_encode([
                    'code' => $webinarCode,
                    'user_email' => $user->getEmail(),
                    //'user_email' => 'jaredbouwer@gmail.com',
                ]),
            ];



            $response = \Drupal::httpClient()->post($creditEndpoint, $body);
            return json_decode($response->getBody()->getContents());

        } catch (\Exception $e) {
            \Drupal::logger('my_module')->error($e->getMessage());
            return null;
        }
    }

}
