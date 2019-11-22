<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Entity\Event;
use App\Entity\News;
use App\Entity\Project;
use App\Entity\Publication;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PublicationController extends AbstractController
{
    /**
     * @Route("/publication", name="publication")
     */
    public function index()
    {
        $events = null;
        $news = null;
        $projects = null;
        $events = $this->getDoctrine()->getRepository(Event::class)->findAll();
        $news = $this->getDoctrine()->getRepository(News::class)->findAll();
        $projects = $this->getDoctrine()->getRepository(Project::class)->findAll();
        $contacts = $this->getDoctrine()->getRepository(Contact::class)->findAll();

        return $this->render('publication/index.html.twig', array(
            'contacts' => $contacts,
            'events' => $events,
            'news' => $news,
            'projects' => $projects
        ));
    }

    public function dateFromDBToString($list){
    }

}
