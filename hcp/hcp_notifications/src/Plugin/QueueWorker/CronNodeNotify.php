<?php
namespace Drupal\hcp_notifications\Plugin\QueueWorker;

/**
 * Notifies users of content on cron run.
 *
 * @QueueWorker(
 *   id = "cron_node_notifications",
 *   title = @Translation("Cron Node Notifier"),
 *   cron = {"time" = 10}
 * )
 */
class CronNodeNotify extends NodeNotifyBase
{
}