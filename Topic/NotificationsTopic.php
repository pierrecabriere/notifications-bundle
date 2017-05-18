<?php

namespace NotificationsBundle\Topic;

use Gos\Bundle\WebSocketBundle\Topic\TopicInterface;
use Gos\Bundle\WebSocketBundle\Topic\PushableTopicInterface;
use Ratchet\ConnectionInterface;
use Ratchet\Wamp\Topic;
use Gos\Bundle\WebSocketBundle\Router\WampRequest;
use Gos\Bundle\WebSocketBundle\Client\ClientManipulatorInterface;
use UserBundle\Entity\User;

class NotificationsTopic implements TopicInterface, PushableTopicInterface
{

  protected $clientManipulator;

  /**
   * @param ClientManipulatorInterface $clientManipulator
   */
  public function __construct(ClientManipulatorInterface $clientManipulator)
  {
    $this->clientManipulator = $clientManipulator;
  }

  /**
   * This will receive any Subscription requests for this topic.
   *
   * @param ConnectionInterface $connection
   * @param Topic $topic
   * @param WampRequest $request
   * @return void
   */
  public function onSubscribe(ConnectionInterface $connection, Topic $topic, WampRequest $request)
  {
    $user = $this->clientManipulator->getClient($connection);
    if (! ($user instanceof User) || !preg_match("#^\/$user(\/|)#", $topic->getId()))
      $connection->close();
  }

  /**
   * This will receive any UnSubscription requests for this topic.
   *
   * @param ConnectionInterface $connection
   * @param Topic $topic
   * @param WampRequest $request
   * @return void
   */
  public function onUnSubscribe(ConnectionInterface $connection, Topic $topic, WampRequest $request)
  {
  }


  /**
   * This will receive any Publish requests for this topic.
   *
   * @param ConnectionInterface $connection
   * @param Topic $topic
   * @param WampRequest $request
   * @param $event
   * @param array $exclude
   * @param array $eligible
   * @return mixed|void
   */
  public function onPublish(ConnectionInterface $connection, Topic $topic, WampRequest $request, $event, array $exclude, array $eligible)
  {
  }

  /**
   * @param Topic        $topic
   * @param WampRequest  $request
   * @param array|string $data
   * @param string       $provider The name of pusher who push the data
   */
  public function onPush(Topic $topic, WampRequest $request, $data, $provider)
  {
    $topic->broadcast($data);
  }

  /**
   * Like RPC is will use to prefix the channel
   * @return string
   */
  public function getName()
  {
    return 'app.topic.notifications';
  }
}