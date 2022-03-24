<?php


namespace App\Controller;

use App\Entity\Wish;
use App\Form\WishType;
use App\Repository\WishRepository;
    use DateTimeZone;
    use Doctrine\ORM\EntityManagerInterface;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;

        /**
         * @Route ("/wish",name="wish_")
         */
        class WishController extends AbstractController
        {
            /**
             * @Route ("/liste", name="liste")
             */
            public function liste(WishRepository $wishRepository): Response
            {
                $abc= $wishRepository->findAll();


             return $this->render('wish/liste.html.twig',[
                        "wishes"=>$abc
                        ]);
             }

            /**
             * @Route ("/detail/{id}", name="detail")
             */
            public function detail(int $id,WishRepository $wishRepository): Response
            {
                $wish=$wishRepository->find($id);
                return $this->render('wish/detail.html.twig',[
                    "wish"=>$wish
                ]);
            }
            /**
             * @Route ("/create", name="create")
             */

            public function create(Request $request,EntityManagerInterface $entityManager):Response
            {
                $wish=new Wish();
                //remplire le champ autor par l'eamile de user
                $currentUserUsername = $this->getUser()->getUserIdentifier();
                $wish->setAuthor($currentUserUsername);
                //
                $wish->setIsPublished(false);
                $wish->setDateCreated( new \DateTime('now', new DateTimeZone('Europe/Paris')));
                $wishForm=$this->createForm(WishType::class,$wish);
                $wishForm->handleRequest($request);
                if ($wishForm->isSubmitted() && $wishForm->isValid()){

                    $entityManager->persist($wish);
                    $entityManager->flush();
                    $this->addFlash('success','wish est bien ajouter ');
                    return $this->redirectToRoute('wish_detail',['id'=>$wish->getId()]);

                }
                return $this->render('wish/create.html.twig',[
                    'wishForm'=>$wishForm->createView(),
                ]);
            }
            /**
             * @Route ("/home", name="home")
             */
            public function home()
            {
                return$this->render('main/home.html.twig');
            }
        }