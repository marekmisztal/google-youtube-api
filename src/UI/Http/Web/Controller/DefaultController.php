<?php
declare(strict_types=1);

namespace App\UI\Http\Web\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController
{
    /**
     * @Route("/", name="index", methods={"GET"})
     */
    public function index()
    {
        return new Response();
    }
}
