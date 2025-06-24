<?php

namespace App\Controller;

use App\Entity\Glace;
use App\Form\GlaceTypeForm;
use App\Repository\GlaceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class CréationDesGlacesController extends AbstractController
{
    #[Route('/glaces', name: 'glaces')]
    public function index(GlaceRepository $repository): Response
    {
        $glaces = $repository->findAll();
        return $this->render('création_des_glaces/index.html.twig', [
            'glaces' => $glaces,
        ]);
    }

    #[Route('/creation_des_glaces', name: 'creation_des_glaces')]
    public function createglace(Request $request, EntityManagerInterface $entityManager): Response
    {
        $glace = new Glace();

        $form = $this->createForm(GlaceTypeForm::class, $glace);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($glace);

            $entityManager->flush();

            $this->addFlash('succes', 'Glace ajouté');
            return $this->redirectToRoute('glaces');
        }
        return $this->render('création_des_glaces/creation_glace.html.twig', [
            'glaceform' => $form->createView(),
        ]);
    }

    #[Route('/modif_des_glaces/{id}', name: 'modif_des_glaces')]
    public function modify(Glace $glace, Request $request, EntityManagerInterface $entityManager): Response
    {

        $form = $this->createForm(GlaceTypeForm::class, $glace);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($glace);

            $entityManager->flush();

            $this->addFlash('success', 'Glace ajouté');
            return $this->redirectToRoute('glaces');
        }
        return $this->render('création_des_glaces/modif_glace.html.twig', [
            'glaceform' => $form->createView(),
        ]);
    }

    #[Route('/delete_des_glaces/{id}', name: 'delete_des_glaces')]
    public function delete(Glace $glace, Request $request, EntityManagerInterface $entityManager): Response
    {

        if ($this->isCsrfTokenValid("SUP" . $glace->getId(), $request->get('_token'))) {

            $entityManager->remove($glace);

            $entityManager->flush();

            $this->addFlash('succes', 'Glace supprimer');
            return $this->redirectToRoute('glaces');
        }
        return $this->redirectToRoute('glaces');
    }
}
