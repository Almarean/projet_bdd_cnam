<?php

namespace App\Entity;

use App\Entity\Guest;
use App\Entity\Publication;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

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
class Project extends Publication
{
    /**
     * Users of the project.
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Guest", inversedBy="projects")
     */
    private $guests;

    /**
     * The end date of the project.
     *
     * @ORM\Column(type="datetime")
     */
    private $endDate;

    /**
     * Project constructor.
     */
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
     * Getter of the end date.
     *
     * @return \DateTimeInterface|null
     */
    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }

    /**
     * Setter of the end date.
     *
     * @param \DateTimeInterface $endDate The end date to set.
     *
     * @return $this
     */
    public function setEndDate(\DateTimeInterface $endDate): self
    {
        $this->endDate = $endDate;

        return $this;
    }
}