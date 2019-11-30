<?php

namespace App\Controller;

use App\Entity\News;
use App\Entity\Event;
use App\Form\NewsType;
use App\Entity\Contact;
use App\Entity\Project;
use App\Form\EventType;
use App\Form\ContactType;
use App\Form\ProjectType;
use App\Service\RegistrationService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Class RegistrationItemsController extends AbstractController.
 *
 * @category Symfony4
 * @package  App\Controller
 * @author   Display Name <thomaslaure3@gmail.com>
 * @license  https://www.gnu.org/licenses/license-list.fr.html GPL
 * @link     https://symfony.com/
 */
class RegistrationPublicationsController extends AbstractController
{
    /**
     * The entry point for the registration of the publications.
     *
     * @Route("/client/registration/publications/{type}", name="registration_publications")
     *
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @param RegistrationService $service
     * @param Security $security
     * @param string $type
     *
     * @return Response
     * @throws \Exception
     */
    public function index(Request $request, EntityManagerInterface $manager, RegistrationService $service, Security $security, string $type): Response
    {
        $errors = array();
        $form = null;
        $record = null;
        if ($type === 'News') {
            $record = new News();
            $form = $this->createForm(NewsType::class, $record);
        } elseif ($type === 'Project') {
            $record = new Project();
            $form = $this->createForm(ProjectType::class, $record);
        } elseif ($type === 'Event') {
            $record = new Event();
            $form = $this->createForm(EventType::class, $record);
        } elseif ($type === 'Contact') {
            $record = new Contact();
            $form = $this->createForm(ContactType::class, $record);
        } else {
            return $this->render('404.html.twig');
        }
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if ($type === 'Contact') {
                if ($service->checkEmailExistence($record->getEmail(), 'contact')) {
                    $error = new \stdClass();
                    $error->label = 'email_existence';
                    $error->message = 'This email address already exists !';
                    array_push($errors, $error);
                }
            } else {
                $image = $form['image']->getData();
                if ($image) {
                    if (!$service->checkImageFormat($image)) {
                        $error = new \stdClass();
                        $error->label = 'image_format';
                        $error->message = 'The image sent does not have the right format !';
                        array_push($errors, $error);
                    } else {
                        $publicationImage = $service->imageProcessing($image);
                        $record->setImage($publicationImage);
                    }
                }
            }
            if (!count($errors) > 0) {
                if ($type !== 'Contact') {
                    $record->setDatePublication(new \DateTime());
                    $record->setAuthor($security->getUser());
                }
                if ($type === 'Contact') {
                    $record->setName(ucwords(strtolower($record->getName())));
                    $record->setFirstname(ucwords(strtolower($record->getFirstname())));
                }
                $manager->persist($record);
                $manager->flush();
                return $this->render('registration_publications.html.twig', array(
                    'form' => $form->createView(),
                    'type' => $type,
                    'success_message' => "Registration success !"
                ));
            } else {
                return $this->render('registration_publications.html.twig', array(
                    'form' => $form->createView(),
                    'type' => $type,
                    'errors' => $errors
                ));
            }
        }
        return $this->render('registration_publications.html.twig', array(
            'form' => $form->createView(),
            'type' => $type
        ));
    }
}