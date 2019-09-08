<?php
declare(strict_types=1);

namespace App\Controller;

use App\Repository\CategoriesRepository;
use App\Repository\ProjectsRepository;
use App\Repository\TagsRepository;
use Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


/**
 * @Route("/")
 *
 */
class DefaultController extends AbstractController
{

    /**
     * @Route("/", defaults={"page": "1", "_format"="html"}, methods={"GET"}, name="projects")
     * @Route("/rss.xml", defaults={"page": "1", "_format"="xml"}, methods={"GET"}, name="projects_rss")
     * @Route("/page/{page<[1-9]\d*>}", defaults={"_format"="html"}, methods={"GET"}, name="projects_index_paginated")
     * @param Request $request
     * @param int $project
     * @param string $_format
     * @param CategoriesRepository $categoriesRepository
     * @param ProjectsRepository $projectsRepository
     * @param TagsRepository $tags
     * @return Response
     */
    public function index(Request $request, int $project, string $_format, CategoriesRepository $categoriesRepository, ProjectsRepository $projectsRepository, TagsRepository $tags): Response
    {
        $em = $this->getDoctrine()->getManager();
        //$newsRepository = $em->getRepository('News');
        //$slideRepository = $em->getRepository('Slide');

        //sorted by order number
        //$slides = $slideRepository->findBy(['enabled' => true], ['slideOrder' => 'ASC']);
        //$lastNews = $newsRepository->getLastNews();
        $latestProjects = $projectsRepository->getLatest(12, $this->getUser());
        $featuredProjects = $projectsRepository->getFeatured(12, $this->getUser());

        return array(
            'categories' => $categoriesRepository->findAll(),
            //'featured_products' => $featuredProjects,
            //'projects' => $projectsRepository->findAll(),
            //'latest' => $latestProjects,
            //'news' => $lastNews,
            //'slides' => $slides
        );
        /*
        $tag = null;
        if ($request->query->has('tag')) {
            $tag = $tags->findOneBy(['name' => $request->query->get('tag')]);
        }
        $latestProject = $projects->findLatest($project, $tag);
        // Every template name also has two extensions that specify the format and
        // engine for that template.
        // See https://symfony.com/doc/current/templating.html#template-suffix
        return $this->render('project/index.'.$_format.'.twig', [
            'paginator' => $latestProject,
        ]);
        */
    }
}