<?php

namespace App\Controller;

use App\Entity\Dirigeant;
use App\Form\DirigeantType;
use App\Repository\DirigeantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/dirigeant')]
class DirigeantController extends AbstractController
{
    #[Route('/', name: 'app_dirigeant_index', methods: ['GET'])]
    public function index(DirigeantRepository $dirigeantRepository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN_ENTREPRISES');

        return $this->render('dirigeant/index.html.twig', [
            'dirigeants' => $dirigeantRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_dirigeant_new', methods: ['GET', 'POST'])]
    public function new(Request $request, DirigeantRepository $dirigeantRepository): Response
    {
        $dirigeant = new Dirigeant();
        $form = $this->createForm(DirigeantType::class, $dirigeant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $dirigeantRepository->save($dirigeant, true);

            return $this->redirectToRoute('app_dirigeant_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('dirigeant/new.html.twig', [
            'dirigeant' => $dirigeant,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_dirigeant_show', methods: ['GET'])]
    public function show(Dirigeant $dirigeant): Response
    {
        return $this->render('dirigeant/show.html.twig', [
            'dirigeant' => $dirigeant,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_dirigeant_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Dirigeant $dirigeant, DirigeantRepository $dirigeantRepository): Response
    {
        $form = $this->createForm(DirigeantType::class, $dirigeant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $dirigeantRepository->save($dirigeant, true);

            return $this->redirectToRoute('app_dirigeant_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('dirigeant/edit.html.twig', [
            'dirigeant' => $dirigeant,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_dirigeant_delete', methods: ['POST'])]
    public function delete(Request $request, Dirigeant $dirigeant, DirigeantRepository $dirigeantRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$dirigeant->getId(), $request->request->get('_token'))) {
            $dirigeantRepository->remove($dirigeant, true);
        }

        return $this->redirectToRoute('app_dirigeant_index', [], Response::HTTP_SEE_OTHER);
    }
}
