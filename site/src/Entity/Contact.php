<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Contact.
 *
 * @ORM\Entity(repositoryClass="App\Repository\ContactRepository")
 *
 * @category Symfony4
 * @package  App\Entity
 * @author   Display Name <thomaslaure3@gmail.com>
 * @license  https://www.gnu.org/licenses/license-list.fr.html GPL
 * @link     https://symfony.com/
 */
class Contact
{
    /**
     * ID of the contact.
     *
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * Name of the contact.
     *
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * Firstname of the contact.
     *
     * @ORM\Column(type="string", length=255)
     */
    private $firstname;

    /**
     * Email of the contact.
     *
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * Phone number of the contact.
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $phone;

    /**
     * Role of the contact.
     *
     * @ORM\Column(type="string", length=255)
     */
    private $role;

    /**
     * Getter of the contact ID.
     *
     * @return integer|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Getter of the contact name.
     *
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Setter of the contact name.
     *
     * @param string $name Name to set.
     *
     * @return self
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Getter of the contact firstname.
     *
     * @return string|null Firstname to set.
     */
    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    /**
     * Setter of the contact firstname.
     *
     * @param string $firstname Firstname to set.
     *
     * @return self
     */
    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Getter of the contact email.
     *
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * Setter of the contact email.
     *
     * @param string $email Email to set.
     *
     * @return self
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Getter of the contact phone number.
     *
     * @return string|null
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * Setter of the contact phone number.
     *
     * @param string|null $phone Phone number to set.
     *
     * @return self
     */
    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Getter of the contact role.
     *
     * @return string|null
     */
    public function getRole(): ?string
    {
        return $this->role;
    }

    /**
     * Setter of the contact role.
     *
     * @param string $role Role to set.
     *
     * @return self
     */
    public function setRole(string $role): self
    {
        $this->role = $role;

        return $this;
    }
}