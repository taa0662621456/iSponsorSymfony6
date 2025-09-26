<?php

namespace App\Controller\Vendor;

use App\Entity\Vendor\VendorFavourite;
use App\Repository\Category\CategoryFavouriteRepository;
use App\Repository\Product\ProductFavouriteRepository;
use App\Repository\Project\ProjectFavouriteRepository;
use App\Repository\Vendor\VendorFavouriteRepository;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;

#[AsController]
#[Route(path: '/profile/favourite', name: 'vendor_favourite_')]
class VendorsFavouritesController extends AbstractController
{
    public function __construct(
        private readonly EntityManagerInterface $em,
        private VendorFavouriteRepository       $repository,
        private readonly LoggerInterface        $logger
    ) {}

    #[Route('/add/{customerId}', name: 'add', methods: ['POST'])]
    public function add(int $customerId, Request $request): Response
    {
        $this->isCsrfOr403('fav_add_'.$customerId, $request->request->get('_token'));

        $fav = (new VendorFavourite())
            ->setVendor($this->getUser()->getVendor())
            ->setCustomer($this->em->getReference(\App\Entity\Customer::class, $customerId));

        try {
            $this->em->persist($fav);
            $this->em->flush();
            $this->addFlash('success', 'Добавлено в избранные');
        } catch (UniqueConstraintViolationException) {
            // не спамим ошибкой — уже в избранном
            $this->addFlash('info', 'Уже в избранных');
        } catch (\Throwable $e) {
            $this->logger->error('Fav add failed', ['e' => $e]);
            $this->addFlash('danger', 'Не удалось добавить в избранные');
        }

        return $this->redirectToRoute('vendor_dashboard');
    }

    #[Route('/{id}/remove', name: 'remove', methods: ['POST','DELETE'])]
    public function remove(VendorFavourite $fav, Request $request): Response
    {
        $this->isCsrfOr403('fav_remove_'.$fav->getId(), $request->request->get('_token'));
        // проверка владельца
        if ($fav->getVendor()->getId() !== $this->getUser()->getVendor()->getId()) {
            throw $this->createAccessDeniedException();
        }

        try {
            $this->em->remove($fav);
            $this->em->flush();
            $this->addFlash('success', 'Удалено из избранных');
        } catch (\Throwable $e) {
            $this->logger->error('Fav remove failed', ['e' => $e]);
            $this->addFlash('danger', 'Не удалось удалить');
        }

        return $this->redirectToRoute('vendor_dashboard');
    }

    private function isCsrfOr403(string $id, ?string $token): void
    {
        if (!$this->isCsrfTokenValid($id, (string) $token)) {
            throw $this->createAccessDeniedException('CSRF token invalid');
        }
    }
    /**
     * @param                                    $favourites
     * @param ProjectFavouriteRepository $projectsFavouritesRepository
     * @param ProductFavouriteRepository $productsFavouritesRepository
     * @param VendorFavouriteRepository $vendorsFavouritesRepository
     * @param CategoryFavouriteRepository $categoriesFavouritesRepository
     * @return Response
     */
    #[Route(path: '/{favourites}', name: 'favourites', defaults: ['page' => 1, '_format' => 'html'], methods: ['GET'])]
    #[Route(path: '/{favourites}', name: 'favourites_XmlHttpReq', defaults: ['page' => 1, '_format' => 'xmlhttp'], methods: ['GET'])]
    #[Route(path: '/page/{page<[1-9]\d*>}', name: 'home_paginated', defaults: ['_format' => 'html'], methods: ['GET'])]
    public function favourites($favourites, ProjectFavouriteRepository $projectsFavouritesRepository, ProductFavouriteRepository $productsFavouritesRepository, VendorFavouriteRepository $vendorsFavouritesRepository, CategoryFavouriteRepository $categoriesFavouritesRepository): Response
    {
        return $this->render(
            '/' . $favourites . '.html.twig', [
                // findBy() must have first parameter: 'createdBy' => $this->getUser()
                // for all next row
                'categories' => $categoriesFavouritesRepository->findBy(
                    ['published' => 't'], ['createdAt' => 'ASC'], 12
                ),
                'projects'   => $projectsFavouritesRepository->findBy([], ['createdAt' => 'ASC'], 12),
                'products'   => $productsFavouritesRepository->findBy([], ['createdAt' => 'ASC'], 12),
                'vendors'    => $vendorsFavouritesRepository->findBy([], ['createdAt' => 'ASC'], 12)
            ]
        );
    }
}
