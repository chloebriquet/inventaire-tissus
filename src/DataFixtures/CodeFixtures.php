<?php

namespace App\DataFixtures;

use App\Entity\Code;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CodeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $code = new Code();
        $code->name = 'code';

        $manager->persist($code);
        $manager->flush();
    }
}
