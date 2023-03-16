<?php

namespace App\Controller;

use App\Form\FormJeuType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class JeuFormController extends AbstractController
{
    #[Route('/jeu_form', name: 'app_jeu_form')]
    public function index(Request $request): Response
    {
        $form=$this->createForm(FormJeuType::class);

        $form->handleRequest( $request);

        if($form->isSubmitted() && $form->isValid())
        {

            $data=$form->getData();
            
            $data['alea'] = rand(1,100);

            if ($data['alea'] == $data['number']) {
                $data['reponse']="vous avez gagné, c'est bien joué";
            } else {
                $data['reponse']="vous avez perdu, dommage !!";
            }


        
            return $this->render('jeu_form/traitement.html.twig', [
                'hassoun' => $data,
                
            ]);
        }
            return $this->renderForm('jeu_form/index.html.twig',
            [
                'form' =>$form
            ]);
    }

}