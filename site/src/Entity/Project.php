<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Project extends News.
 *
 * @ORM\Entity(repositoryClass="App\Repository\ProjectRepository")
 *
 * @category Symfony4
 * @package  App\Entity
 * @author   Display Name <thomaslaure3@gmail.com>
 * @license  https://www.gnu.org/licenses/license-list.fr.html GPL
 * @link     https://symfony.com/
 */
class Project extends News
{
    /**
     * Guests of the project.
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Guest", inversedBy="projects")
     */
    private $guests;

    /**
     * The date of the end of the project.
     *
     * @ORM\Column(type="date")
     */
    private $dateEnd;

    public function __construct()
    {
        $this->guests = new ArrayCollection();
    }

    /**
     * Getter of the guests of the project.
     *
     * @return Collection|Guest[]
     */
    public function getGuests(): Collection
    {
        return $this->guests;
    }

    /**
     * Add a guest to the project
     *
     * @param Guest $guest Guest to add.
     *
     * @return $this
     */
    public function addGuest(Guest $guest): self
    {
        if (!$this->guests->contains($guest)) {
            $this->guests[] = $guest;
        }

        return $this;
    }

    /**
     * Remove a guest from the project.
     *
     * @param Guest $guest Guest to remove.
     *
     * @return $this
     */
    public function removeGuest(Guest $guest): self
    {
        if ($this->guests->contains($guest)) {
            $this->guests->removeElement($guest);
        }

        return $this;
    }

    /**
     * Getter of the date of the end of the project.
     *
     * @return \DateTimeInterface|null
     */
    public function getDateEnd(): ?\DateTimeInterface
    {
        return $this->dateEnd;
    }

    /**
     * Setter of the date of the end of the project.
     *
     * @param \DateTimeInterface $dateEnd Date to set.
     *
     * @return $this
     */
    public function setDateEnd(\DateTimeInterface $dateEnd): self
    {
        $this->dateEnd = $dateEnd;

        return $this;
    }
}