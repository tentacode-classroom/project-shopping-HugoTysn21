<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Travel;
use App\Entity\User;

class ProductController extends AbstractController
{
    /**
     * @Route("/product/{slug}", name="product")
     */
    public function index($slug = null)
    {
        $travel = $this->getDoctrine()
            ->getRepository(Travel::class)
            ->find($slug);
        $user = $this->getDoctrine()
            ->getRepository(User::class)
            ->find($slug);

        return $this->render('product/index.html.twig', [
            'travel' => $travel,'user' => $user,
        ]);
    }
}
