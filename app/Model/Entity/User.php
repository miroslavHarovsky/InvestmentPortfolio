<?php

namespace App\Model\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\PersistentCollection;
use Nette\Utils\ArrayHash;
use Nette\Utils\DateTime;

/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 */
class User extends Entity
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private int $id;

    /**
     * @ORM\Column(type="string")
     */
    private string $name;

    /**
     * @ORM\Column(type="string")
     */
    private string $surname;

    /**
     * @ORM\Column(type="string")
     */
    private string $email;

    /**
     * @ORM\Column(type="string")
     */
    private string $password;

    /**
     * @ORM\ManyToMany (targetEntity="App\Model\Entity\Role", mappedBy="App\Model\Entity\User")
     */
    private PersistentCollection $role;

    /**
     * @ORM\Column(type="datetime")
     */
    private DateTime $lastLoginDate;

    public function __construct(ArrayHash $data = null)
    {
        parent::__construct($data);

    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getSurname(): string
    {
        return $this->surname;
    }

    /**
     * @param string $surname
     */
    public function setSurname(string $surname): void
    {
        $this->surname = $surname;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return \Nette\Utils\DateTime
     * @throws \Exception
     */
    public function getLastLoginDate(): DateTime
    {
        return $this->lastLoginDate;
    }


    public function setLastLoginDate(DateTime $lastLoginDate): void
    {
        $this->lastLoginDate = $lastLoginDate;
    }

    /**
     * @return \App\Model\Entity\Role []
     */
    public function getRole(): array
    {
        return $this->role->getValues();
    }

}