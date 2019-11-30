<?php

namespace App\Controller;

use App\Entity\Event;
use App\Entity\News;
use App\Entity\Project;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
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
     * The entry point to the publications.
     *
     * @Route("/client/publications", name="publications")
     *
     * @return Response
     */
    public function index(): Response
    {
        return $this->render('publications.html.twig', array(
            'events' => $this->getDoctrine()->getRepository(Event::class)->findAll(),
            'news' => $this->getDoctrine()->getRepository(News::class)->findAll(),
            'projects' => $this->getDoctrine()->getRepository(Project::class)->findAll()
        ));
    }
}