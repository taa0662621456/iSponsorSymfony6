<?php


namespace App\Trash;


use Cocur\Slugify\Slugify;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CRUDsController extends AbstractController
{

    /**
     * @var RequestStack
     */
    private $requestStack;

    private $object;

    public $crud;

    private $route;

    /**
     * @var string
     */
    private $type;
    /**
     * @var string
     */
    private $path;


    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
        $this->object = current(explode($requestStack->getMasterRequest()->attributes->get('_route'), 1));
        $this->crud = end(explode($requestStack->getMasterRequest()->attributes->get('_route'), 2));
        $this->route =& $this->object;
        $this->type = 'App\\src\\Form\\'. $this->object . '\\' . $this->object . 'Type';
        $this->path = $this->object . '/' . $this->object . '/' . $this->crud . '.html.twig'; //TODO: не продумана структура папок, в частности не клеится с Categories (окончание не "y")
    }

    /**
     * @Route("vendors/", name="vendors", methods={"GET"})
     * @Route("products/", name="products", methods={"GET"})
     * @Route("projects/", name="projects", methods={"GET"})
     * @Route("categories/", name="categories", methods={"GET"})
     * @Route("attachments/", name="attachments", methods={"GET"})
     *
     * @return Response
     */
    public function categories(): Response
    {
        return $this->render($this->path, array(
                'object' => $this->object->findAll(),
            )
        );
    }

    /**
     * @Route("/vendor/new", name="vendor_new", methods={"GET","POST"})
     * @Route("/project/new", name="project_new", methods={"GET","POST"})
     * @Route("/product/new", name="product_new", methods={"GET","POST"})
     * @Route("/category/new", name="category_new", methods={"GET","POST"})
     * @Route("/attachment/new", name="attachment_new", methods={"GET","POST"})
     *
     * @param Request $request
     * @return Response
     */
    public function new(Request $request)
    {
        //TODO: need VendorTypeAttach for difference Docs and Media
        $slug = new Slugify();
        $object = new $this->object;
        $objectEnGb = $this->object . 'EnGb';
        $objectEnGb = new $objectEnGb;
        $objectAttachment = $this->object . 'Attachment';
        $objectAttachment = new $objectAttachment;
        $type =& $this->type;
        $form = $this->createForm($type, $object);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            if (true==$form->getData()->objectEnGb->getSlug()){
                $object->setSlug($slug->slugify($objectEnGb->get000000()));//TODO: нужно продумать для всех объектов поле-эквивалент FirstName (для Vendor) или вынести в отдельного слушателя для отдельного объекта
            }
            $em->persist($object);
            $em->flush();

            return $this->redirect($object);
        }

        return $this->render($this->path, array(
            'object' => $this->object,
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/vendor/{id<\d+>}", name="vendor_show", methods={"GET"})
     * @Route("/project/{id<\d+>}", name="project_show", methods={"GET"})
     * @Route("/product/{id<\d+>}", name="product_show", methods={"GET"})
     * @Route("/category/{id<\d+>}", name="category_show", methods={"GET"})
     * @Route("/attachment/{id<\d+>}", name="attachment_show", methods={"GET"})
     *
     * @return Response
     */
    public function show(): Response
    {
        return $this->render($this->path, array(
            'object' => $this->object,
        ));
    }

    /**
     * @Route("/vendor/{id<\d+>}/edit", name="vendor_edit", methods={"GET","POST"})
     * @Route("/project/{id<\d+>}/edit", name="project_edit", methods={"GET","POST"})
     * @Route("/product/{id<\d+>}/edit", name="product_edit", methods={"GET","POST"})
     * @Route("/category/{id<\d+>}/edit", name="category_edit", methods={"GET","POST"})
     * @Route("/attachment/{id<\d+>}/edit", name="attachment_edit", methods={"GET","POST"})
     *
     * @return Response
     */
    public function edit(): Response
    {
        $form = $this->createForm($this->type, $this->object);
        $form->handleRequest($this->object);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute($this->object);
        }

        return $this->render($this->path, array(
            'object' => $this->object,
            'form' => $form->createView(),
        ));
    }


    /**
     * @Route("/vendor/{id<\d+>}", name="vendor_delete", methods={"DELETE"})
     * @Route("/project/{id<\d+>}", name="project_delete", methods={"DELETE"})
     * @Route("/product/{id<\d+>}", name="product_delete", methods={"DELETE"})
     * @Route("/category/{id<\d+>}", name="category_delete", methods={"DELETE"})
     * @Route("/attachment/{id<\d+>}", name="attachment_delete", methods={"DELETE"})
     *
     * @param Request $request
     * @return Response
     */
    public function delete(Request $request): Response
    {
        if ($this->isCsrfTokenValid('delete' . $this->object->getId(), $request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($this->object);
            $entityManager->flush();
        }

        return $this->redirectToRoute($this->object);
    }
}