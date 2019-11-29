<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Entity\Event;
use App\Entity\News;
use App\Entity\Participation;
use App\Entity\Project;
use App\Entity\Publication;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Form;
use App\Form\EventParticipationType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

/**
 * PublicationsController class extends AbstractController.
 *
 * @category Symfony4
 * @package  App\Controller
 * @author   Display Name <thomaslaure3@gmail.com>
 * @license  https://www.gnu.org/licenses/license-list.fr.html GPL
 * @link     https://symfony.com/
 */
class PublicationsController extends AbstractController
{
    /**
     * @Route("/client/publications", name="publications")
     */
    public function index(EntityManagerInterface $manager,Request $request, Security $security)
    {
        $events = $this->getDoctrine()->getRepository(Event::class)->findAll();
        $news = $this->getDoctrine()->getRepository(News::class)->findAll();
        $projects = $this->getDoctrine()->getRepository(Project::class)->findAll();
        $participation = new Participation();

        $form_event = $this->createForm(EventParticipationType::class, $participation);
        $form_event->handleRequest($request);
        if($form_event->isSubmitted() && $form_event->isValid()){
            if($request->get('event_participation[yes]')) {
                $participation->setGuest($security->getUser());
                $participation->setEvent($this->getDoctrine()->getRepository(Event::class)->findOneBy($request->get('event_participation{id]')));
                $participation->setNbPersons($request->get('event_participation[np_persons]'));
            }
        }

        return $this->render('publications.html.twig', array(
            'form_event' => $form_event->createView(),
            'events' => $events,
            'news' => $news,
            'projects' => $projects
        ));
    }
}