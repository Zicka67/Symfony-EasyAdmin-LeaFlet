<?php

namespace App\Controller;

use App\Entity\Modules;
use App\Entity\Category;
use App\Repository\ModulesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ModuleController extends AbstractController
{

    #[Route('/module', name: 'app_module', methods: ['GET'])]
    public function show(EntityManagerInterface $entityManager): Response
    {
        $modules = $entityManager->getRepository(Modules::class)->findAll();

        return $this->render('module/index.html.twig', [
            'modules' => $modules,
        ]);
    }

}







