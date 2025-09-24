<?php

namespace App\EventListener;

use App\Model\ErrorResponseModel;
use App\Request\AttributeRequest;
use App\Service\System\ExceptionMapping;
use App\Service\System\ExceptionMappingResolver;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Log\Logger;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Serializer;

class ApiExceptionListener
{
    /*
     * Много кода, что здесь происходит? По умолчанию мы используем стратегию запрета с правилами исключения.
     * Если мы не указали настройки исключения, то ответ будет с кодом 500 и пустым телом.
     * Далее, мы логируем исключение если код в настройках больше или равен 500.
     * И напоследок если мы указали в исключении содержимое сообщения и настроили его как hidden: false, то это
     * сообщение будет отображено пользователю в теле.
     * https://github.com/ns3777k/symfony-api-demo
     */
    private ExceptionMappingResolver $exceptionMappingResolver;
    private Logger $logger;
    private Serializer $serializer;

    public function __construct(ExceptionMappingResolver $exceptionMappingResolver, Logger $logger, Serializer $serializer): void
    {
        $this->exceptionMappingResolver = $exceptionMappingResolver;
        $this->logger = $logger;
        $this->serializer = $serializer;
    }
    public function __invoke(ExceptionEvent $event): void
    {
        $isApiZone = $event->getRequest()->attributes->get(AttributeRequest::API_ZONE, true);
        if (!$isApiZone) {
            return;
        }

        $throwable = $event->getThrowable();
        $mapping = $this->exceptionMappingResolver->resolve(\get_class($throwable));
        if (null === $mapping) {
            $mapping = new ExceptionMapping(Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        if ($mapping->getCode() >= Response::HTTP_INTERNAL_SERVER_ERROR || $mapping->isLoggable()) {
            $this->logger->error($throwable->getMessage(), [
                'trace' => $throwable->getTraceAsString(),
                'previous' => null !== $throwable->getPrevious() ? $throwable->getPrevious()->getMessage() : '',
            ]);
        }

        $message = $mapping->isHidden() ? Response::$statusTexts[$mapping->getCode()] : $throwable->getMessage();
        $data = $this->serializer->serialize(new ErrorResponseModel($message), JsonEncoder::FORMAT);
        $response = new JsonResponse($data, $mapping->getCode(), [], true);
        $event->setResponse($response);
    }
}