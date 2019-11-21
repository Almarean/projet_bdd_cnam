<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Participation.
 *
 * @ORM\Entity(repositoryClass="App\Repository\ParticipationRepository")
 *
 * @category Symfony4
 * @package  App\Entity
 * @author   Display Name <thomaslaure3@gmail.com>
 * @license  https://www.gnu.org/licenses/license-list.fr.html GPL
 * @link     https://symfony.com/
 */
class Participation
{
    /**
     * ID of the participation.
     *
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * The number of persons of the participation.
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nbPersons;

    /**
     * If the guest participe to the the event.
     *
     * @ORM\Column(type="boolean")
     */
    private $participe;

    /**
     * Guest linked to the participation.
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Guest")
     */
    private $guest;

    /**
     * Event concerned by the participation.
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Event", inversedBy="participations")
     */
    private $event;

    /**
     * Getter of the participation ID.
     *
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Getter of the number of persons.
     *
     * @return int|null
     */
    public function getNbPersons(): ?int
    {
        return $this->nbPersons;
    }

    /**
     * Setter of the number of persons.
     *
     * @param int|null $nbPersons Number of persons to set.
     *
     * @return $this
     */
    public function setNbPersons(?int $nbPersons): self
    {
        $this->nbPersons = $nbPersons;

        return $this;
    }

    /**
     * Getter of the participation.
     *
     * @return bool|null
     */
    public function getParticipe(): ?bool
    {
        return $this->participe;
    }

    /**
     * Setter of the participation.
     *
     * @param bool $participe Participation to set.
     * @return $this
     */
    public function setParticipe(bool $participe): self
    {
        $this->participe = $participe;

        return $this;
    }

    /**
     * Getter of the guest.
     *
     * @return Guest|null
     */
    public function getGuest(): ?Guest
    {
        return $this->guest;
    }

    /**
     * Setter of the guest.
     *
     * @param Guest|null $guest Guest to set.
     *
     * @return $this
     */
    public function setGuest(?Guest $guest): self
    {
        $this->guest = $guest;

        return $this;
    }

    /**
     * Getter of the event.
     *
     * @return Event|null
     */
    public function getEvent(): ?Event
    {
        return $this->event;
    }

    /**
     * Setter of the event.
     *
     * @param Event|null $event Event to set.
     *
     * @return $this
     */
    public function setEvent(?Event $event): self
    {
        $this->event = $event;

        return $this;
    }
}