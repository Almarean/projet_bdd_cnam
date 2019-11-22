<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DashboardController extends AbstractController.
 *
 * @category Symfony4
 * @package  App\Controller
 * @author   Display Name <thomaslaure3@gmail.com>
 * @license  https://www.gnu.org/licenses/license-list.fr.html GPL
 * @link     https://symfony.com/
 */
class DashboardController extends AbstractController
{
    /**
     * Entry point of the dashboard.
     *
     * @Route("/dashboard", name="dashboard")
     */
    public function index()
    {
        return $this->render('dashboard.html.twig');
    }
}