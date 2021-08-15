<?php
declare(strict_types=1);

namespace App\Application\Event;

use App\Application\Exception\RestApiException;
use App\Domain\Controller\RestApiController;
use Symfony\Component\HttpKernel\Event\ControllerEvent;

class RestApiTokenListener
{
    public function onKernelController(ControllerEvent $event)
    {
        $controller = $event->getController();

        if (is_array($controller)) {
            $controller = $controller[0];
        }

        if ($controller instanceof RestApiController) {
            $token = $event->getRequest()->headers->get('X-AUTH-TOKEN');
            if ($token !== $controller->getApiToken()) {
                throw new RestApiException('This action needs a valid token.', 401);
            }
        }
    }
}