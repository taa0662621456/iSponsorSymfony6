<?php
declare(strict_types=1);

namespace App\Controller;

use App\Entity\Project\Projects;
use App\Entity\Project\ProjectsAttachments;
use App\Entity\Project\ProjectsEnGb;
use App\Form\Project\ProjectsType;
use App\Repository\CategoriesRepository;
use App\Repository\Project\ProjectsRepository;
use App\Service\AttachmentsManager;
use Cocur\Slugify\Slugify;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/projects")
 */
class ProjectsController extends AbstractController
{
	/**
	 * @var AttachmentsManager
	 */
	private $attachmentManager;

	public function __construct(AttachmentsManager $attachmentManager)
	{
		$this->attachmentManager = $attachmentManager;
	}

	/**
	 * @Route("/", name="projects", methods={"GET"})
	 * @return Response
	 */
	public function index(): Response
	{
		$em = $this->getDoctrine()->getManager();
		$categoriesRepository = $em->getRepository(CategoriesRepository::class);
		//$newsRepository = $em->getRepository('News');
        //$slideRepository = $em->getRepository('Slide');
		//$projectsRepository = $em->getRepository(ProjectsRepository::class);

        //sorted by order number
        //$slides = $slideRepository->findBy(['enabled' => true], ['slideOrder' => 'ASC']);
        //$lastNews = $newsRepository->getLastNews();
        //$categories = $categoriesRepository->findAll();
        //$latestProjects = $projectsRepository->getLatest(12, $this->getUser());
        //$featuredProjects = $projectsRepository->getFeatured(12, $this->getUser());

        return $this->render('project/projects/index.html.twig', array(
            'categories' => $categoriesRepository
            //'featured_products' => $featuredProjects,
            //'projects' => $projectsRepository->findAll(),
            //'latest' => $latestProjects,
            //'news' => $lastNews,
            //'slides' => $slides
            )
        );
    }

    /**
     * @Route("/new", name="projects_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     * @throws Exception
     */
    public function new(Request $request): Response
    {
        $slug = new Slugify();

        $project = new Projects();
        //$project->setCreatedBy($this->getUser());

        $projectEnGb = new ProjectsEnGb();
        //$projectEnGb->setCreatedBy($this->getUser());

        $form = $this->createForm(ProjectsType::class, $project);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($project);

            $s = $form->get('projectEnGb')->get('slug')->getData();
            if (!isset($s)) {
				$project->setSlug($slug->slugify($projectEnGb->getProjectTitle()));

			}
            $entityManager->flush();

            return $this->redirectToRoute('projects');
        }

        return $this->render('project/projects/new.html.twig', [
            'project' => $project,
            'form' => $form->createView(),
        ]);
    }

    /**
	 * @Route("/{id<\d+>}", name="projects_show", methods={"GET"})
	 * @Route("/{slug}", name="projects_slug", methods={"GET"})
	 * @param Projects $project
	 *
	 * @return Response
	 */
    public function show(Projects $project): Response
	{
		return $this->render('project/projects/show.html.twig', [
			'project' => $project,
		]);
	}

    /**
     * @Route("/{id}/edit", name="projects_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Projects $project
     * @return Response
     */
    public function edit(Request $request, Projects $project): Response
	{
		$form = $this->createForm(ProjectsType::class, $project);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$this->getDoctrine()->getManager()->flush();

			return $this->redirectToRoute('projects');
		}

		return $this->render('project/projects/edit.html.twig', array(
			'project' => $project,
			'form' => $form->createView(),
		));
	}

    /**
     * @Route("/search", methods={"GET"}, name="project_search")
     * @param Request $request
     * @param ProjectsRepository $projects
     * @return Response
     */
    public function search(Request $request, ProjectsRepository $projects): ?Response
    {
        if (!$request->isXmlHttpRequest()) {
			return $this->render('project/projects/search.html.twig');
		}

        $query = $request->query->get('q', '');
        $limit = $request->query->get('l', 10);
        $foundProjects = $projects->findBySearchQuery($query, $limit);
        $results = [];
        foreach ($foundProjects as $project) {

            $results[] = [
                'projectTitle' => htmlspecialchars($project->getProjectTitle(), ENT_COMPAT | ENT_HTML5),
                //'createdAt' => $project->getCreatedAt()->format('M d, Y'),
                'vendorId' => htmlspecialchars($project->getVendorId()->getFirstName(), ENT_COMPAT | ENT_HTML5),
                'projectSDesc' => htmlspecialchars($project->getProjectSDesc(), ENT_COMPAT | ENT_HTML5),
                'detailsUrl' => $this->generateUrl('project', ['slug' => $project->getSlug()]),
            ];
        }

        return $this->json($results);
        /*
        $repository = $em->getRepository(ProjectsEnGb::class);
        $query = $request->query->get('q');
        $projects = $repository->searchByQuery($query);

        return $this->render('project/search.html.twig', [
            'projects' => $projects
        ]);
        */
    }

    /**
     * @Route("/my", defaults={"page": "1", "_format"="html"}, methods={"GET"}, name="vendors_projects")
     * @Route("/rss.xml", defaults={"page": "1", "_format"="xml"}, methods={"GET"}, name="vendors_projects_rss")
     * @Route("/page/{page<[1-9]\d*>}", defaults={"_format"="html"}, methods={"GET"}, name="projects_index_paginated")
     * @param string $_format
     * @return Response
     */
    public function my(string $_format): Response
    {
        $em = $this->getDoctrine()->getManager();

        $projects = $em->getRepository(ProjectsRepository::class)->findOneBy(['vendor_id' => $this->getUser()->getId()]);

        return $this->render('vendor/projects.'.$_format.'.twig', [
            'project' => $projects
        ]);
    }

    /**
     * @Route("/attachment/{id}", name="attachment")
     * @param Request $request
     * @param Projects $projects
     * @param ProjectsAttachments $projectsAttachments
     * @return Response
     */
    public function attachment(Request $request, Projects $projects, ProjectsAttachments $projectsAttachments)
    {
        $file = $request->get('file');

        $filenameAndPath = $this->attachmentManager->uploadAttachment($file, $projects, $projectsAttachments);

        return $this->json([
            'location' => $filenameAndPath['path']
        ]);
    }

    /**
     * @Route("/{id}", name="projects_delete", methods={"DELETE"})
     * @param Request $request
     * @param Projects $project
     * @return Response
     */
    public function delete(Request $request, Projects $project): Response
    {
        if ($this->isCsrfTokenValid('delete'.$project->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($project);
            $entityManager->flush();
        }

		return $this->redirectToRoute('projects');
    }
}