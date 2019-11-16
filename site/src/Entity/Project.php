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
     * Participants of the project.
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Guest")
     */
    private $participants;

    /**
     * Project constructor.
     */
    public function __construct()
    {
        $this->participants = new ArrayCollection();
    }

    /**
     * Getter of the project participants.
     *
     * @return Collection|Guest[]
     */
    public function getParticipants(): Collection
    {
        return $this->participants;
    }

    /**
     * Add a participant to the project.
     *
     * @param Guest $participant Participant to add.
     * @return $this
     */
    public function addParticipant(Guest $participant): self
    {
        if (!$this->participants->contains($participant)) {
            $this->participants[] = $participant;
        }

        return $this;
    }

    /**
     * Remove a participant from the project.
     *
     * @param Guest $participant Participant to remove.
     *
     * @return $this
     */
    public function removeParticipant(Guest $participant): self
    {
        if ($this->participants->contains($participant)) {
            $this->participants->removeElement($participant);
        }

        return $this;
    }
}