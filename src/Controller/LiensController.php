<?php

namespace App\Controller;

use App\Entity\Liens;
use App\Repository\LiensRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/liens')]
class LiensController extends AbstractController
{
    #[Route('/', name: 'liens', methods: ['GET'])]
    public function index(LiensRepository $liensRepository): Response
    {

        return $this->render('liens/index.html.twig', [
            'liens' => $liensRepository->findAll(),
        ]);
    }
}
