<?php

namespace App\Controller;

use App\Entity\Session;
use App\Entity\Formation;
use App\Form\FormationType;
use App\Repository\StudentRepository;
use App\Repository\FormationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FormationController extends AbstractController
{
    #[Route('/formation/{id}', name: 'formation_sessions')]
    public function showSessions($id, EntityManagerInterface $entityManager): Response
    {
        $formation = $entityManager->getRepository(Formation::class)->find($id);
        // $programmes = $entityManager->getRepository(Programme::class)->findBy(["session_id" => $id]);

        if (!$formation) {
            throw $this->createNotFoundException('La formation' . $id . ' n\'a pas été trouvée.');
        }

        $sessions = $formation->getSessions();
        return $this->render('formation/sessions.html.twig', [
            'sessions' => $sessions,
            'formation' => $formation,
        ]);
    }  

    #[Route('/formation', name: 'app_formation')]
    public function index(EntityManagerInterface $entityManager): Response
    {

        $formationRepo = $entityManager->getRepository(Formation::class);
        $formationList = $formationRepo->findBy([], ['title_formation' => 'ASC']);
       
        return $this->render('formation/index.html.twig', [
            'formations' => $formationList,
            
        ]);
    }

}