<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @IsGranted("ROLE_USER")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/api/user", name="user")
     */
    public function index()
    {
        $user = $this->getUser();

        return $this->json($user, 200, [], [
            'groups' => ['user:read'],
        ]);
    }
}
