<?php

namespace App\DataFixtures;

use App\Entity\Color;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ColorFixtures extends Fixture
{
    private $webcolors;

    public function __construct(array $webcolors)
    {
        $this->webcolors = $webcolors;
    }

    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 20; ++$i) {
            $color = new Color();
            $color->setCode($this->webcolors[$i]);
            $color->setName($this->webcolors[$i]);

            $manager->persist($color);
        }

        $manager->flush();
    }
}
