<?php

namespace App\Controller;

use App\Entity\Contact;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function index()
    {

        $contacts = $this->getDoctrine()->getRepository(Contact::class)->findAll();

        return $this->render('contact/index.html.twig', array(
            'contacts' => $contacts
        ));
    }
}
