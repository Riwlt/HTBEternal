<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends AbstractController
{
    public function index(): Response
    {
        return $this->render(
            '/templates/base.html.twig', []
        );
    }

    public function login(): Response
    {
        return $this->render(
            '/templates/login.html.twig', []
        );
    }
}