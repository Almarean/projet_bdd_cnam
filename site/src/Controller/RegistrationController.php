<?php

namespace App\Controller;

use App\Entity\Guest;
use App\Form\RegistrationType;
use App\Service\RegistrationService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * RegistrationController extends AbstractController.
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
     * @Route("/registration", name="registration")
     *
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @param RegistrationService $service
     * @param UserPasswordEncoderInterface $encoder
     *
     * @return Response
     */
    public function index(Request $request, EntityManagerInterface $manager, RegistrationService $service, UserPasswordEncoderInterface $encoder): Response
    {
        $errors = array();
        $guest = new Guest();
        $form = $this->createForm(RegistrationType::class, $guest);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if ($service->checkEmailExistence($guest->getEmail())) {
                $error = new \stdClass();
                $error->label = 'email_existence';
                $error->message = 'This email address already exists !';
                array_push($errors, $error);
            }
            if (!count($errors) > 0) {
                $guest->setName(ucwords(strtolower($guest->getName())));
                $guest->setFirstname(ucwords(strtolower($guest->getFirstname())));
                $guest->setIsConfirmed(false);
                $guest->setPassword($encoder->encodePassword($guest, $guest->getPassword()));
                $manager->persist($guest);
                $manager->flush();
                return $this->render('registration.html.twig', array(
                    'form' => $form->createView(),
                    'success_message' => 'Registration success !'
                ));
            } else {
                return $this->render('registration.html.twig', array(
                    'form' => $form->createView(),
                    'errors' => $errors
                ));
            }
        }
        return $this->render('registration.html.twig', array(
            'form' => $form->createView()
        ));
    }
}