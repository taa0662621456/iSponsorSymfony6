<?php


namespace App\Controller\Vendor;

use App\Entity\Vendor\VendorIban;
use App\Form\Vendor\VendorIbanType;
use App\Repository\Vendor\VendorIbanRepository;
use App\Service\Vendor\VendorVoter;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\ExpressionLanguage\Expression;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Validator\Constraints as Assert;

#[AsController]
#[Route(path: '/vendor/iban', name: 'vendor_iban_')]
#[Route(path: '/sponsor/iban', name: 'sponsor_iban_')]
#[IsGranted(new Expression('is_granted("ROLE_VENDOR")'))]
class VendorsIbanController extends AbstractController
{
    private ManagerRegistry $managerRegistry;

    public function __construct(
        private readonly EntityManagerInterface $em,
        private VendorIbanRepository            $repo,
        private readonly LoggerInterface        $logger,
        private readonly ValidatorInterface     $validator,
        ManagerRegistry                         $managerRegistry
    ) {
        $this->managerRegistry = $managerRegistry;
    }

    #[Route('/add', name: 'add', methods: ['POST'])]
    public function add(Request $request): Response
    {
        $this->denyAccessUnlessGranted(VendorVoter::MANAGE, $this->getUser());

        $this->isCsrfTokenValidOrThrow('iban_add', $request->request->get('_token'));

        $ibanValue = (string) $request->request->get('iban');
        $violations = $this->validator->validate($ibanValue, [
            new Assert\NotBlank(),
            new Assert\Iban(message: 'Invalid IBAN'),
            new Assert\Length(max: 34),
        ]);
        if (\count($violations) > 0) {
            $this->addFlash('danger', (string) $violations);
            return $this->redirectToRoute('vendor_dashboard');
        }

        try {
            $iban = (new VendorIban())
                ->setIban($ibanValue)
                ->setVendor($this->getUser()->getVendor());

            $this->em->persist($iban);
            $this->em->flush();

            $this->logger->info('Vendor IBAN added', ['vendor' => $this->getUser()->getUserIdentifier(), 'iban' => substr($ibanValue, -6)]);
            $this->addFlash('success', 'IBAN добавлен');
        } catch (\Throwable $e) {
            $this->logger->error('Add IBAN failed', ['e' => $e]);
            $this->addFlash('danger', 'Не удалось добавить IBAN');
        }

        return $this->redirectToRoute('vendor_dashboard');
    }

    #[Route('/{id}/remove', name: 'remove', methods: ['POST','DELETE'])]
    public function remove(Request $request, VendorIban $iban): Response
    {
        $this->denyAccessUnlessGranted(VendorVoter::MANAGE, $iban->getVendor());
        $this->isCsrfTokenValidOrThrow('iban_remove_'.$iban->getId(), $request->request->get('_token'));

        try {
            $this->em->remove($iban);
            $this->em->flush();
            $this->logger->info('Vendor IBAN removed', ['vendor' => $iban->getVendor()->getId(), 'iban' => $iban->getId()]);
            $this->addFlash('success', 'IBAN удалён');
        } catch (\Throwable $e) {
            $this->logger->error('Remove IBAN failed', ['e' => $e]);
            $this->addFlash('danger', 'Не удалось удалить IBAN');
        }
        return $this->redirectToRoute('vendor_dashboard');
    }

    private function isCsrfTokenValidOrThrow(string $id, ?string $token): void
    {
        if (!$this->isCsrfTokenValid($id, (string) $token)) {
            throw $this->createAccessDeniedException('CSRF token invalid');
        }
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
