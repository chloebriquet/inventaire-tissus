<?php

namespace App\DataFixtures;

use App\Entity\Fabric;
use App\Repository\ColorRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class FabricFixtures extends Fixture implements DependentFixtureInterface
{
    /** @var ColorRepository */
    private $colorRepository;

    /**
     * FabricFixtures constructor.
     * @param ColorRepository $colorRepository
     */
    public function __construct(ColorRepository $colorRepository)
    {
        $this->colorRepository = $colorRepository;
    }

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();
        $colors = $this->colorRepository->findAll();

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
            $fabric->addColor($colors[rand(0,19)]);

            $manager->persist($fabric);
        }

        $manager->flush();
    }

    /**
     * @inheritDoc
     */
    public function getDependencies()
    {
        return [
            ColorFixtures::class
        ];
    }
}
