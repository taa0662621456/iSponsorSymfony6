<?php
// TODO: перенести в универсальный CRUD

namespace App\Controller;

use App\Entity\Project\ProjectsTags;
use App\Form\TagsType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/tags")
 */
class TagsController extends AbstractController
{
    /**
     * @Route("/", name="tag_index", methods={"GET"})
     */
    public function index(): Response
    {
        $tags = $this->getDoctrine()
            ->getRepository(Tag::class)
            ->findAll();

        return $this->render('tag/index.html.twig', [
            'tags' => $tags,
        ]);
    }

    /**
     * @Route("/new", name="tag_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $tag = new ProjectsTags();
        $form = $this->createForm(TagsType::class, $tag);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($tag);
            $entityManager->flush();

            return $this->redirectToRoute('tag_index');
        }

        return $this->render('tag/new.html.twig', [
            'tag' => $tag,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="tag_show", methods={"GET"})
     * @param ProjectsTags $tags
     * @return Response
     */
    public function show(ProjectsTags $tags): Response
    {
        return $this->render('tag/show.html.twig', [
            'tag' => $tags,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="tag_edit", methods={"GET","POST"})
     * @param Request $request
     * @param ProjectsTags $tags
     * @return Response
     */
    public function edit(Request $request, ProjectsTags $tags): Response
    {
        $form = $this->createForm(TagsType::class, $tag);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('tag_index');
        }

        return $this->render('tag/edit.html.twig', [
            'tag' => $tag,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="tag_delete", methods={"DELETE"})
     * @param Request $request
     * @param ProjectsTags $tags
     * @return Response
     */
    public function delete(Request $request, ProjectsTags $tags): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tags->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($tags);
            $entityManager->flush();
        }

        return $this->redirectToRoute('tags_index');
    }
}
