<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Event extends Publication.
 *
 * @ORM\Entity(repositoryClass="App\Repository\EventRepository")
 *
 * @category Symfony4
 * @package  App\Entity
 * @author   Display Name <thomaslaure3@gmail.com>
 * @license  https://www.gnu.org/licenses/license-list.fr.html GPL
 * @link     https://symfony.com/
 */
class Event extends Publication
{
    /**
     * Place of the event.
     *
     * @ORM\Column(type="string", length=255)
     */
    private $place;

    /**
     * Type of the event.
     *
     * @ORM\Column(type="string", length=255)
     */
    private $typeEvent;

    /**
     * Participations of the event.
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Participation", mappedBy="event")
     */
    private $participations;

    /**
     * Date of the event.
     *
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * Event constructor.
     */
    public function __construct()
    {
        $this->participations = new ArrayCollection();
    }

    /**
     * Getter of the event place.
     *
     * @return string|null
     */
    public function getPlace(): ?string
    {
        return $this->place;
    }

    /**
     * Setter of the event place.
     *
     * @param string $place Place to set.
     *
     * @return $this
     */
    public function setPlace(string $place): self
    {
        $this->place = $place;

        return $this;
    }

    /**
     * Getter of the event type.
     *
     * @return string|null
     */
    public function getTypeEvent(): ?string
    {
        return $this->typeEvent;
    }

    /**
     * Setter of the event type.
     *
     * @param string $typeEvent Event type to set.
     *
     * @return $this
     */
    public function setTypeEvent(string $typeEvent): self
    {
        $this->typeEvent = $typeEvent;

        return $this;
    }

    /**
     * Getter of the participations.
     *
     * @return Collection|Participation[]
     */
    public function getParticipations(): Collection
    {
        return $this->participations;
    }

    /**
     * Add a participation to the event.
     *
     * @param Participation $participation Participation to add.
     *
     * @return $this
     */
    public function addParticipation(Participation $participation): self
    {
        if (!$this->participations->contains($participation)) {
            $this->participations[] = $participation;
            $participation->setEvent($this);
        }

        return $this;
    }

    /**
     * Remove a participation from the event.
     *
     * @param Participation $participation Participation to remove.
     *
     * @return $this
     */
    public function removeParticipation(Participation $participation): self
    {
        if ($this->participations->contains($participation)) {
            $this->participations->removeElement($participation);
            // set the owning side to null (unless already changed)
            if ($participation->getEvent() === $this) {
                $participation->setEvent(null);
            }
        }

        return $this;
    }

    /**
     * Getter of the event date.
     *
     * @return \DateTimeInterface|null
     */
    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    /**
     * Setter of the event date.
     *
     * @param \DateTimeInterface $date Date to set.
     *
     * @return $this
     */
    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }
}