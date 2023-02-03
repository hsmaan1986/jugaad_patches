<?php
/**
 * @file
 * Contains Drupal\hcp_notifications\Plugin\QueueWorker\NodeNotifyBase.php
 */

namespace Drupal\hcp_notifications\Plugin\QueueWorker;

use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\Core\Queue\QueueWorkerBase;
use Drupal\node\NodeInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;


/**
 * Provides base functionality for the NodeNotify Queue Workers.
 */
abstract class NodeNotifyBase extends QueueWorkerBase implements ContainerFactoryPluginInterface
{

    /**
     * The node storage.
     *
     * @var \Drupal\Core\Entity\EntityStorageInterface
     */
    protected $nodeStorage;

    /**
     * Creates a new NodeNotifyBase object.
     *
     * @param \Drupal\Core\Entity\EntityStorageInterface $node_storage
     *   The node storage.
     */
    public function __construct(EntityStorageInterface $node_storage)
    {
        $this->nodeStorage = $node_storage;
    }

    /**
     * {@inheritdoc}
     */
    public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition)
    {
        return new static(
            $container->get('entity_type.manager')->getStorage('node')
        );
    }


    /**
     * {@inheritdoc}
     */
    public function processItem($data)
    {
        /** @var NodeInterface $node */
        $node = $this->nodeStorage->load($data->nid);
        if (empty($node)){
            return;
        };
        $user = \Drupal\user\Entity\User::load($data->uid);

        $mail_manager = \Drupal::service('plugin.manager.mail');
        $params = ['node_id' => $data->nid, 'user_id' => $data->uid];

        $result = $mail_manager->mail('hcp_notifications', 'notify', $user->getEmail(), LANGUAGE_NONE, $params);

        \Drupal::logger('content_entity_example')->notice('Processed notification for user #@uid: for content item: %node',
            array(
                '@uid' => $data->uid,
                '%node' => $node->label(),
            ));
    }
}
