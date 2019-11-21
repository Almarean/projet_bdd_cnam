<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class News extends Publication.
 *
 * @ORM\Entity(repositoryClass="App\Repository\NewsRepository")
 *
 * @category Symfony4
 * @package  App\Entity
 * @author   Display Name <thomaslaure3@gmail.com>
 * @license  https://www.gnu.org/licenses/license-list.fr.html GPL
 * @link     https://symfony.com/
 */
class News extends Publication
{
    /**
     * Date of the news.
     *
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * Image of the news.
     *
     * @ORM\Column(type="string", length=255)
     */
    private $image;

    /**
     * Getter of the date of the news.
     *
     * @return \DateTimeInterface|null
     */
    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    /**
     * Setter of the date of the news.
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

    /**
     * Getter of the image of the news.
     *
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Setter of the image of the news.
     *
     * @param string $image Image to set.
     *
     * @return $this
     */
    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }
}