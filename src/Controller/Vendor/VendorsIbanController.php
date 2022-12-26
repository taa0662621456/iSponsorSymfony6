<?php


namespace App\Controller\Vendor;

use App\Entity\Vendor\VendorIban;
use App\Form\Vendor\VendorIbanType;
use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;

#[AsController]
#[Route(path: '/vendors/iban')]
#[Route(path: '/sponsor/iban')]
class VendorsIbanController extends AbstractController
{
    private ManagerRegistry $managerRegistry;

    public function __constructor(ManagerRegistry $managerRegistry)
    {
        $this->managerRegistry = $managerRegistry;
    }
	#[Route(path: '/', name: 'index', methods: ['GET'])]
	public function index() : Response
	{
		$vendorsIbans = $this->managerRegistry
							 ->getRepository(VendorIban::class)
							 ->findAll()
		;
		return $this->render(
			'vendor/vendors_iban/index.html.twig', [
			'vendors_ibans' => $vendorsIbans,
		]
		);
	}
	#[Route(path: '/new', name: 'vendor_vendors_iban_new', methods: ['GET', 'POST'])]
	public function new(Request $request) : Response
	{
		$vendorsIban = new VendorIban();
		$form = $this->createForm(VendorIbanType::class, $vendorsIban);
		$form->handleRequest($request);
		if ($form->isSubmitted() && $form->isValid()) {
			$entityManager = $this->managerRegistry->getManager();
			$entityManager->persist($vendorsIban);
			$entityManager->flush();

			return $this->redirectToRoute('vendor_vendors_iban_index');
		}
		return $this->render(
			'vendor/vendors_iban/new.html.twig', [
			'vendors_iban' => $vendorsIban,
			'form'         => $form->createView(),
		]
		);
	}
	#[Route(path: '/{id}', name: 'vendor_vendors_iban_show', methods: ['GET'])]
	public function show(VendorIban $vendorsIban) : Response
	{
		return $this->render(
			'vendor/vendors_iban/show.html.twig', [
			'vendors_iban' => $vendorsIban,
		]
		);
	}
	#[Route(path: '/{id}/edit', name: 'vendor_vendors_iban_edit', methods: ['GET', 'POST'])]
	public function edit(Request $request, VendorIban $vendorsIban) : Response
	{
		$form = $this->createForm(VendorIbanType::class, $vendorsIban);
		$form->handleRequest($request);
		if ($form->isSubmitted() && $form->isValid()) {
			$this->managerRegistry->getManager()->flush();

			return $this->redirectToRoute('vendor_vendors_iban_show');
		}
		return $this->render(
			'vendor/vendors_iban/edit.html.twig', [
			'vendors_iban' => $vendorsIban,
			'form'         => $form->createView(),
		]
		);
	}
	#[Route(path: '/{id}', name: 'vendor_vendors_iban_delete', methods: ['DELETE'])]
	public function delete(Request $request, VendorIban $vendorsIban) : Response
	{
		if ($this->isCsrfTokenValid('delete' . $vendorsIban->getId(), $request->request->get('_token'))) {
			$entityManager = $this->managerRegistry->getManager();
			$entityManager->remove($vendorsIban);
			$entityManager->flush();
		}
		return $this->redirectToRoute('vendor_vendors_iban_index');
	}
}
