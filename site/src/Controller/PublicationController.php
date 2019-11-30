<?php

namespace App\Controller;

use App\Entity\Event;
use App\Entity\News;
use App\Entity\Participation;
use App\Entity\Project;
use App\Form\EventParticipationType;
use App\Form\ProjectParticipationType;
use App\Service\RegistrationService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

/**
 * Class PublicationController extends AbstractController.
 *
 * @category Symfony4
 * @package  App\Controller
 * @author   Display Name <thomaslaure3@gmail.com>
 * @license  https://www.gnu.org/licenses/license-list.fr.html GPL
 * @link     https://symfony.com/
 */
class PublicationController extends AbstractController
{
    /**
     * The entry point to a specific publication.
     *
     * @Route("/client/publication/{type}/{id}", name="publication")
     *
     * @param Request $request
     * @param Security $security
     * @param EntityManagerInterface $manager
     * @param string $type
     * @param int $id
     * @param RegistrationService $service
     *
     * @return Response
     */
    public function index(Request $request, Security $security, EntityManagerInterface $manager, string $type, int $id, RegistrationService $service): Response
    {
        $record = null;
        $form = null;
        if ($type === 'project')  {
            $record = $this->getDoctrine()->getRepository(Project::class)->find($id);
            $form = $this->createForm(ProjectParticipationType::class, $record);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                if (!in_array($security->getUser(), $record->getGuests())) {
                    $record->addGuest($security->getUser());
                    $manager->persist($record);
                    $manager->flush();
                    return $this->render('publication.html.twig', array(
                        'type' =>  $type,
                        'form' => $form->createView(),
                        'record' => $record,
                        'success_message' => "You want to participate to this project !",
                        'success_class' => "success"
                    ));
                } else {
                    return $this->render('publication.html.twig', array(
                        'type' => $type,
                        'form' => $form->createView(),
                        'record' => $record,
                        'success_message' => "You already give an answer for this project !",
                        'success_class' => "warning"
                    ));
                }
            }
            return $this->render('publication.html.twig', array(
                'type' =>  $type,
                'form' => $form->createView(),
                'record' => $record
            ));
        } elseif ($type === 'event') {
            $record = $this->getDoctrine()->getRepository(Event::class)->find($id);
            $participation = new Participation();
            $form = $this->createForm(EventParticipationType::class, $participation);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                if (!$service->checkEventParticipation($security->getUser(), $record)) {
                    $participation->setGuest($security->getUser());
                    $participation->setEvent($record);
                    if ($form->get('yes')->isClicked()) {
                        $participation->setParticipe(true);
                        if ($participation->getNbPersons() < 0) {
                            $participation->setNbPersons(0);
                        }
                        $successMessage = "You want to participate to this event !";
                        $successClass = "success";
                    } elseif ($form->get('no')->isClicked()) {
                        $participation->setParticipe(false);
                        $participation->setNbPersons(0);
                        $successMessage = "You don't want to participate to this event !";
                        $successClass = "warning";
                    } else {
                        return $this->render('publication.html.twig', array(
                            'type' => $type,
                            'record' => $record,
                            'form' => $form->createView(),
                            'error_message' => "An error occurred",
                            'error_class' => "danger"
                        ));
                    }
                    $manager->persist($participation);
                    $manager->flush();
                    return $this->render('publication.html.twig', array(
                        'type' => $type,
                        'form' => $form->createView(),
                        'record' => $record,
                        'success_message' => $successMessage,
                        'success_class' => $successClass
                    ));
                } else {
                    return $this->render('publication.html.twig', array(
                        'type' => $type,
                        'form' => $form->createView(),
                        'record' => $record,
                        'error_message' => "You already give an answer for this event !",
                        'error_class' => "warning"
                    ));
                }
            }
            return $this->render('publication.html.twig', array(
                'type' => $type,
                'form' => $form->createView(),
                'record' => $record
            ));
        } else {
            return $this->render('publications.html.twig', array(
                'events' => $this->getDoctrine()->getRepository(Event::class)->findAll(),
                'projects' => $this->getDoctrine()->getRepository(Project::class)->findAll(),
                'news' => $this->getDoctrine()->getRepository(News::class)->findAll()
            ));
        }
    }
}