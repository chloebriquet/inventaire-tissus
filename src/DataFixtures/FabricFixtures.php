<?php

namespace App\DataFixtures;

use App\Entity\Fabric;
use App\Repository\ColorRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class FabricFixtures extends Fixture implements DependentFixtureInterface
{
    protected ColorRepository $colorRepository;

    public function __construct(ColorRepository $colorRepository)
    {
        $this->colorRepository = $colorRepository;
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        $colors = $this->colorRepository->findAll();

        for ($i = 0; $i < 30; ++$i) {
            $fabric = new Fabric();
            $fabric->box = rand(1, 30);
            $fabric->material = $faker->word;
            $fabric->pattern = $faker->word;
            $fabric->state = $faker->word;
            $fabric->thickness = $faker->word;
            $fabric->width = rand(100, 500);
            $fabric->length = rand(100, 500);
            $fabric->comment = $faker->words(5, true);
            $fabric->addColor($colors[rand(0, 19)]);

            $manager->persist($fabric);
        }

        $manager->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function getDependencies()
    {
        return [
            ColorFixtures::class,
        ];
    }
}
