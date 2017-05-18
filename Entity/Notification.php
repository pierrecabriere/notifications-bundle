<?php

namespace NotificationsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Notification
 *
 * @ORM\Table(name="notification")
 * @ORM\Entity(repositoryClass="NotificationsBundle\Repository\NotificationRepository")
 */
class Notification
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="openedAt", type="datetime", nullable=true)
     */
    private $openedAt;

    /**
     * @var string
     *
     * @ORM\Column(name="link", type="string", length=255, nullable=true)
     */
    private $link;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\ManyToMany(targetEntity="UserBundle\Entity\User", mappedBy="notifications")
     */
    private $user;

    /**
     * @var string
     *
     * @ORM\Column(name="view", type="string", length=255, nullable=false)
     */
    private $view;

    private $viewRendered;


    /**
     * @var array
     *
     * @ORM\Column(name="arguments", type="array", nullable=true)
     */
    private $arguments;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set openedAt
     *
     * @param \DateTime $openedAt
     *
     * @return Notification
     */
    public function setOpenedAt($openedAt)
    {
        $this->openedAt = $openedAt;

        return $this;
    }

    /**
     * Get openedAt
     *
     * @return \DateTime
     */
    public function getOpenedAt()
    {
        return $this->openedAt;
    }

    /**
     * Set link
     *
     * @param string $link
     *
     * @return Notification
     */
    public function setLink($link)
    {
        $this->link = $link;

        return $this;
    }

    /**
     * Get link
     *
     * @return string
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Notification
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set user
     *
     * @param \UserBundle\Entity\User $user
     *
     * @return Notification
     */
    public function setUser(\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Add user
     *
     * @param \UserBundle\Entity\User $user
     *
     * @return Notification
     */
    public function addUser(\UserBundle\Entity\User $user)
    {
        $this->user[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param \UserBundle\Entity\User $user
     */
    public function removeUser(\UserBundle\Entity\User $user)
    {
        $this->user->removeElement($user);
    }

    /**
     * Set view
     *
     * @param string $view
     *
     * @return Notification
     */
    public function setView($view)
    {
      $this->view = $view;

      return $this;
    }

    /**
     * Get view
     *
     * @return string
     */
    public function getView()
    {
      if (!empty($this->viewRendered))
        return $this->viewRendered;

      return $this->view;
    }

    /**
     * Set viewRendered
     *
     * @param string $viewRendered
     *
     * @return Notification
     */
    public function setViewRendered($viewRendered)
    {
      $this->viewRendered = $viewRendered;

      return $this;
    }

    /**
     * Get viewRendered
     *
     * @return string
     */
    public function getViewRendered()
    {
      return $this->viewRendered;
    }

    /**
     * Set arguments
     *
     * @param array $arguments
     *
     * @return Notification
     */
    public function setArguments($arguments)
    {
      $this->arguments = $arguments;

      return $this;
    }

    /**
     * Get arguments
     *
     * @return array
     */
    public function getArguments()
    {
      return $this->arguments;
    }
}
