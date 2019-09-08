<?php
declare(strict_types=1);

namespace App\Service;

class MyMessage
{
    private $bus;

    /*
        $bus = new MessageBus ([
        new HandleMessageMiddleware ( new HandlersLocator ([
        MyMessage :: class => [ 'dummy' => $handler ],
        ])),
        ]);

        $bus -> dispatch ( new MyMessage ( ));
    */

}
