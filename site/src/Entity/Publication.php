<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\MappedSuperclass;

/**
 * Abstract class Publication.
 *
 * @MappedSuperclass
 *
 * @category Symfony4
 * @package  App\Entity
 * @author   Display Name <thomaslaure3@gmail.com>
 * @license  https://www.gnu.org/licenses/license-list.fr.html GPL
 * @link     https://symfony.com/
 */
abstract class Publication
{
    /**
     * ID of the publication.
     *
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * Label of the publication.
     *
     * @ORM\Column(type="string", length=255)
     */
    protected $label;

    /**
     * Description of the publication.
     *
     * @ORM\Column(type="text")
     */
    protected $description;

    /**
     * Publication date of the publication.
     *
     * @ORM\Column(type="date")
     */
    protected $datePublication;

    /**
     * Author of the publication.
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Guest")
     */
    protected $author;

    /**
     * Getter of the publication ID.
     *
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Getter of the publication label.
     *
     * @return string|null
     */
    public function getLabel(): ?string
    {
        return $this->label;
    }

    /**
     * Setter of the publication label.
     *
     * @param string $label Label to set.
     *
     * @return $this
     */
    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    /**
     * Getter of the publication description.
     *
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * Setter of the publication description.
     *
     * @param string $description Description to set.
     *
     * @return $this
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDatePublication(): ?\DateTimeInterface
    {
        return $this->datePublication;
    }

    /**
     * Setter of the publication date.
     *
     * @param \DateTimeInterface $datePublication Publication date to set.
     *
     * @return $this
     */
    public function setDatePublication(\DateTimeInterface $datePublication): self
    {
        $this->datePublication = $datePublication;

        return $this;
    }

    /**
     * Getter of the publication author.
     *
     * @return Guest|null
     */
    public function getAuthor(): ?Guest
    {
        return $this->author;
    }

    /**
     * Setter of the publication author.
     *
     * @param Guest|null $author Author to set.
     *
     * @return $this
     */
    public function setAuthor(?Guest $author): self
    {
        $this->author = $author;

        return $this;
    }
}