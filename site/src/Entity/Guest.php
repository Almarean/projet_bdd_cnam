<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\DiscriminatorColumn;
use Doctrine\ORM\Mapping\DiscriminatorMap;
use Doctrine\ORM\Mapping\InheritanceType;

/**
 * Abstract class Guest.
 *
 * @ORM\Entity(repositoryClass="App\Repository\GuestRepository")
 *
 * @InheritanceType("SINGLE_TABLE")
 * @DiscriminatorColumn(name="type", type="string")
 * @DiscriminatorMap({"administrator" = "Administrator", "student" = "Student"})
 *
 * @category Symfony4
 * @package  App\Entity
 * @author   Display Name <thomaslaure3@gmail.com>
 * @license  https://www.gnu.org/licenses/license-list.fr.html GPL
 * @link     https://symfony.com/
 */
abstract class Guest
{
    /**
     * ID of the guest.
     *
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * Name of the guest.
     *
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * Firstname of the guest.
     *
     * @ORM\Column(type="string", length=255)
     */
    private $firstname;

    /**
     * Email of the guest.
     *
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * Phone number of the guest.
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $phone;

    /**
     * Password of the guest.
     *
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * Confirmation of the guest.
     *
     * @ORM\Column(type="boolean")
     */
    private $isConfirmed;

    /**
     * Guest constructor.
     */
    public function __construct()
    {
        $this->type = new ArrayCollection();
    }

    /**
     * Getter of the guest ID.
     *
     * @return integer|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Getter of the guest name.
     *
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Setter of the guest name.
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
     * Getter of the guest firstname.
     *
     * @return string|null
     */
    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    /**
     * Setter of the guest firstname.²
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
     * Getter of the guest email.
     *
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * Setter of the guest email.
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
     * Getter of the guest phone number.
     *
     * @return string|null
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * Setter of the guest phone number.
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
     * Getter of the guest password.
     *
     * @return string|null
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * Setter of the guest password.
     *
     * @param string $password Password to set.
     *
     * @return self
     */
    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Getter of the guest confirmation.
     *
     * @return boolean|null
     */
    public function getIsConfirmed(): ?bool
    {
        return $this->isConfirmed;
    }

    /**
     * Setter of the guest confirmation.
     *
     * @param boolean $isConfirmed Confirmation to set.
     *
     * @return self
     */
    public function setIsConfirmed(bool $isConfirmed): self
    {
        $this->isConfirmed = $isConfirmed;

        return $this;
    }
}