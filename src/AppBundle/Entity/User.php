<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 */
class User
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
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=100, unique=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=100)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="role", type="string", length=100)
     */
    private $role;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="regDate", type="datetime")
     */
    private $regDate;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="lastVisit", type="datetime", nullable=true)
     */
    private $lastVisit;

    /**
     * @var UserInfo
     *
     * @ORM\OneToMany(targetEntity="UserInfo", mappedBy="user", cascade={"persist"})
     */
    private $info;

    public function __construct()
    {
        $this->info = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setEmail(string $email): User
    {
        $this->email = $email;

        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setPassword(string $password): User
    {
        $this->password = $password;

        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setRole(string $role): User
    {
        $this->role = $role;

        return $this;
    }

    public function getRole(): string
    {
        return $this->role;
    }

    public function setRegDate(\DateTime $regDate): User
    {
        $this->regDate = $regDate;

        return $this;
    }

    public function getRegDate(): \DateTime
    {
        return $this->regDate;
    }

    public function setLastVisit(\DateTime $lastVisit = null): User
    {
        $this->lastVisit = $lastVisit;

        return $this;
    }

    public function getLastVisit(): ?\DateTime
    {
        return $this->lastVisit;
    }

    /**
     * @return Collection|UserInfo[]
     */
    public function getInfo(): Collection
    {
        return $this->info;
    }

    public function addInfo(UserInfo $info): User
    {
        $info->setUser($this);
        $this->info->add($info);

        return $this;
    }

    public function getCountry(): string
    {
        return $this->getInfo()->filter(function (UserInfo $info) {
            return $info->getItem() === UserInfo::ITEM_COUNTRY;
        })->first()->getValue();
    }

    public function getState(): string
    {
        return $this->getInfo()->filter(function (UserInfo $info) {
            return $info->getItem() === UserInfo::ITEM_STATE;
        })->first()->getValue();
    }
}
