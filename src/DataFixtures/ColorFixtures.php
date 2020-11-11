<?php

namespace App\DataFixtures;

use App\Entity\Color;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ColorFixtures extends Fixture
{
    /** @var array<string> */
    protected array $webcolors;

    /** @param  array<string> $webcolors */
    public function __construct(array $webcolors)
    {
        $this->webcolors = $webcolors;
    }

    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 20; ++$i) {
            $color = new Color();
            $color->code = $this->webcolors[$i];
            $color->name = $this->webcolors[$i];

            $manager->persist($color);
        }

        $manager->flush();
    }
}
