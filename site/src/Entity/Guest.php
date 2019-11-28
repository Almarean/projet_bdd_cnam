<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class Guest implements UserInterface.
 *
 * @ORM\Entity(repositoryClass="App\Repository\GuestRepository")
 *
 * @category Symfony4
 * @package  App\Entity
 * @author   Display Name <thomaslaure3@gmail.com>
 * @license  https://www.gnu.org/licenses/license-list.fr.html GPL
 * @link     https://symfony.com/
 */
class Guest implements UserInterface
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
     * Email of the guest.
     *
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * Roles of the guest.
     *
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * Password of the guest.
     *
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

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
     * Phone number of the guest.
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $phone;

    /**
     * State of confirmation of the guest.
     *
     * @ORM\Column(type="boolean")
     */
    private $isConfirmed;

    /**
     * Projects of the guest.
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Project", mappedBy="guests")
     */
    private $projects;

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
     * @return $this
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * Getter of the user roles.
     *
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * Setter of the user roles.
     */
    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * Getter of the guest password.
     *
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
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
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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
     * Setter of the guest firstname.
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
     * @param string $phone Phone number to set.
     *
     * @return self
     */
    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Getter of the state of confirmation of the guest.
     *
     * @return boolean|null
     */
    public function getIsConfirmed(): ?bool
    {
        return $this->isConfirmed;
    }

    /**
     * Setter of the state of confirmation of the guest.
     *
     * @param boolean $isConfirmed State of confirmation to set.
     *
     * @return self
     */
    public function setIsConfirmed(bool $isConfirmed = false): self
    {
        $this->isConfirmed = $isConfirmed;

        return $this;
    }

    /**
     * Getter of the guest projects.
     *
     * @return Collection|Project[]
     */
    public function getProjects(): Collection
    {
        return $this->projects;
    }

    /**
     * Add a projet to the guest.
     *
     * @param Project $project Project to add.
     *
     * @return $this
     */
    public function addProject(Project $project): self
    {
        if (!$this->projects->contains($project)) {
            $this->projects[] = $project;
            $project->addGuest($this);
        }

        return $this;
    }

    /**
     * Remove a project from the guest.
     *
     * @param Project $project Project to remove.
     *
     * @return $this
     */
    public function removeProject(Project $project): self
    {
        if ($this->projects->contains($project)) {
            $this->projects->removeElement($project);
            $project->removeGuest($this);
        }

        return $this;
    }
}