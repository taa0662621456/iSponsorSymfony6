<?php


namespace App\Controller\Security;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ForgotController
{
    /**
     * @Route("/forgot", name="forgot")
     * @return Response
     */
    public function forgot(): Response
    {
        return new Response('<html lang="en"><body>Are You forgot any auth parameters?</body></html>');
    }

}
