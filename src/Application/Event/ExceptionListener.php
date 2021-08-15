<?php
declare(strict_types=1);

namespace App\Application\Event;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

class ExceptionListener
{
    public function onKernelException(ExceptionEvent $event)
    {
        $e = $event->getThrowable();

        $response = new JsonResponse([
                'status'        => 'error',
                'message'       => $e->getMessage()
            ],
            ($e->getStatusCode() == 0 ? 500 : $e->getStatusCode())
        );
        $response->headers->set('Content-Type', 'application/problem+json');

        $event->setResponse($response);
    }
}