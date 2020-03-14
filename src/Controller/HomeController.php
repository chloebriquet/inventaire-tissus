<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class HomeController extends BaseController
{
    /**
     * @Route("/", name="home")
     */
    public function index(SerializerInterface $serializer)
    {
        return $this->render('index.html.twig', [
            'user'            => $serializer->serialize($this->getUser(), 'jsonld'),
        ]);
    }
}
