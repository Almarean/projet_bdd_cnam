<?php

namespace App\Entity;

use App\Entity\News;
use Doctrine\ORM\Mapping as ORM;

/**
 *  Class Event extends News.
 *
 * @ORM\Entity(repositoryClass="App\Repository\EventRepository")
 *
 * @category Symfony4
 * @package  App\Entity
 * @author   Display Name <thomaslaure3@gmail.com>
 * @license  https://www.gnu.org/licenses/license-list.fr.html GPL
 * @link     https://symfony.com/
 */
class Event extends News
{
    /**
     * Place of the event.
     *
     * @ORM\Column(type="string", length=255)
     */
    private $place;

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
     * @return self
     */
    public function setPlace(string $place): self
    {
        $this->place = $place;

        return $this;
    }
}