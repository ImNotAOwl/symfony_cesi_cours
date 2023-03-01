<?php

namespace App\Controller;

use App\Entity\SecteursStructures;
use App\Form\SecteursStructuresType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/secteurs/structures')]
class SecteursStructuresController extends AbstractController
{
    #[Route('/', name: 'app_secteurs_structures_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $secteursStructures = $entityManager
            ->getRepository(SecteursStructures::class)
            ->findAll();

        return $this->render('secteurs_structures/index.html.twig', [
            'secteurs_structures' => $secteursStructures,
        ]);
    }

    #[Route('/new', name: 'app_secteurs_structures_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $secteursStructure = new SecteursStructures();
        $form = $this->createForm(SecteursStructuresType::class, $secteursStructure);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($secteursStructure);
            $entityManager->flush();

            return $this->redirectToRoute('app_secteurs_structures_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('secteurs_structures/new.html.twig', [
            'secteurs_structure' => $secteursStructure,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_secteurs_structures_show', methods: ['GET'])]
    public function show(SecteursStructures $secteursStructure): Response
    {
        return $this->render('secteurs_structures/show.html.twig', [
            'secteurs_structure' => $secteursStructure,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_secteurs_structures_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, SecteursStructures $secteursStructure, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SecteursStructuresType::class, $secteursStructure);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_secteurs_structures_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('secteurs_structures/edit.html.twig', [
            'secteurs_structure' => $secteursStructure,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_secteurs_structures_delete', methods: ['POST'])]
    public function delete(Request $request, SecteursStructures $secteursStructure, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$secteursStructure->getId(), $request->request->get('_token'))) {
            $entityManager->remove($secteursStructure);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_secteurs_structures_index', [], Response::HTTP_SEE_OTHER);
    }
}
