<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/",name="main_home")
     */
    public function home()
    {
        return $this->render('main/home.html.twig');
    }
    /**
     * @Route ("/about",name="main_about")
     */
    public function about() : Response{
// ATTENTION : le chemin est relatif au contrôleur frontal donc au répertoire "public"
        $rawData = file_get_contents("../src/data/team.json");
        // Ou mettre le second paramètre à true pour travailler par rapport au répertoire courant
        // $rawData = file_get_contents("../data/team.json", true);
        // il faut décoder la chaîne en tableau associatif
        $teamMembers = json_decode($rawData, true);

        return $this->render("main/about.html.twig",['teamM'=>$teamMembers]);

    }
}