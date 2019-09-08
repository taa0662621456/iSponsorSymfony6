<?php

namespace App\Controller;

use App\Entity\PlatformLang;
use App\Form\PlatformLangType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/languages")
 */
class PlatformLangController extends AbstractController
{
    /**
     * @Route("/", name="languages_index", methods={"GET"})
     */
    public function index(): Response
    {
        $languages = $this->getDoctrine()
            ->getRepository(PlatformLang::class)
            ->findAll();

        return $this->render('languages/index.html.twig', [
            'languages' => $languages,
        ]);
    }

    /**
     * @Route("/new", name="languages_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $language = new PlatformLang();
        $form = $this->createForm(PlatformLangType::class, $language);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($language);
            $entityManager->flush();

            return $this->redirectToRoute('languages_index');
        }

        return $this->render('languages/new.html.twig', [
            'language' => $language,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{langId}", name="languages_show", methods={"GET"})
     * @param PlatformLang $language
     * @return Response
     */
    public function show(PlatformLang $language): Response
    {
        return $this->render('languages/show.html.twig', [
            'language' => $language,
        ]);
    }

    /**
     * @Route("/{langId}/edit", name="languages_edit", methods={"GET","POST"})
     * @param Request $request
     * @param PlatformLang $language
     * @return Response
     */
    public function edit(Request $request, PlatformLang $language): Response
    {
        $form = $this->createForm(PlatformLangType::class, $language);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('languages_index');
        }

        return $this->render('languages/edit.html.twig', [
            'language' => $language,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{langId}", name="languages_delete", methods={"DELETE"})
     * @param Request $request
     * @param PlatformLang $language
     * @return Response
     */
    public function delete(Request $request, PlatformLang $language): Response
    {
        if ($this->isCsrfTokenValid('delete'.$language->getLangId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($language);
            $entityManager->flush();
        }

        return $this->redirectToRoute('languages_index');
    }
}
