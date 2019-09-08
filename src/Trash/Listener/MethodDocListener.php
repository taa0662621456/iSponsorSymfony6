<?php
declare(strict_types=1);

namespace App\Listener;

use App\Domain\JsonRpcMethodWithDocInterface;
use Yoanm\JsonRpcServerDoc\Domain\Model\ErrorDoc;
use Yoanm\SymfonyJsonRpcHttpServerDoc\Event\MethodDocCreatedEvent;
use Yoanm\SymfonyJsonRpcHttpServerOpenAPIDoc\Event\OpenAPIDocCreatedEvent;

class MethodDocListener
{
    public function enhanceMethodDoc(MethodDocCreatedEvent  $event) : void
    {
        $method = $event->getMethod();

        if ($method instanceof JsonRpcMethodWithDocInterface) {
            $doc = $event->getDoc();
            $doc->setResultDoc($method->getDocResponse());

            foreach ($method->getDocErrors() as $error) {
                if ($error instanceof ErrorDoc) {
                    $doc->addCustomError($error);
                }
            }

            $doc->setDescription($method->getDocDescription());
            $doc->addTag($method->getDocTag());
        }
    }

    public function enhanceDoc(OpenAPIDocCreatedEvent $event): void
    {
        $doc = $event->getOpenAPIDoc();

        $doc['info'] = [
            'title' => 'Main title',
            'version' => '1.0.0',
            'description' => 'Main description'
        ];

        $event->setOpenAPIDoc($doc);
    }
}