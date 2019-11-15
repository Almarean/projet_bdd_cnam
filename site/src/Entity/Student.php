<?php

namespace App\Entity;

use App\Entity\Guest;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Student extends Guest.
 *
 * @ORM\Entity(repositoryClass="App\Repository\StudentRepository")
 *
 * @category Symfony4
 * @package  App\Entity
 * @author   Display Name <thomaslaure3@gmail.com>
 * @license  https://www.gnu.org/licenses/license-list.fr.html GPL
 * @link     https://symfony.com/
 */
class Student extends Guest
{
    /**
     * Registration date of the student.
     *
     * @ORM\Column(type="date")
     */
    private $registrationDate;

    /**
     * Getter of the registration date.
     *
     * @return \DateTimeInterface|null
     */
    public function getRegistrationDate(): ?\DateTimeInterface
    {
        return $this->registrationDate;
    }

    /**
     * Setter of the registration date.
     *
     * @param \DateTimeInterface $registrationDate Registration date to set.
     *
     * @return self
     */
    public function setRegistrationDate(\DateTimeInterface $registrationDate): self
    {
        $this->registrationDate = $registrationDate;

        return $this;
    }
}