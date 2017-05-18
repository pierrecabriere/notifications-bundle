<?php

namespace NotificationsBundle\Doctrine;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;
use NotificationsBundle\Entity\Notification;
use Doctrine\Common\EventSubscriber;
use Symfony\Component\DependencyInjection\ContainerInterface;

class NotificationListener implements EventSubscriber
{
  protected $container;

  public function __construct(ContainerInterface $container)
  {
    $this->container = $container;
  }

  public function getSubscribedEvents()
  {
    return [Events::prePersist, Events::postLoad];
  }

  public function prePersist(LifecycleEventArgs $args)
  {
    $entity = $args->getEntity();
    if ($entity instanceof Notification) {
      if (empty($entity->getCreatedAt())) {
        $entity->setCreatedAt(new \DateTime());
      }

      if (empty($entity->getViewRendered())) {
        $this->renderView($entity);
      }
    }
  }

  public function postLoad(LifecycleEventArgs $args)
  {
    $entity = $args->getEntity();
    if ($entity instanceof Notification && empty($entity->getViewRendered())) {
      $this->renderView($entity);
    }
  }

  public function renderView(Notification $notification)
  {
    $rendered = $this->container->get('templating')->render('@Notifications/' . $notification->getView(), array('notification' => $notification));
    $notification->setViewRendered($rendered);
  }
}