<?php

namespace App\Controller;

use App\Entity\Session;
use App\Entity\Student;
use App\Entity\Programme;
use App\Form\SessionType;
use App\Form\ProgrammeType;
use App\Form\ChangeFormerType;
use Doctrine\ORM\EntityManager;
use App\Repository\ModulesRepository;
use App\Repository\SessionRepository;
use App\Repository\StudentRepository;
use App\Repository\ProgrammeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SessionController extends AbstractController
{
    #[Route('/session', name: 'app_session')]
    public function index(): Response
    {
        return $this->render('session/index.html.twig', [
            'controller_name' => 'SessionController',
        ]);
    }

    #[Route('/sessions/{id}', name: 'app_showDetailsSession')]
    public function showDetailsSession($id, Request $request, EntityManagerInterface $entityManager, ModulesRepository $modulesRepository, SessionRepository $sessionRepository, StudentRepository $studentRepository, ProgrammeRepository $programmeRepository): Response
    {
        $session = $sessionRepository->find($id);
        $studentsNotInSession = $studentRepository->findStudentsNotInSession($id);
        $modules = $modulesRepository->getSessionModules($id);
        $programmes = $entityManager->getRepository(Programme::class)->findBy(['Session' => $id]);
        $programmesNotInSession = $programmeRepository->findProgrammesNotInSession($id);
        $changeFormerForm = $this->createForm(ChangeFormerType::class, $session);
        $allProgrammes = $entityManager->getRepository(Programme::class)->findAll();

        $programmeForms = [];
        foreach ($programmesNotInSession as $programme) {
            $form = $this->createForm(ProgrammeType::class, $programme);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $entityManager->flush();
                $this->addFlash('success', 'La durée du programme a été mise à jour avec succès.');
                return $this->redirectToRoute('app_showDetailsSession', ['id' => $id]);
            }

            $programmeForms[$programme->getId()] = $form->createView();
        }

        $changeFormerForm->handleRequest($request);
        if ($changeFormerForm->isSubmitted() && $changeFormerForm->isValid()) {
            $entityManager->flush();
            $this->addFlash('success', 'Le former a été changé avec succès.');
            return $this->redirectToRoute('app_showDetailsSession', ['id' => $id]);
        }

        return $this->render('formation/detailSession.html.twig', [
            'session' => $session,
            'studentsNotInSession' => $studentsNotInSession,
            'modules' => $modules,
            'programmes' => $programmes,
            'allProgrammes' => $allProgrammes,
            'programmesNotInSession' => $programmesNotInSession,
            'changeFormerForm' => $changeFormerForm->createView(),
            'programmeForms' => $programmeForms
        ]);
    }

}
