<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use App\Entity\Season;
use App\Service\Slugify;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class SeasonFixtures extends Fixture implements DependentFixtureInterface
{
    private $slug;

    public function __construct(Slugify $slugify)
    {
        $this->slug = $slugify;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');
        for ($i = 0; $i < 6; $i++) {
            for ($j = 1; $j <= $faker->numberBetween(1, 15); $j++) {
                $season = new Season();
                $season->setProgram($this->getReference('program_' . $i));
                $season->setNumber($j);
                $season->setYear($faker->year($max = 'now'));
                $season->setDescription($faker->realText(500));
                $manager->persist($season);
                for ($k = 1; $k <= $faker->numberBetween(5, 10); $k++) {
                    $episode = new Episode();
                    $episode->setNumber($k);
                    $episode->setTitle($faker->realText(50));
                    $episode->setSlug($this->slug->generate($episode->getTitle()));
                    $episode->setSynopsis($faker->realText(500));
                    $episode->setSeason($season);
                    $manager->persist($episode);
                }
            }
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [ProgramFixtures::class];
    }
}
