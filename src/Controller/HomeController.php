<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class HomeController extends BaseController
{
    /**
     * @Route("/", name="home")
     * @Route("/{route}", name="vue", requirements={"route" = "^(?!.*api|_wdt|_profiler).+"})
     */
    public function index(SerializerInterface $serializer): Response
    {
        return $this->render('index.html.twig', [
            'user' => $serializer->serialize($this->getUser(), 'jsonld', ['groups' => 'user:read']),
        ]);
    }
}
