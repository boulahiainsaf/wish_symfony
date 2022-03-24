<?php

namespace App\Controller;

use App\Entity\Categorie;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategorieController extends AbstractController
{
    /**
     * @Route("/categorie", name="app_categrorie")
     */
    public function create (EntityManagerInterface $entityManager): Response
    {
        $categorie = new Categorie();
        $categorie->setName(' O
        thers ');
        $entityManager->persist($categorie);
        $entityManager->flush();

        return $this->render('categrorie/create.html.twig', [
            'controller_name' => 'CategrorieController',
        ]);
    }
}
