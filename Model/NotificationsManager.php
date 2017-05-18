<?php

namespace NotificationsBundle\Model;

use NotificationsBundle\Entity\Notification;
use UserBundle\Entity\User;

class NotificationsManager
{
  protected $pusher;
  protected $userManager;
  protected $user;
  protected $em;

  public function __construct($pusher, $userManager, $tokenStorage, $em)
  {
    $this->pusher = $pusher;
    $this->userManager = $userManager;
    $this->user = $tokenStorage->getToken()->getUser();
    $this->em = $em;
  }

  /**
   * {@inheritdoc}
   */
  public function createNotification($view, $args = array(), $push = true, $save = true, $user = NULL)
  {
    $notification = new Notification();
    $notification->setView($view);
    $notification->setArguments($args);

    $this->em->persist($notification);

    if ($push)
      $this->push($notification, $user);

    if ($save)
      $this->save($notification, $user);
    else
      $this->em->remove($notification);

    return $notification;
  }

  /**
   * {@inheritdoc}
   */
  public function push(Notification $notification, $user = NULL)
  {
    $view = $notification->getView();
    $this->pusher->pushNotification($view, $user);

    return $notification;
  }

  /**
   * {@inheritdoc}
   */
  public function save(Notification $notification, $user)
  {
    if (!$user instanceof User)
      $user = $this->user;

    $user->addNotification($notification);
    $this->userManager->updateUser($user);

    return $notification;
  }
}
