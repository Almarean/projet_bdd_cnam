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
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
     * @param ObjectManager $manager
     * @param string $type
     *
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */
    public function index(Request $request, ObjectManager $manager, string $type)
    {
        $errors = array();
        $form = null;
        $record = null;
        if ($type === 'news') {
            $record = new News();
            $form = $this->createForm(NewsType::class, $record);
        } elseif ($type === 'project') {
            $record = new Project();
            $form = $this->createForm(ProjectType::class, $record);
        } elseif ($type === 'event') {
            $record = new Event();
            $form = $this->createForm(EventType::class, $record);
        } elseif ($type === 'contact') {
            $record = new Contact();
            $form = $this->createForm(ContactType::class, $record);
        } else {
            return $this->render('404.html.twig');
        }
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if (!count($errors) > 0) {
                if (!$type === 'contact') {
                    $record->setDatePublication(new \DateTime());
                }
                $manager->persist($record);
                $manager->flush();
                return $this->render('registration.html.twig', array(
                    'form' => $form->createView(),
                    'type_publication' => $type,
                    'success_message' => "Publication success !"
                ));
            } else {
                return $this->render('registration.html.twig', array(
                    'form' => $form->createView(),
                    'type_publication' => $type,
                    'errors' => $errors
                ));
            }
        }
        return $this->render('registration.html.twig', array(
            'form' => $form->createView(),
            'type_publication' => $type
        ));
    }
}