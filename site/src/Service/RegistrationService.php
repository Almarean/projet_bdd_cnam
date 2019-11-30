<?php

namespace App\Service;

use App\Entity\Event;
use App\Entity\Guest;
use App\Entity\Contact;
use App\Entity\Participation;
use App\Entity\Project;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Class RegistrationService extends AbstractController.
 *
 * @category Symfony4
 * @package  App\Service
 * @author   Display Name <thomaslaure3@gmail.com>
 * @license  https://www.gnu.org/licenses/license-list.fr.html GPL
 * @link     https://symfony.com/
 */
class RegistrationService extends AbstractController
{
    /**
     * Function that checks if the email in parameter exists in database.
     *
     * @param string $email The email to check.
     * @param string $type Type to search.
     *
     * @return bool|null
     */
    public function checkEmailExistence(string $email, string $type = null): ?bool
    {
        if ($type === 'contact') {
            $repository = $this->getDoctrine()->getRepository(Contact::class);
        } else {
            $repository = $this->getDoctrine()->getRepository(Guest::class);
        }
        $result = $repository->findOneBy(array(
            'email' => $email
        ));
        return $result !== null;
    }

    /**
     * Function that checks the image format.
     *
     * @param UploadedFile $file The file to check.
     *
     * @return bool|null
     */
    public function checkImageFormat(UploadedFile $file): ?bool
    {
        $extensionsAllowed = array('jpg', 'jpeg', 'png', 'gif');
        $extensionUploadedFile = $file->guessExtension();
        return in_array($extensionUploadedFile, $extensionsAllowed);
    }

    /**
     * Function that renames a file and keep the extension.
     *
     * @param UploadedFile $file Uploaded file.
     *
     * @return string|null
     */
    public function imageProcessing(UploadedFile $file): ?string
    {
        $imageName = uniqid() . '.' . $file->guessExtension();
        $file->move($this->getParameter('images_publications_directory'), $imageName);
        return $imageName;
    }

    /**
     * Function that checks if a guest already answerde
     *
     * @param Guest $guest
     * @param Event $event
     *
     * @return bool|null
     */
    public function checkEventParticipation(Guest $guest, Event $event): ?bool
    {
        $repository = $this->getDoctrine()->getRepository(Participation::class);
        return $repository->findOneBy(array(
            'guest' => $guest,
            'event' => $event
        )) !== null;
    }
}