<?php

namespace App\DataFixtures;

use App\Entity\Fabric;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class FabricFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();

        for ($i = 0; $i < 30; $i++) {
            $fabric = new Fabric();
            $fabric->setBox(rand(1, 30));
            $fabric->setMaterial($faker->word);
            $fabric->setPattern($faker->word);
            $fabric->setState($faker->word);
            $fabric->setThickness($faker->word);
            $fabric->setWidth(rand(100, 500));
            $fabric->setLength(rand(100, 500));
            $fabric->setComment($faker->words(5, true));

            $manager->persist($fabric);
        }

        $manager->flush();
    }
}
