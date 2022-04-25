<?php

namespace Core\Shared\Infrastructure\Symfony;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

final class ApiExceptionListener
{
    public function onException(ExceptionEvent $event): void
    {
        /*
        $response = new JsonResponse(
            [
                'error' => $event->getThrowable()->getMessage()
            ],
            Response::HTTP_BAD_REQUEST
        );

        $event->setResponse($response);
        */
    }
}
