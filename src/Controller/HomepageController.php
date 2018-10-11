<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Travel;
use App\Entity\User;

class HomepageController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function index()
    {
        $travels = $this->getDoctrine()
            ->getRepository(Travel::class)
            ->findByExampleField();

        return $this->render('homepage/index.html.twig', [
            'travels' => $travels,
        ]);
    }
}
