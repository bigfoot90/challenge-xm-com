<?php

namespace Infrastructure\Controllers;

use Application\CommandQuery\SubmitCommand;
use Application\Handler\SubmitHandler;
use Infrastructure\Forms\MainForm;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route(path="/", name="home")
     */
    public function home(Request $request, SubmitHandler $handler)
    {
        $form = $this->createForm(MainForm::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $result = $handler->handle(SubmitCommand::fromArray($form->getData()));

            dump($result);

            return $this->redirectToRoute('results');
        }

        return $this->render('home.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
