<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="user_info")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserInfoRepository")
 */
class UserInfo
{
    const ITEM_COUNTRY = 'country';
    const ITEM_FIRST_NAME = 'firstname';
    const ITEM_STATE = 'state';
    const ITEM_EMAIL = 'email';

    const STATE_ACTIVE = 'active';
    const STATE_INACTIVE = 'inactive';

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User", inversedBy="info")
     */
    private $user;

    /**
     * @var string
     *
     * @ORM\Column(name="item", type="string", length=100)
     */
    private $item;

    /**
     * @var string
     *
     * @ORM\Column(name="value", type="string", length=250)
     */
    private $value;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="updated", type="datetime", nullable=true)
     */
    private $updated;

    public function __construct(string $item, string $value)
    {
        $this->item = $item;
        $this->value = $value;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setUser(User $user)
    {
        $this->user = $user;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setItem(string $item)
    {
        $this->item = $item;

        return $this;
    }

    public function getItem(): string
    {
        return $this->item;
    }

    public function setValue(string $value)
    {
        $this->value = $value;

        return $this;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function setUpdated(\DateTime $updated = null)
    {
        $this->updated = $updated;

        return $this;
    }

    public function getUpdated(): ?\DateTime
    {
        return $this->updated;
    }
}
