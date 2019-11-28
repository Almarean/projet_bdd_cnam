<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Entity\Event;
use App\Entity\News;
use App\Entity\Project;
use App\Entity\Publication;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

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
    public function index()
    {
        return $this->render('publications.html.twig', array(
            'events' => $this->getDoctrine()->getRepository(Event::class)->findAll(),
            'news' => $this->getDoctrine()->getRepository(News::class)->findAll(),
            'projects' => $this->getDoctrine()->getRepository(Project::class)->findAll()
        ));
    }
}