<?php


	namespace App\Controller;

	use App\Repository\Product\ProductRepository;
	use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
	use Symfony\Component\HttpFoundation\Request;
	use Symfony\Component\HttpFoundation\Response;
	use Symfony\Component\Routing\Annotation\Route;

	class SearchController extends AbstractController
	{
		#[Route(path: '/search', methods: ['GET'], name: 'search')]
		public function search(Request $request, ProductRepository $projects) : Response
		{
			if (!$request->isXmlHttpRequest()) {
				return $this->render('search/search.html.twig');
			}
			$query = $request->query->get('q', '');
			$limit = $request->query->get('l', 10);
			$found = $projects->findBySearchQuery($query, $limit);
			$results = [];
			//TODO
			foreach ($found as $post) {
				$results[] = [
					'title' => htmlspecialchars($projects->getProgectTitle(), ENT_COMPAT | ENT_HTML5),
					'date' => $post->getPublishedAt()->format('M d, Y'),
					'author' => htmlspecialchars($post->getAuthor()->getFullName(), ENT_COMPAT | ENT_HTML5),
					'summary' => htmlspecialchars($post->getSummary(), ENT_COMPAT | ENT_HTML5),
					'url' => $this->generateUrl('blog_post', ['slug' => $post->getSlug()]),
				];
			}
			return $this->json($results);
		}
	}
