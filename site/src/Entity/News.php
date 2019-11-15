<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class News.
 *
 * @ORM\Entity(repositoryClass="App\Repository\NewsRepository")
 *
 * @category Symfony4
 * @package  App\Entity
 * @author   Display Name <thomaslaure3@gmail.com>
 * @license  https://www.gnu.org/licenses/license-list.fr.html GPL
 * @link     https://symfony.com/
 */
class News
{
    /**
     * ID of the news.
     *
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * Label of the news.
     *
     * @ORM\Column(type="string", length=255)
     */
    private $label;

    /**
     * Description of the news.
     *
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * Date of the news.
     *
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * Publication date of the news.
     *
     * @ORM\Column(type="date")
     */
    private $datePublication;

    /**
     * Image of the news.
     *
     * @ORM\Column(type="string", length=255)
     */
    private $image;

    /**
     * Author of the news.
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Guest")
     */
    private $author;

    /**
     * Getter of the news ID.
     *
     * @return integer|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Getter of the news label.
     *
     * @return string|null
     */
    public function getLabel(): ?string
    {
        return $this->label;
    }

    /**
     * Setter of the news label.
     *
     * @param string $label Label to set.
     *
     * @return self
     */
    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    /**
     * Getter of the news description.
     *
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * Setter of the news description.
     *
     * @param string $description Description to set.
     *
     * @return self
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

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
     * @return self
     */
    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Getter of the publication date of the news.
     *
     * @return \DateTimeInterface|null
     */
    public function getDatePublication(): ?\DateTimeInterface
    {
        return $this->datePublication;
    }

    /**
     * Setter of the publication date of the news.
     *
     * @param \DateTimeInterface $datePublication Publication date to set.
     *
     * @return self
     */
    public function setDatePublication(\DateTimeInterface $datePublication): self
    {
        $this->datePublication = $datePublication;

        return $this;
    }

    /**
     * Getter of the news image.
     *
     * @return string|null
     */
    public function getImage(): ?string
    {
        return $this->image;
    }

    /**
     * Setter of the news image.
     *
     * @param string $image Image to set.
     *
     * @return self
     */
    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Getter of the news author.
     *
     * @return Guest|null
     */
    public function getAuthor(): ?Guest
    {
        return $this->author;
    }

    /**
     * Setter of the news author.
     *
     * @param Guest|null $author Author to set.
     *
     * @return self
     */
    public function setAuthor(?Guest $author): self
    {
        $this->author = $author;

        return $this;
    }
}