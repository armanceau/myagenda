<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ContactRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Contact;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'app_default')]
    public function index(ContactRepository $repos): Response
    {

        $liste = $repos->findAll();

        return $this->render('default/index.html.twig',[
            'contacts' => $liste,
        ]);
    }
}
