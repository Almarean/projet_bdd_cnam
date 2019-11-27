<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Entity\Event;
use App\Entity\News;
use App\Entity\Project;
use App\Form\ContactType;
use App\Form\EventType;
use App\Form\NewsType;
use App\Form\ProjectType;
use App\Service\RegistrationService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class RegistrationController extends AbstractController.
 *
 * @category Symfony4
 * @package  App\Controller
 * @author   Display Name <thomaslaure3@gmail.com>
 * @license  https://www.gnu.org/licenses/license-list.fr.html GPL
 * @link     https://symfony.com/
 */
class RegistrationController extends AbstractController
{
    /**
     * The entry point for the registration.
     *
     * @Route("/registration/{type}", name="registration")
     *
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @param RegistrationService $service
     * @param string $type
     *
     * @return Response
     * @throws \Exception
     */
    public function index(Request $request, EntityManagerInterface $manager, RegistrationService $service, string $type): Response
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
                }
                $manager->persist($record);
                $manager->flush();
                return $this->render('registration.html.twig', array(
                    'form' => $form->createView(),
                    'type' => $type,
                    'success_message' => "Registration success !"
                ));
            } else {
                return $this->render('registration.html.twig', array(
                    'form' => $form->createView(),
                    'type' => $type,
                    'errors' => $errors
                ));
            }
        }
        return $this->render('registration.html.twig', array(
            'form' => $form->createView(),
            'type' => $type
        ));
    }
}