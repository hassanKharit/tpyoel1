<?php

namespace App\Controller;

use App\Entity\Commentaire;
use App\Form\CommentaireType;
use App\Repository\CommentaireRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/rcommentaire')]
class RcommentaireController extends AbstractController
{
    #[Route('/', name: 'app_rcommentaire_index', methods: ['GET'])]
    public function index(CommentaireRepository $commentaireRepository): Response
    {
        return $this->render('rcommentaire/index.html.twig', [
            'commentaires' => $commentaireRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_rcommentaire_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CommentaireRepository $commentaireRepository): Response
    {
        $commentaire = new Commentaire();
        $form = $this->createForm(CommentaireType::class, $commentaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $commentaireRepository->save($commentaire, true);

            return $this->redirectToRoute('app_rcommentaire_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('rcommentaire/new.html.twig', [
            'commentaire' => $commentaire,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_rcommentaire_show', methods: ['GET'])]
    public function show(Commentaire $commentaire): Response
    {
        return $this->render('rcommentaire/show.html.twig', [
            'commentaire' => $commentaire,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_rcommentaire_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Commentaire $commentaire, CommentaireRepository $commentaireRepository): Response
    {
        $form = $this->createForm(CommentaireType::class, $commentaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $commentaireRepository->save($commentaire, true);

            return $this->redirectToRoute('app_rcommentaire_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('rcommentaire/edit.html.twig', [
            'commentaire' => $commentaire,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_rcommentaire_delete', methods: ['POST'])]
    public function delete(Request $request, Commentaire $commentaire, CommentaireRepository $commentaireRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$commentaire->getId(), $request->request->get('_token'))) {
            $commentaireRepository->remove($commentaire, true);
        }

        return $this->redirectToRoute('app_rcommentaire_index', [], Response::HTTP_SEE_OTHER);
    }
}
