<?php

namespace App\Controller;

use App\Entity\Structure;
use App\Form\SearchType;
use App\Form\StructureType;
use App\UtilsClass\Search;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/structure')]
class StructureController extends AbstractController
{
    #[Route('/', name: 'app_structure_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $structures = $entityManager
            ->getRepository(Structure::class)
            ->findAll();

        return $this->render('structure/index.html.twig', [
            'structures' => $structures,
        ]);
    }

    #[Route('/new', name: 'app_structure_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $structure = new Structure();
        $form = $this->createForm(StructureType::class, $structure);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $structureLogo = $form->get('logo')->getData();
            $originalFilename = pathinfo($structureLogo->getClientOriginalName(), PATHINFO_FILENAME);
            $newFilename = $originalFilename . '-' . uniqid() . '.' . $structureLogo->guessExtension();

            if ($structureLogo) {
                try {
                    $structureLogo->move(
                        $this->getParameter('file_path'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }
                $structure->setLogo($newFilename);
            }


            $entityManager->persist($structure);
            $entityManager->flush();

            return $this->redirectToRoute('app_structure_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('structure/new.html.twig', [
            'structure' => $structure,
            'form' => $form,
        ]);
    }

    #[Route('/search/struc', name: 'app_structure_search', methods: ['GET', 'POST'])]
    public function search(Request $request, EntityManagerInterface $entityManager): Response
    {
        $search = new Search();
        $form = $this->createForm(SearchType::class, $search);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $repository = $entityManager->getRepository(Structure::class);
            $structure = $repository->findOneBy(['nom' => $search->getNom()]);

            return $this->redirectToRoute('app_structure_show', [
                'id' => $structure->getId()
            ]);
        }

        return $this->renderForm('structure/search.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_structure_show', methods: ['GET'])]
    public function show(Structure $structure): Response
    {
        return $this->render('structure/show.html.twig', [
            'structure' => $structure,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_structure_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Structure $structure, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(StructureType::class, $structure);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_structure_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('structure/edit.html.twig', [
            'structure' => $structure,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_structure_delete', methods: ['POST'])]
    public function delete(Request $request, Structure $structure, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $structure->getId(), $request->request->get('_token'))) {
            $entityManager->remove($structure);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_structure_index', [], Response::HTTP_SEE_OTHER);
    }
}
