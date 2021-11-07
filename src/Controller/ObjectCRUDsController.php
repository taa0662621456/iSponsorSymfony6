<?php

namespace App\Controller;

use App\Entity\Project\Project;
use App\Service\Factory\ObjectLanguageLayerFactory;
use App\Service\RequestDispatcher;
use Cocur\Slugify\Slugify;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ObjectCRUDsController extends AbstractController
{
    /**
     * @var RequestDispatcher
     */
    private RequestDispatcher $requestDispatcher;



    public function __construct(RequestDispatcher $requestDispatcher)
    {
        $this->requestDispatcher = $requestDispatcher;
    }

    /**
     * @Route("vendor/", name="vendor_index", methods={"GET"})
     * @Route("vendor/folder", name="vendor_folder_index", methods={"GET"}) //TODO: этот роут может быть только для Вендоров
     *
     * @Route("order/", name="order_index", methods={"GET"})
     *
     * @Route("event/", name="event_index", methods={"GET"})
     * @Route("event/category/", name="event_category_index", methods={"GET"})
     * @Route("event/member/", name="event_member_index", methods={"GET"})
     * @Route("folder/", name="folder_index", methods={"GET"}) //TODO: этот роут может быть только для Админов
     * @Route("product/", name="product_index", methods={"GET"})
     * @Route("project/", name="project_index", methods={"GET"})
     *
     * @Route("commission/", name="commission_index", methods={"GET"})
     *
     * @Route("category/", name="category_index", methods={"GET"})
     * @Route("attachment/", name="attachment_index", methods={"GET"})
     *
     * @Route("review/product/", name="review_index_product", methods={"GET"})
     * @Route("review/project/", name="review_index_project", methods={"GET"})
     *
     * @return Response
     */
    public function index(): Response
    {
        $localeFilter = $this->requestDispatcher->localeFilter();
        ($localeFilter) ? $object = $this->requestDispatcher->objectLanguageLayer(): $object = $this->requestDispatcher->object();
        $em = $this->getDoctrine()->getManager();
        return $this->render($this->requestDispatcher->layOutPath(), [
            $this->requestDispatcher->route() => $em->getRepository($object)->findAll(),
        ]);
    }



    /**
     * @var RequestDispatcher
     */
    private RequestDispatcher $requestDispatcher;

    public function __construct(RequestDispatcher $requestDispatcher)
    {
        $this->requestDispatcher = $requestDispatcher;
    }

    /**
     * @Route("vendor/new/", name="vendor_new", methods={"GET","POST"})
     * @Route("vendor/commission/", name="vendor_new_commission", methods={"GET","POST"})
     *
     * @Route("event/new/", name="event_new", methods={"GET","POST"})
     * @Route("event/category/new/", name="event_new_category", methods={"GET","POST"})
     *
     * @Route("folder/new/", name="folder_new", methods={"GET","POST"})
     * @Route("project/new/", name="project_new", methods={"GET","POST"})
     * @Route("commission/new/", name="commission_new", methods={"GET","POST"}) //TODO: для суперАдминов и только для теста
     * @Route("product/new", name="product_new", methods={"GET","POST"})
     * @Route("category/new", name="category_new", methods={"GET","POST"})
     *
     * @Route("order/new/", name="order_new", methods={"GET","POST"})
     *
     * @Route("attachment/new/", name="attachment_new", methods={"GET","POST"})
     *
     * @Route("review/product/new/", name="review_new_product", methods={"GET", "POST"})
     * @Route("review/project/new/", name="review_new_project", methods={"GET", "POST"})
     *
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        //TODO: need VendorTypeAttach for difference Docs and Media
        $slug = new Slugify();

        $object = $this->requestDispatcher->object();
        $object = new $object;

        $objectEnGb = $this->requestDispatcher->objectEnGb();
        $objectEnGb = new $objectEnGb;

//        $objectAttachment = $this->requestDispatcher->objectAttachment();
//        $objectAttachment = new $objectAttachment;

        $form = $this->createForm($this->requestDispatcher->objectType(), $object);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            if (true == $form->getData()->objectEnGb->getSlug()) {
                $object->setSlug($slug->slugify($objectEnGb->getFirstTitle()));
            }
            $em->persist($object);
            $em->flush();

            return $this->redirect($object);
        }
        return $this->render($this->requestDispatcher->layOutPath(), [
            $this->requestDispatcher->route() => $this->requestDispatcher->object(),
            'form' => $form->createView(),
//            'slug' => (string)$slug->slugify('jhgjhgjghjghjhg')
        ]);
    }

    /**
     * ********************************************
     * WARNING! Routes by 'id' for Back-end or ^ROLE_ADMIN only
     * ********************************************
     * @Route("vendor/{id<\d+>}", name="vendor_show_id", methods={"GET"})
     * @Route("folder/{id<\d+>}", name="folder_show_id", methods={"GET"})
     * @Route("commission/{id<\d+>}", name="commission_show_id", methods={"GET"})
     * @Route("project/{id<\d+>}", name="project_show_id", methods={"GET"})
     * @Route("product/{id<\d+>}", name="product_show_id", methods={"GET"})
     * @Route("category/{id<\d+>}", name="category_show_id", methods={"GET"})
     * @Route("attachment/{id<\d+>}", name="attachment_show_id", methods={"GET"})
     * @Route("review/product/{id<\d+>}", name="review_show_id_product", methods={"GET"})
     * @Route("review/project/{id<\d+>}", name="review_show_id_project", methods={"GET"})
     * @Route("order/{id<\d+>}", name="order_show_id", methods={"GET"})
     * @Route("event/{id<\d+>}", name="event_show_id", methods={"GET"})
     * @Route("event/category/{id<\d+>}", name="event_show_id_category", methods={"GET"})
     *
     * ********************************************
     * Routes by 'slug' for Front-end and Back-end
     * ********************************************
     * @Route("vendor/{slug}", name="vendor_show_slug", methods={"GET"})
     * @Route("folder/{slug}", name="folder_show_slug", methods={"GET"})
     * @Route("commission/{slug}", name="commission_show_slug", methods={"GET"})
     * @Route("project/{slug}", name="project_show_slug", methods={"GET"})
     * @Route("product/{slug}", name="product_show_slug", methods={"GET"})
     * @Route("category/{slug}", name="category_show_slug", methods={"GET"})
     * @Route("attachment/{slug}", name="attachment_show_slug", methods={"GET"})
     *
     * @Route("review/product/{slug}", name="review_show_slug_product", methods={"GET"})
     * @Route("review/project/{slug}", name="review_show_slug_project", methods={"GET"})
     *
     * @Route("order/{slug}", name="order_show_slug", methods={"GET"})
     * @Route("event/{slug}", name="event_show_slug", methods={"GET"})
     * @Route("event/category/{slug}", name="event_show_slug_category", methods={"GET"})
     *
     * @return Response
     */
    public function show(): Response
    {

        $object = $this->requestDispatcher->object();
        return $this->render($this->requestDispatcher->layOutPath(), [
            $this->requestDispatcher->route() => new $object,
        ]);
    }

    /**
     * ********************************************
     * WARNING! Routes by 'id' for Back-end or ^ROLE_ADMIN only
     * ********************************************
     * @Route("vendor/edit/{id<\d+>}", name="vendor_edit_id", methods={"GET","POST"})
     * @Route("folder/edit/{id<\d+>}", name="folder_edit_id", methods={"GET","POST"})
     * @Route("commission/edit/{id<\d+>}", name="commission_edit_id", methods={"GET","POST"})
     * @Route("project/edit/{id<\d+>}", name="project_edit_id", methods={"GET","POST"})
     * @Route("product/edit/{id<\d+>}", name="product_edit_id", methods={"GET","POST"})
     * @Route("category/edit/{id<\d+>}", name="category_edit_id", methods={"GET","POST"})
     * @Route("attachment/edit/{id<\d+>}", name="attachment_edit_id", methods={"GET","POST"})
     * @Route("review/product/edit/{id<\d+>}", name="review_edit_id_product", methods={"GET", "POST"})
     * @Route("review/project/edit/{id<\d+>}", name="review_edit_id_project", methods={"GET", "POST"})
     * @Route("order/edit/{id<\d+>}", name="order_id_edit", methods={"GET", "POST"})
     * @Route("event/edit/{id<\d+>}", name="event_id_edit", methods={"GET", "POST"})
     * @Route("event/category/edit/{id<\d+>}", name="event_edit_id_category", methods={"GET", "POST"})
     *
     * ********************************************
     * Routes by 'slug' for Front-end and Back-end
     * ********************************************
     * @Route("vendor/edit/{slug}", name="vendor_edit_slug", methods={"GET","POST"})
     * @Route("folder/edit/{slug}", name="folder_edit_slug", methods={"GET","POST"})
     * @Route("commission/edit/{slug}", name="commission_edit_slug", methods={"GET","POST"})
     * @Route("project/edit/{slug}", name="project_edit_slug", methods={"GET","POST"})
     * @Route("product/edit/{slug}", name="product_edit_slug", methods={"GET","POST"})
     * @Route("category/edit/{slug}", name="category_edit_slug", methods={"GET","POST"})
     * @Route("attachment/edit/{slug}", name="attachment_edit_slug", methods={"GET","POST"})
     * @Route("review/product/edit/{slug}", name="review_edit_slug_project", methods={"GET", "POST"})
     * @Route("review/project/edit/{slug}", name="review_edit_slug_project", methods={"GET", "POST"})
     * @Route("order/edit/{slug}", name="order_edit_slug", methods={"GET", "POST"})
     * @Route("event/edit/{slug}", name="event_edit_slug", methods={"GET", "POST"})
     * @Route("event/category/edit/{slug}", name="event_edit_slug_category", methods={"GET", "POST"})
     *
     * @return Response
     */
    public function edit(): Response
    {
        $object = $this->requestDispatcher->object();
        $form = $this->createForm($this->requestDispatcher->objectType(), $object);
        $form->handleRequest($object);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute($object);
        }

        return $this->render($this->requestDispatcher->layOutPath(), [
            $this->requestDispatcher->route() => new $object,
            'form' => $form->createView(),
        ]);
    }


    /**
     * ********************************************
     * WARNING! Routes by 'id' for Back-end or ^ROLE_ADMIN only
     * ********************************************
     * @Route("vendor/delete/{id<\d+>}", name="vendor_delete_id", methods={"DELETE"})
     * @Route("folder/delete/{id<\d+>}", name="folder_delete_id", methods={"DELETE"})
     * @Route("commission/delete/{id<\d+>}", name="commission_delete_id", methods={"DELETE"})
     * @Route("project/delete/{id<\d+>}", name="project_delete_id", methods={"DELETE"})
     * @Route("product/delete/{id<\d+>}", name="product_delete_id", methods={"DELETE"})
     * @Route("category/delete/{id<\d+>}", name="category_delete_id", methods={"DELETE"})
     * @Route("attachment/delete/{id<\d+>}", name="attachment_delete_id", methods={"DELETE"})
     * @Route("review/product/delete/{id<\d+>}", name="review_delete_id_product", methods={"DELETE"})
     * @Route("review/project/delete/{id<\d+>}", name="review_delete_id_project", methods={"DELETE"})
     * @Route("order/delete/{id<\d+>}", name="order_delete_id", methods={"DELETE"})
     * @Route("event/delete/{id<\d+>}", name="event_delete_id", methods={"DELETE"})
     * @Route("event/category/delete/{id<\d+>}", name="event_delete_id_category", methods={"DELETE"})
     *
     * ********************************************
     * Routes by 'slug' for Front-end and Back-end
     * ********************************************
     * @Route("vendor/delete/{slug}", name="vendor_delete_slug", methods={"DELETE"})
     * @Route("folder/delete/{slug}", name="folder_delete_slug", methods={"DELETE"})
     * @Route("commission/delete/{slug}", name="commission_delete_slug", methods={"DELETE"})
     * @Route("project/delete/{slug}", name="project_delete_slug", methods={"DELETE"})
     * @Route("product/delete/{slug}", name="product_delete_slug", methods={"DELETE"})
     * @Route("category/delete/{slug}", name="category_delete_slug", methods={"DELETE"})
     * @Route("attachment/delete/{slug}", name="attachment_delete_slug", methods={"DELETE"})
     * @Route("review/product/delete/{slug}", name="review_delete_slug_product", methods={"DELETE"})
     * @Route("review/project/delete/{slug}", name="review_delete_slug_project", methods={"DELETE"})
     * @Route("order/delete/{slug}", name="order_delete_slug", methods={"DELETE"})
     * @Route("event/delete/{slug}", name="event_delete_slug", methods={"DELETE"})
     * @Route("event/category/delete/{slug}", name="event_delete_slug_category", methods={"DELETE"})
     *
     * @param Request $request
     * @return Response
     */
    public function delete(Request $request): Response
    {
        if ($this->isCsrfTokenValid('delete' . $this->requestDispatcher->object()->getId(), $request->get('_token'))) {
            //TODO: в этой строке сделать get по тому признаку, который определен в роуте id/slug
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove((object)$this->requestDispatcher->object());
            $entityManager->flush();
        }

        return $this->redirectToRoute($this->requestDispatcher->object());
    }




//    /**
//     * TODO: метод перенесен в общий AttachmentController  и помечен на удаление
//     * @Route("/", name="vendor_get_attachments", methods={"GET"})
//     * @param Request     $request
//     * @param string|null $entity
//     * @param string|null $layout
//     *
//     * @return Response
//     */
//    public function getAttachments(Request $request,
//                                   string $entity = 'App\Entity\Vendor\VendorMedia',
//                                   string $layout = 'index'): Response
//    {
//        /**
//         * если роль Админ и выше, параметр $createdBy принимается из запроса,
//         * в противном случе = $this->getUser()
//         *
//         */
//
//        if ($request->get('_route') == 'profile') {            //TODO: need add role by ROLE_ADMIN; maybe PHP Switch
//            $createdBy = null;                                 // Vendor is null for template Security
//            $published = true;                                 // ...for marketing security
//            $fileLayoutPosition = $request->get('_route');     // ... for filtering
//            $fileLang = $request->get('app_locale') ?: '*';       // ... for different
//        }
//
//        $attachments = $this->attachmentsManager->getAttachments(
//            $entity = 'App\Entity\Vendor\VendorMedia',
//            $id = null,
//            $slug = null,
//            $createdBy = null, //Important! Must by User object
//            $published = true,
//            $fileLayoutPosition = null,
//            $fileClass = null,
//            $fileLang = null
//        );
//
//    }
//
//
}
