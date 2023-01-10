<?php

namespace App\Controller;

use App\Service\RequestDispatcher;
use Doctrine\Persistence\ManagerRegistry;
use JetBrains\PhpStorm\NoReturn;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;

#[AsController]
class ObjectCRUDsController extends AbstractController
{
    #[NoReturn]
    public function __construct(private readonly RequestDispatcher $requestDispatcher,
                                private readonly ManagerRegistry $managerRegistry)
    {
    }

    // https://digitalfortress.tech/tutorial/rest-api-with-symfony-and-api-platform/
    //    public function __invoke(string $slug)
    //    {
    //        $object = $this->getDoctrine()
    //            ->getRepository($object::class)
    //            ->findBy('slug' => $slug);
    //        return $object;
    //    }

    // Index
    #[Route(path: 'vendor/', name: 'vendor_index', methods: ['GET'])]
    #[Route(path: 'vendor/folder', name: 'vendor_folder_index', methods: ['GET'])]
    #[Route(path: 'order/', name: 'order_index', methods: ['GET'])]
    #[Route(path: 'event/', name: 'event_index', methods: ['GET'])]
    #[Route(path: 'event/category/', name: 'event_index_category', methods: ['GET'])]
    #[Route(path: 'event/member/', name: 'event_index_member', methods: ['GET'])]
    #[Route(path: 'folder/', name: 'folder_index', methods: ['GET'])]
    #[Route(path: 'product/', name: 'product_index', methods: ['GET'])]
    #[Route(path: 'product/price/', name: 'product_index_price', methods: ['GET'])]
    #[Route(path: 'product/attachment/', name: 'product_index_attachment', methods: ['GET'])]
    #[Route(path: 'project/', name: 'project_index', methods: ['GET'])]
    #[Route(path: 'project/attachment/', name: 'project_index_attachment', methods: ['GET'])]
    #[Route(path: 'commission/', name: 'commission_index', methods: ['GET'])]
    #[Route(path: 'category/', name: 'category_index', methods: ['GET'])]
    #[Route(path: 'attachment/', name: 'attachment_index', methods: ['GET'])]
    #[Route(path: 'review/product/', name: 'review_index_product', methods: ['GET'])]
    #[Route(path: 'review/project/', name: 'review_index_project', methods: ['GET'])]
    #[Route(path: 'taxation/', name: 'taxation_index', methods: ['GET'])]
    #[Route(path: 'taxation/zone/', name: 'taxation_index_zone', methods: ['GET'])]
    #[Route(path: 'taxation/category/', name: 'taxation_index_category', methods: ['GET'])]
    #[Route(path: 'shipment/', name: 'shipment_index', methods: ['GET'])]
    #[Route(path: 'shipment/category/', name: 'shipment_index_category', methods: ['GET'])]
    #[Route(path: 'payment/', name: 'payment_index', methods: ['GET'])]
    #[Route(path: 'payment/category/', name: 'payment_index_category', methods: ['GET'])]
    #[Route(path: 'coupon/', name: 'coupon_index', methods: ['GET'])]
    #[Route(path: 'currency/', name: 'currency_index', methods: ['GET'])]
    #[Route(path: 'role/', name: 'role_index', methods: ['GET'])]
    #[Route(path: 'storage/', name: 'storage_index', methods: ['GET'])]
    public function index(): Response
    {
        $localeFilter = $this->requestDispatcher->localeFilter();
        ($localeFilter) ? $object = $this->requestDispatcher->objectLanguageLayer() : $object = $this->requestDispatcher->object();
        $em = $this->managerRegistry->getManager();
        // TODO: определяем уровень прав пользователя и если Юзер
        //        ($this->getUser()) ?
        //            $q = $em->getRepository($object)->findAll():
        //            $q = $em->getRepository($object)->findBy(
        //                ['createdBy' => $this->getUser()]
        //            );
        return $this->render($this->requestDispatcher->layOutPath(), [
            $this->requestDispatcher->route() => $em->getRepository($object)->findAll(),
        ]);
    }

    // New
    #[Route(path: 'vendor/new/', name: 'vendor_new', methods: ['GET', 'POST'])]
    #[Route(path: 'vendor/commission/new/', name: 'vendor_new_commission', methods: ['GET', 'POST'])]
    #[Route(path: 'vendor/profile/new/', name: 'vendor_new_profile', methods: ['GET', 'POST'])]
    #[Route(path: 'event/new/', name: 'event_new', methods: ['GET', 'POST'])]
    #[Route(path: 'event/category/new/', name: 'event_new_category', methods: ['GET', 'POST'])]
    #[Route(path: 'folder/new/', name: 'folder_new', methods: ['GET', 'POST'])]
    #[Route(path: 'project/new/', name: 'project_new', methods: ['GET', 'POST'])]
    #[Route(path: 'commission/new/', name: 'commission_new', methods: ['GET', 'POST'])]
    #[Route(path: 'product/new/', name: 'product_new', methods: ['GET', 'POST'])]
    #[Route(path: 'product/price/new/', name: 'product_new_price', methods: ['GET', 'POST'])]
    #[Route(path: 'category/new/', name: 'category_new', methods: ['GET', 'POST'])]
    #[Route(path: 'order/new/', name: 'order_new', methods: ['GET', 'POST'])]
    #[Route(path: 'attachment/new/', name: 'attachment_new', methods: ['GET', 'POST'])]
    #[Route(path: 'review/product/new/', name: 'review_new_product', methods: ['GET', 'POST'])]
    #[Route(path: 'review/project/new/', name: 'review_new_project', methods: ['GET', 'POST'])]
    #[Route(path: 'taxation/new/', name: 'taxation_new', methods: ['GET', 'POST'])]
    #[Route(path: 'taxation/zone/new/', name: 'taxation_new_zone', methods: ['GET', 'POST'])]
    #[Route(path: 'taxation/category/new/', name: 'taxation_new_category', methods: ['GET', 'POST'])]
    #[Route(path: 'shipment/new/', name: 'shipment_new', methods: ['GET', 'POST'])]
    #[Route(path: 'shipment/category/new/', name: 'shipment_new_category', methods: ['GET', 'POST'])]
    #[Route(path: 'payment/new/', name: 'payment_new', methods: ['GET', 'POST'])]
    #[Route(path: 'payment/category/new/', name: 'payment_new_category', methods: ['GET', 'POST'])]
    #[Route(path: 'coupon/new/', name: 'coupon_new', methods: ['GET', 'POST'])]
    #[Route(path: 'currency/new/', name: 'currency_new', methods: ['GET', 'POST'])]
    #[Route(path: 'role/new/', name: 'role_new', methods: ['GET', 'POST'])]
    #[Route(path: 'storage/new/', name: 'storage_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $object = $this->requestDispatcher->object();
        $object = new $object();

//        $objectEnGb = $this->requestDispatcher->objectEnGb(); //TODO: подменить/заменить мультиязычностью
//        $objectEnGb = new $objectEnGb; //TODO: подменить/заменить мультиязычностью

        $objectAttachment = $this->requestDispatcher->objectAttachment();
        $objectAttachment = new $objectAttachment();

        $form = $this->createForm($this->requestDispatcher->objectType(), $object);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->managerRegistry->getManager();
            $em->persist($object);
//            $em->persist($objectEnGb); //TODO: подменить/заменить мультиязычностью
            $em->flush();

            $route = $form->get('submitAndNew')->isClicked()
                ? $object.'_new'
                : $object.'_index';

            return $this->redirectToRoute($route);
        }

        return $this->render($this->requestDispatcher->layOutPath(), [
            $this->requestDispatcher->route() => $this->requestDispatcher->object(),
            'form' => $form->createView(),
        ]);
    }

    // Show
    /**
     * ********************************************
     * WARNING! Routes by 'id' for Back-end or ^ROLE_ADMIN only.
     * ********************************************
     */
    #[Route(path: 'vendor/{id<\d+>}', name: 'vendor_show_id', methods: ['GET'])]
    #[Route(path: 'vendor/profile/{id<\d+>}', name: 'vendor_show_id_profile', methods: ['GET'])]
    #[Route(path: 'vendor/payment/{id<\d+>}', name: 'vendor_show_id_payment', methods: ['GET'])]
    #[Route(path: 'vendor/shipment/{id<\d+>}', name: 'vendor_show_id_shipment', methods: ['GET'])]
    #[Route(path: 'folder/{id<\d+>}', name: 'folder_show_id', methods: ['GET'])]
    #[Route(path: 'commission/{id<\d+>}', name: 'commission_show_id', methods: ['GET'])]
    #[Route(path: 'project/{id<\d+>}', name: 'project_show_id', methods: ['GET'])]
    #[Route(path: 'project/attachment/{id<\d+>}', name: 'project_show_id_attachment', methods: ['GET'])]
    #[Route(path: 'product/attachment/{id<\d+>}', name: 'product_show_id_attachment', methods: ['GET'])]
    #[Route(path: 'product/price/{id<\d+>}', name: 'product_show_id_price', methods: ['GET'])]
    #[Route(path: 'product/payment/{id<\d+>}', name: 'product_show_id_payment', methods: ['GET'])]
    #[Route(path: 'product/shipment/{id<\d+>}', name: 'product_show_id_shipment', methods: ['GET'])]
    #[Route(path: 'category/{id<\d+>}', name: 'category_show_id', methods: ['GET'])]
    #[Route(path: 'attachment/{id<\d+>}', name: 'attachment_show_id', methods: ['GET'])]
    #[Route(path: 'review/product/{id<\d+>}', name: 'review_show_id_product', methods: ['GET'])]
    #[Route(path: 'review/project/{id<\d+>}', name: 'review_show_id_project', methods: ['GET'])]
    #[Route(path: 'order/{id<\d+>}', name: 'order_show_id', methods: ['GET'])]
    #[Route(path: 'order/payment/{id<\d+>}', name: 'order_show_id_payment', methods: ['GET'])]
    #[Route(path: 'order/shipment/{id<\d+>}', name: 'order_show_id_shipment', methods: ['GET'])]
    #[Route(path: 'event/{id<\d+>}', name: 'event_show_id', methods: ['GET'])]
    #[Route(path: 'event/category/{id<\d+>}', name: 'event_show_id_category', methods: ['GET'])]
    #[Route(path: 'taxation/{id<\d+>}', name: 'taxation_show_id', methods: ['GET'])]
    #[Route(path: 'taxation/zone/{id<\d+>}', name: 'taxation_show_id_zone', methods: ['GET'])]
    #[Route(path: 'taxation/category/{id<\d+>}', name: 'taxation_show_id_category', methods: ['GET'])]
    #[Route(path: 'shipment/{id<\d+>}', name: 'shipment_show_id', methods: ['GET'])]
    #[Route(path: 'shipment/category/{id<\d+>}', name: 'shipment_show_id_category', methods: ['GET'])]
    #[Route(path: 'payment/{id<\d+>}', name: 'payment_show_id', methods: ['GET'])]
    #[Route(path: 'payment/category/{id<\d+>}', name: 'payment_show_id_category', methods: ['GET'])]
    #[Route(path: 'coupon/{id<\d+>}', name: 'coupon_show_id', methods: ['GET'])]
    #[Route(path: 'currency/{id<\d+>}', name: 'currency_show_id', methods: ['GET'])]
    #[Route(path: 'role/{id<\d+>}', name: 'role_show_id', methods: ['GET'])]
    #[Route(path: 'storage/{id<\d+>}', name: 'storage_show_id', methods: ['GET'])]
    /**
     * ********************************************
     * Routes by 'slug' for Front-end and Back-end.
     * ********************************************
     */
    #[Route(path: 'vendor/{slug}', name: 'vendor_show_slug', methods: ['GET'])]
    #[Route(path: 'vendor/profile/{slug}', name: 'vendor_show_slug_profile', methods: ['GET'])]
    #[Route(path: 'vendor/payment/{slug}', name: 'vendor_show_slug_payment', methods: ['GET'])]
    #[Route(path: 'vendor/shipment/{slug}', name: 'vendor_show_slug_shipment', methods: ['GET'])]
    #[Route(path: 'folder/{slug}', name: 'folder_show_slug', methods: ['GET'])]
    #[Route(path: 'commission/{slug}', name: 'commission_show_slug', methods: ['GET'])]
    #[Route(path: 'project/{slug}', name: 'project_show_slug', methods: ['GET'])]
    #[Route(path: 'project/attachment/{slug}', name: 'project_show_slug_attachment', methods: ['GET'])]
    #[Route(path: 'product/{slug}', name: 'product_show_slug', methods: ['GET'])]
    #[Route(path: 'product/attachment/{slug}', name: 'product_show_slug_attachment', methods: ['GET'])]
    #[Route(path: 'product/price/{slug}', name: 'product_show_slug_price', methods: ['GET'])]
    #[Route(path: 'product/payment/{slug}', name: 'product_show_slug_payment', methods: ['GET'])]
    #[Route(path: 'product/shipment/{slug}', name: 'product_show_slug_shipment', methods: ['GET'])]
    #[Route(path: 'category/{slug}', name: 'category_show_slug', methods: ['GET'])]
    #[Route(path: 'attachment/{slug}', name: 'attachment_show_slug', methods: ['GET'])]
    #[Route(path: 'review/product/{slug}', name: 'review_show_slug_product', methods: ['GET'])]
    #[Route(path: 'review/project/{slug}', name: 'review_show_slug_project', methods: ['GET'])]
    #[Route(path: 'order/{slug}', name: 'order_show_slug', methods: ['GET'])]
    #[Route(path: 'order/payment/{slug}', name: 'order_show_slug_payment', methods: ['GET'])]
    #[Route(path: 'order/shipment/{slug}', name: 'order_show_slug_shipment', methods: ['GET'])]
    #[Route(path: 'event/{slug}', name: 'event_show_slug', methods: ['GET'])]
    #[Route(path: 'event/category/{slug}', name: 'event_show_slug_category', methods: ['GET'])]
    #[Route(path: 'taxation/{slug}', name: 'taxation_show_slug', methods: ['GET'])]
    #[Route(path: 'taxation/zone/{slug}', name: 'taxation_show_slug_zone', methods: ['GET'])]
    #[Route(path: 'taxation/category/{slug}', name: 'taxation_show_slug_category', methods: ['GET'])]
    #[Route(path: 'shipment/{slug}', name: 'shipment_show_slug', methods: ['GET'])]
    #[Route(path: 'shipment/category/{slug}', name: 'shipment_show_slug_category', methods: ['GET'])]
    #[Route(path: 'payment/{slug}', name: 'payment_show_slug', methods: ['GET'])]
    #[Route(path: 'payment/category/{slug}', name: 'payment_show_slug_category', methods: ['GET'])]
    #[Route(path: 'coupon/{slug}', name: 'coupon_show_slug', methods: ['GET'])]
    #[Route(path: 'currency/{slug}', name: 'currency_show_slug', methods: ['GET'])]
    #[Route(path: 'role/{slug}', name: 'role_show_slug', methods: ['GET'])]
    #[Route(path: 'storage/{slug}', name: 'storage_show_slug', methods: ['GET'])]
    public function show(Request $request): Response
    {
        //        return $this->render(
        //            'vendor/vendor_profile/profile.html.twig', array(
        //                'vendor' => $vendorsRepository->findBy(
        //                    array('slug' => $this->getUser())
        //                ),
        //            )
        //        );
        $object = $this->requestDispatcher->object();

        return $this->render($this->requestDispatcher->layOutPath(), [
            $this->requestDispatcher->route() => new $object(),
        ]);
    }

    // Edit
    /**
     * ********************************************
     * WARNING! Routes by 'id' for Back-end or ^ROLE_ADMIN only.
     * ********************************************
     */
    #[Route(path: 'vendor/edit/{id<\d+>}', name: 'vendor_edit_id', methods: ['GET', 'POST'])]
    #[Route(path: 'vendor/payment/edit/{id<\d+>}', name: 'vendor_edit_id_payment', methods: ['GET', 'POST'])]
    #[Route(path: 'vendor/shipment/edit/{id<\d+>}', name: 'vendor_edit_id_payment', methods: ['GET', 'POST'])]
    #[Route(path: 'folder/edit/{id<\d+>}', name: 'folder_edit_id', methods: ['GET', 'POST'])]
    #[Route(path: 'commission/edit/{id<\d+>}', name: 'commission_edit_id', methods: ['GET', 'POST'])]
    #[Route(path: 'project/edit/{id<\d+>}', name: 'project_edit_id', methods: ['GET', 'POST'])]
    #[Route(path: 'product/edit/{id<\d+>}', name: 'product_edit_id', methods: ['GET', 'POST'])]
    #[Route(path: 'product/price/edit/{id<\d+>}', name: 'product_edit_id_price', methods: ['GET', 'POST'])]
    #[Route(path: 'product/payment/edit/{id<\d+>}', name: 'product_edit_id_payment', methods: ['GET', 'POST'])]
    #[Route(path: 'product/shipment/edit/{id<\d+>}', name: 'product_edit_id_shipment', methods: ['GET', 'POST'])]
    #[Route(path: 'category/edit/{id<\d+>}', name: 'category_edit_id', methods: ['GET', 'POST'])]
    #[Route(path: 'attachment/edit/{id<\d+>}', name: 'attachment_edit_id', methods: ['GET', 'POST'])]
    #[Route(path: 'review/product/edit/{id<\d+>}', name: 'review_edit_id_product', methods: ['GET', 'POST'])]
    #[Route(path: 'review/project/edit/{id<\d+>}', name: 'review_edit_id_project', methods: ['GET', 'POST'])]
    #[Route(path: 'order/edit/{id<\d+>}', name: 'order_id_edit', methods: ['GET', 'POST'])]
    #[Route(path: 'event/edit/{id<\d+>}', name: 'event_id_edit', methods: ['GET', 'POST'])]
    #[Route(path: 'event/category/edit/{id<\d+>}', name: 'event_edit_id_category', methods: ['GET', 'POST'])]
    #[Route(path: 'taxation/edit/{id<\d+>}', name: 'taxation_edit_id', methods: ['GET', 'POST'])]
    #[Route(path: 'taxation/zone/edit/{id<\d+>}', name: 'taxation_edit_id_zone', methods: ['GET', 'POST'])]
    #[Route(path: 'taxation/category/edit/{id<\d+>}', name: 'taxation_edit_id_category', methods: ['GET', 'POST'])]
    #[Route(path: 'shipment/edit/{id<\d+>}', name: 'shipment_edit_id', methods: ['GET', 'POST'])]
    #[Route(path: 'shipment/category/edit/{id<\d+>}', name: 'shipment_edit_id_category', methods: ['GET', 'POST'])]
    #[Route(path: 'payment/edit/{id<\d+>}', name: 'payment_edit_id', methods: ['GET', 'POST'])]
    #[Route(path: 'coupon/edit/{id<\d+>}', name: 'coupon_edit_id', methods: ['GET', 'POST'])]
    #[Route(path: 'currency/edit/{id<\d+>}', name: 'currency_edit_id', methods: ['GET', 'POST'])]
    #[Route(path: 'role/edit/{id<\d+>}', name: 'role_edit_id', methods: ['GET', 'POST'])]
    #[Route(path: 'storage/edit/{id<\d+>}', name: 'storage_edit_id', methods: ['GET', 'POST'])]
    /**
     * ********************************************
     * Routes by 'slug' for Front-end and Back-end.
     * ********************************************
     */
    #[Route(path: 'vendor/edit/{slug}', name: 'vendor_edit_slug', methods: ['GET', 'POST'])]
    #[Route(path: 'vendor/payment/edit/{slug}', name: 'vendor_edit_slug_payment', methods: ['GET', 'POST'])]
    #[Route(path: 'vendor/shipment/edit/{slug}', name: 'vendor_edit_slug_shipment', methods: ['GET', 'POST'])]
    #[Route(path: 'folder/edit/{slug}', name: 'folder_edit_slug', methods: ['GET', 'POST'])]
    #[Route(path: 'commission/edit/{slug}', name: 'commission_edit_slug', methods: ['GET', 'POST'])]
    #[Route(path: 'project/edit/{slug}', name: 'project_edit_slug', methods: ['GET', 'POST'])]
    #[Route(path: 'product/edit/{slug}', name: 'product_edit_slug', methods: ['GET', 'POST'])]
    #[Route(path: 'product/price/edit/{slug}', name: 'product_edit_slug_price', methods: ['GET', 'POST'])]
    #[Route(path: 'product/payment/edit/{slug}', name: 'product_edit_slug_payment', methods: ['GET', 'POST'])]
    #[Route(path: 'product/shipment/edit/{slug}', name: 'product_edit_slug_shipment', methods: ['GET', 'POST'])]
    #[Route(path: 'category/edit/{slug}', name: 'category_edit_slug', methods: ['GET', 'POST'])]
    #[Route(path: 'attachment/edit/{slug}', name: 'attachment_edit_slug', methods: ['GET', 'POST'])]
    #[Route(path: 'review/product/edit/{slug}', name: 'review_edit_slug_project', methods: ['GET', 'POST'])]
    #[Route(path: 'review/project/edit/{slug}', name: 'review_edit_slug_project', methods: ['GET', 'POST'])]
    #[Route(path: 'order/edit/{slug}', name: 'order_edit_slug', methods: ['GET', 'POST'])]
    #[Route(path: 'event/edit/{slug}', name: 'event_edit_slug', methods: ['GET', 'POST'])]
    #[Route(path: 'event/category/edit/{slug}', name: 'event_edit_slug_category', methods: ['GET', 'POST'])]
    #[Route(path: 'taxation/edit/{slug}', name: 'taxation_edit_slug', methods: ['GET', 'POST'])]
    #[Route(path: 'taxation/zone/edit/{slug}', name: 'taxation_edit_slug_zone', methods: ['GET', 'POST'])]
    #[Route(path: 'taxation/category/edit/{slug}', name: 'taxation_edit_slug_category', methods: ['GET', 'POST'])]
    #[Route(path: 'shipment/edit/{slug}', name: 'taxation_edit_slug', methods: ['GET', 'POST'])]
    #[Route(path: 'shipment/category/edit/{slug}', name: 'shipment_edit_slug', methods: ['GET', 'POST'])]
    #[Route(path: 'payment/edit/{slug}', name: 'payment_edit_slug', methods: ['GET', 'POST'])]
    #[Route(path: 'payment/category/edit/{slug}', name: 'payment_edit_slug', methods: ['GET', 'POST'])]
    #[Route(path: 'coupon/edit/{slug}', name: 'coupon_edit', methods: ['GET', 'POST'])]
    #[Route(path: 'currency/edit/{slug}', name: 'currency_edit', methods: ['GET', 'POST'])]
    #[Route(path: 'role/edit/{slug}', name: 'role_edit', methods: ['GET', 'POST'])]
    #[Route(path: 'storage/edit/{slug}', name: 'storage_edit', methods: ['GET', 'POST'])]
    public function edit(?int $id, ?string $slug): Response
    {
        $object = $this->requestDispatcher->object();
        $form = $this->createForm($this->requestDispatcher->objectType(), $object);
        $form->handleRequest($object);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->managerRegistry->getManager()->flush();

            return $this->redirectToRoute($object);
        }

        return $this->render($this->requestDispatcher->layOutPath(), [
            $this->requestDispatcher->route() => new $object(),
            'form' => $form->createView(),
        ]);
    }

    // Delete
    /**
     * ********************************************
     * WARNING! Routes by 'id' for Back-end or ^ROLE_ADMIN only.
     * ********************************************
     */
    #[Route(path: 'vendor/delete/{id<\d+>}', name: 'vendor_delete_id', methods: ['DELETE'])]
    #[Route(path: 'folder/delete/{id<\d+>}', name: 'folder_delete_id', methods: ['DELETE'])]
    #[Route(path: 'commission/delete/{id<\d+>}', name: 'commission_delete_id', methods: ['DELETE'])]
    #[Route(path: 'project/delete/{id<\d+>}', name: 'project_delete_id', methods: ['DELETE'])]
    #[Route(path: 'product/delete/{id<\d+>}', name: 'product_delete_id', methods: ['DELETE'])]
    #[Route(path: 'product/price/delete/{id<\d+>}', name: 'product_delete_id_price', methods: ['DELETE'])]
    #[Route(path: 'category/delete/{id<\d+>}', name: 'category_delete_id', methods: ['DELETE'])]
    #[Route(path: 'attachment/delete/{id<\d+>}', name: 'attachment_delete_id', methods: ['DELETE'])]
    #[Route(path: 'review/product/delete/{id<\d+>}', name: 'review_delete_id_product', methods: ['DELETE'])]
    #[Route(path: 'review/project/delete/{id<\d+>}', name: 'review_delete_id_project', methods: ['DELETE'])]
    #[Route(path: 'order/delete/{id<\d+>}', name: 'order_delete_id', methods: ['DELETE'])]
    #[Route(path: 'event/delete/{id<\d+>}', name: 'event_delete_id', methods: ['DELETE'])]
    #[Route(path: 'event/category/delete/{id<\d+>}', name: 'event_delete_id_category', methods: ['DELETE'])]
    #[Route(path: 'taxation/delete/{id<\d+>}', name: 'taxation_delete_id', methods: ['DELETE'])]
    #[Route(path: 'taxation/zone/delete/{id<\d+>}', name: 'taxation_delete_id_zone', methods: ['DELETE'])]
    #[Route(path: 'taxation/category/delete/{id<\d+>}', name: 'taxation_delete_id_category', methods: ['DELETE'])]
    #[Route(path: 'shipment/delete/{id<\d+>}', name: 'shipment_delete_id', methods: ['DELETE'])]
    #[Route(path: 'shipment/category/delete/{id<\d+>}', name: 'shipment_delete_id', methods: ['DELETE'])]
    #[Route(path: 'payment/delete/{id<\d+>}', name: 'payment_delete_id', methods: ['DELETE'])]
    #[Route(path: 'payment/category/delete/{id<\d+>}', name: 'payment_delete_id', methods: ['DELETE'])]
    #[Route(path: 'coupon/delete/{id<\d+>}', name: 'coupon_delete_id', methods: ['DELETE'])]
    #[Route(path: 'currency/delete/{id<\d+>}', name: 'currency_delete_id', methods: ['DELETE'])]
    #[Route(path: 'role/delete/{id<\d+>}', name: 'role_delete_id', methods: ['DELETE'])]
    #[Route(path: 'storage/delete/{id<\d+>}', name: 'storage_delete_id', methods: ['DELETE'])]
    /**
     * ********************************************
     * Routes by 'slug' for Front-end and Back-end.
     * ********************************************
     */
    #[Route(path: 'vendor/delete/{slug}', name: 'vendor_delete_slug', methods: ['DELETE'])]
    #[Route(path: 'folder/delete/{slug}', name: 'folder_delete_slug', methods: ['DELETE'])]
    #[Route(path: 'commission/delete/{slug}', name: 'commission_delete_slug', methods: ['DELETE'])]
    #[Route(path: 'project/delete/{slug}', name: 'project_delete_slug', methods: ['DELETE'])]
    #[Route(path: 'product/delete/{slug}', name: 'product_delete_slug', methods: ['DELETE'])]
    #[Route(path: 'product/price/delete/{slug}', name: 'product_delete_slug_price', methods: ['DELETE'])]
    #[Route(path: 'category/delete/{slug}', name: 'category_delete_slug', methods: ['DELETE'])]
    #[Route(path: 'attachment/delete/{slug}', name: 'attachment_delete_slug', methods: ['DELETE'])]
    #[Route(path: 'review/product/delete/{slug}', name: 'review_delete_slug_product', methods: ['DELETE'])]
    #[Route(path: 'review/project/delete/{slug}', name: 'review_delete_slug_project', methods: ['DELETE'])]
    #[Route(path: 'order/delete/{slug}', name: 'order_delete_slug', methods: ['DELETE'])]
    #[Route(path: 'event/delete/{slug}', name: 'event_delete_slug', methods: ['DELETE'])]
    #[Route(path: 'event/category/delete/{slug}', name: 'event_delete_slug_category', methods: ['DELETE'])]
    #[Route(path: 'taxation/delete/{slug}', name: 'taxation_delete_slug', methods: ['DELETE'])]
    #[Route(path: 'taxation/zone/delete/{slug}', name: 'taxation_delete_slug_zone', methods: ['DELETE'])]
    #[Route(path: 'taxation/category/delete/{slug}', name: 'taxation_delete_slug_category', methods: ['DELETE'])]
    #[Route(path: 'shipment/delete/{slug}', name: 'shipment_delete_slug', methods: ['DELETE'])]
    #[Route(path: 'shipment/category/delete/{slug}', name: 'shipment_delete_slug_category', methods: ['DELETE'])]
    #[Route(path: 'payment/delete/{slug}', name: 'payment_delete_slug', methods: ['DELETE'])]
    #[Route(path: 'payment/category/delete/{slug}', name: 'payment_delete_slug_category', methods: ['DELETE'])]
    #[Route(path: 'coupon/delete/{slug}', name: 'coupon_delete_slug', methods: ['DELETE'])]
    #[Route(path: 'currency/delete/{slug}', name: 'currency_delete_slug', methods: ['DELETE'])]
    #[Route(path: 'role/delete/{slug}', name: 'role_delete_slug', methods: ['DELETE'])]
    #[Route(path: 'storage/delete/{slug}', name: 'storage_delete_slug', methods: ['DELETE'])]
    public function delete(Request $request, ?int $id = null, ?string $slug = null): Response
    {
        $typeId = null ? $id : $slug;
        $typeId = 'string' == gettype($typeId) ? $this->requestDispatcher->objectFindBySlug($slug) : $this->requestDispatcher->objectFindById($id);

        if ($this->isCsrfTokenValid('delete'.$typeId, $request->get('_token'))) {
            $entityManager = $this->managerRegistry->getManager();
            $entityManager->remove((object) $this->requestDispatcher->object());
            $entityManager->flush();
            $this->addFlash(
                'notice',
                'Success delete message!'
            );
        } else {
            throw $this->createNotFoundException('The object does not exist');
        }

        return $this->redirectToRoute($this->requestDispatcher->object());
    }

    // Own
    #[Route(path: 'vendor/own', name: 'vendor_own', methods: ['GET'])]
    #[Route(path: 'vendor/folder/own/', name: 'vendor_folder_own', methods: ['GET'])]
    #[Route(path: 'vendor/payment/own/', name: 'vendor_folder_own_payment', methods: ['GET'])]
    #[Route(path: 'vendor/shipment/own/', name: 'vendor_folder_own_shipment', methods: ['GET'])]
    #[Route(path: 'order/own/', name: 'order_own', methods: ['GET'])]
    #[Route(path: 'event/own/', name: 'event_own', methods: ['GET'])]
    #[Route(path: 'event/category/own/', name: 'event_category_own', methods: ['GET'])]
    #[Route(path: 'event/member/own/', name: 'event_member_own', methods: ['GET'])]
    #[Route(path: 'folder/own/', name: 'folder_own', methods: ['GET'])]
    #[Route(path: 'product/own/', name: 'product_own', methods: ['GET'])]
    #[Route(path: 'product/price/own/', name: 'product_own_price', methods: ['GET'])]
    #[Route(path: 'project/own/', name: 'project_own', methods: ['GET'])]
    #[Route(path: 'commission/own/', name: 'commission_own', methods: ['GET'])]
    #[Route(path: 'category/own/', name: 'category_own', methods: ['GET'])]
    #[Route(path: 'attachment/own/', name: 'attachment_own', methods: ['GET'])]
    #[Route(path: 'review/product/own/', name: 'review_own_product', methods: ['GET'])]
    #[Route(path: 'review/project/own/', name: 'review_own_project', methods: ['GET'])]
    #[Route(path: 'cart/own/', name: 'cart_own', methods: ['GET'])]
    #[Route(path: 'payment/own/', name: 'payment_own', methods: ['GET'])]
    #[Route(path: 'shipment/own/', name: 'shipment_own', methods: ['GET'])]
    #[Route(path: 'billing/own/', name: 'billing_own', methods: ['GET'])]
    #[Route(path: 'coupon/own/', name: 'coupon_own', methods: ['GET'])]
    #[Route(path: 'currency/own/', name: 'currency_own', methods: ['GET'])]
    #[Route(path: 'role/own/', name: 'role_own', methods: ['GET'])]
    #[Route(path: 'storage/own/', name: 'storage_own', methods: ['GET'])]
    public function own(): Response
    {
        $localeFilter = $this->requestDispatcher->localeFilter();
        ($localeFilter) ? $object = $this->requestDispatcher->objectLanguageLayer() : $object = $this->requestDispatcher->object();
        $em = $this->managerRegistry->getManager();

        return $this->render($this->requestDispatcher->layOutPath(), [
            $this->requestDispatcher->route() => $em->getRepository($object)->findBy(['createdBy' => $this->getUser()]),
        ]);
    }

    // ThankYou
    #[Route(path: 'vendor/thank', name: 'vendor_thank', methods: ['GET'])]
    #[Route(path: 'order/thank', name: 'order_thank', methods: ['GET'])]
    #[Route(path: 'event/thank', name: 'event_thank', methods: ['GET'])]
    #[Route(path: 'folder/thank', name: 'folder_thank', methods: ['GET'])]
    #[Route(path: 'product/thank', name: 'product_thank', methods: ['GET'])]
    #[Route(path: 'product/price/thank', name: 'product_thank_price', methods: ['GET'])]
    #[Route(path: 'project/thank', name: 'project_thank', methods: ['GET'])]
    #[Route(path: 'commission/thank', name: 'commission_thank', methods: ['GET'])]
    #[Route(path: 'category/thank', name: 'category_thank', methods: ['GET'])]
    #[Route(path: 'attachment/thank', name: 'attachment_thank', methods: ['GET'])]
    #[Route(path: 'review/thank', name: 'review_thank', methods: ['GET'])]
    #[Route(path: 'shipment/thank', name: 'shipment_thank', methods: ['GET'])]
    #[Route(path: 'payment/thank', name: 'payment_thank', methods: ['GET'])]
    #[Route(path: 'taxation/thank', name: 'taxation_thank', methods: ['GET'])]
    #[Route(path: 'cart/thank', name: 'cart_thank', methods: ['GET'])]
    #[Route(path: 'coupon/thank', name: 'coupon_thank', methods: ['GET'])]
    #[Route(path: 'currency/thank', name: 'currency_thank', methods: ['GET'])]
    #[Route(path: 'role/thank', name: 'role_thank', methods: ['GET'])]
    #[Route(path: 'storage/thank', name: 'storage_thank', methods: ['GET'])]
    public function thankYou()
    {
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
    // Summery
    #[Route(path: 'vendor/summery/', name: 'vendor_summery', methods: ['GET', 'POST'])]
    #[Route(path: 'vendor/commission/summery/', name: 'vendor_summery_commission', methods: ['GET', 'POST'])]
    #[Route(path: 'vendor/profile/summery/', name: 'vendor_summery_profile', methods: ['GET', 'POST'])]
    #[Route(path: 'event/summery/', name: 'event_summery', methods: ['GET', 'POST'])]
    #[Route(path: 'event/category/summery/', name: 'event_summery_category', methods: ['GET', 'POST'])]
    #[Route(path: 'folder/summery/', name: 'folder_summery', methods: ['GET', 'POST'])]
    #[Route(path: 'project/summery/', name: 'project_summery', methods: ['GET', 'POST'])]
    #[Route(path: 'commission/summery/', name: 'commission_summery', methods: ['GET', 'POST'])]
    #[Route(path: 'product/summery', name: 'product_summery', methods: ['GET', 'POST'])]
    #[Route(path: 'product/price/summery', name: 'product_summery_price', methods: ['GET', 'POST'])]
    #[Route(path: 'category/summery', name: 'category_summery', methods: ['GET', 'POST'])]
    #[Route(path: 'order/summery/', name: 'order_summery', methods: ['GET', 'POST'])]
    #[Route(path: 'attachment/summery/', name: 'attachment_summery', methods: ['GET', 'POST'])]
    #[Route(path: 'review/product/summery/', name: 'review_summery_product', methods: ['GET', 'POST'])]
    #[Route(path: 'review/project/summery/', name: 'review_summery_project', methods: ['GET', 'POST'])]
    #[Route(path: 'taxation/summery/', name: 'taxation_summery', methods: ['GET', 'POST'])]
    #[Route(path: 'taxation/zone/summery/', name: 'taxation_summery_zone', methods: ['GET', 'POST'])]
    #[Route(path: 'taxation/category/summery/', name: 'taxation_summery_category', methods: ['GET', 'POST'])]
    #[Route(path: 'shipment/summery/', name: 'shipment_summery', methods: ['GET', 'POST'])]
    #[Route(path: 'shipment/category/summery/', name: 'shipment_summery_category', methods: ['GET', 'POST'])]
    #[Route(path: 'payment/summery/', name: 'payment_summery', methods: ['GET', 'POST'])]
    #[Route(path: 'payment/category/summery/', name: 'payment_summery_category', methods: ['GET', 'POST'])]
    #[Route(path: 'coupon/summery/', name: 'coupon_summery', methods: ['GET', 'POST'])]
    #[Route(path: 'currency/summery/', name: 'currency_summery', methods: ['GET', 'POST'])]
    #[Route(path: 'role/summery/', name: 'role_summery', methods: ['GET', 'POST'])]
    #[Route(path: 'storage/summery/', name: 'storage_summery', methods: ['GET', 'POST'])]
    public function summery()
    {
    }

    // Summery
    #[Route(path: 'vendor/widget/', name: 'vendor_widget', methods: ['GET', 'POST'])]
    #[Route(path: 'vendor/commission/widget/', name: 'vendor_widget_commission', methods: ['GET', 'POST'])]
    #[Route(path: 'vendor/profile/widget/', name: 'vendor_widget_profile', methods: ['GET', 'POST'])]
    #[Route(path: 'vendor/payment/widget/', name: 'vendor_widget_payment', methods: ['GET', 'POST'])]
    #[Route(path: 'vendor/shipment/widget/', name: 'vendor_widget_shipment', methods: ['GET', 'POST'])]
    #[Route(path: 'event/widget/', name: 'event_widget', methods: ['GET', 'POST'])]
    #[Route(path: 'event/category/widget/', name: 'event_widget_category', methods: ['GET', 'POST'])]
    #[Route(path: 'folder/widget/', name: 'folder_widget', methods: ['GET', 'POST'])]
    #[Route(path: 'project/widget/', name: 'project_widget', methods: ['GET', 'POST'])]
    #[Route(path: 'commission/widget/', name: 'commission_widget', methods: ['GET', 'POST'])]
    #[Route(path: 'product/widget', name: 'product_widget', methods: ['GET', 'POST'])]
    #[Route(path: 'product/price/widget', name: 'product_widget_price', methods: ['GET', 'POST'])]
    #[Route(path: 'category/widget', name: 'category_widget', methods: ['GET', 'POST'])]
    #[Route(path: 'order/widget/', name: 'order_widget', methods: ['GET', 'POST'])]
    #[Route(path: 'attachment/widget/', name: 'attachment_widget', methods: ['GET', 'POST'])]
    #[Route(path: 'review/product/widget/', name: 'review_widget_product', methods: ['GET', 'POST'])]
    #[Route(path: 'review/project/widget/', name: 'review_widget_project', methods: ['GET', 'POST'])]
    #[Route(path: 'taxation/widget/', name: 'taxation_widget', methods: ['GET', 'POST'])]
    #[Route(path: 'taxation/zone/widget/', name: 'taxation_widget_zone', methods: ['GET', 'POST'])]
    #[Route(path: 'taxation/category/widget/', name: 'taxation_widget_category', methods: ['GET', 'POST'])]
    #[Route(path: 'shipment/widget/', name: 'shipment_widget', methods: ['GET', 'POST'])]
    #[Route(path: 'shipment/category/widget/', name: 'shipment_widget_category', methods: ['GET', 'POST'])]
    #[Route(path: 'payment/widget/', name: 'payment_widget', methods: ['GET', 'POST'])]
    #[Route(path: 'payment/category/widget/', name: 'payment_widget_category', methods: ['GET', 'POST'])]
    #[Route(path: 'coupon/widget/', name: 'coupon_widget', methods: ['GET', 'POST'])]
    #[Route(path: 'currency/widget/', name: 'currency_widget', methods: ['GET', 'POST'])]
    #[Route(path: 'role/widget/', name: 'role_widget', methods: ['GET', 'POST'])]
    #[Route(path: 'storage/widget/', name: 'storage_widget', methods: ['GET', 'POST'])]
    public function widget()
    {
    }
}
