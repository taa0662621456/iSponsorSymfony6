<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LocaleSwitcherController extends AbstractController
{
    #[Route(path: '/locale/{app_locale}', name: 'locale')]
    public function localeSwitchAction(Request $request, string $locale) : Response
    {
        $referer = $request->headers->get('referer');
        $request->getSession()->set('app_locale', $locale);
        return $this->redirect($referer);
    }

}
