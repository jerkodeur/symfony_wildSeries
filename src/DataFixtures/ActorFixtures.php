<?php

namespace App\DataFixtures;

use Faker\Factory as Factory;
use Faker;
use App\Entity\Actor;
use App\Entity\Program;
use App\Service\Slugify;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ActorFixtures extends Fixture implements DependentFixtureInterface
{
    const ACTORS = [
        'Andrew Lincoln' => [
            'programs' => ['Walking Dead', 'Fear The Walking Dead'],
            'photo' => 'https://fr.web.img4.acsta.net/r_1920_1080/pictures/18/10/23/10/56/1129161.jpg'
        ],
        'Norman Reedus' => [
            'programs' => ['Walking Dead'],
            'photo' => 'https://fr.web.img5.acsta.net/r_1280_720/pictures/17/03/21/10/41/599502.jpg'
        ],
        'Lauren Cohan' => [
            'programs' => ['Walking Dead'],
            'photo' => 'https://static.wikia.nocookie.net/supernatural/images/4/47/Lauren_Cohan_1.jpg/revision/latest/scale-to-width-down/310?cb=20180302081528&path-prefix=fr'
        ],
        'Danai Gurira' => [
            'programs' => ['Walking Dead'],
            'photo' => 'https://static.wikia.nocookie.net/walkingdead/images/8/84/Danai_grira_2019.jpg/revision/latest/scale-to-width-down/350?cb=20181203012805'
        ]
    ];

    private $slugify;

    public function __construct(Slugify $slugify)
    {
        $this->slugify = $slugify;
    }

    public function load(ObjectManager $manager)
    {
        // persist raw datas
        foreach (self::ACTORS as $name => $datas) {
            $actor = new Actor();
            $actor->setName($name);
            $actor->setPhoto($datas['photo']);
            $actor->setSlug($this->slugify->generate($actor->getName()));
            foreach ($datas['programs'] as $program) {
                $actor->addProgram($this->getReference($program));
            };
            $manager->persist($actor);
        }

        // persist Faker datas
        $faker = Factory::create();
        for ($i = 0; $i < 10; $i++) {
            $actor = new Actor();
            $actor->setName($faker->name);
            $actor->setSlug($this->slugify->generate($actor->getName()));
            $rand = random_int(1, 3);
            for ($j = 0; $j <= $rand; $j++) {
                $actor->addProgram($this->getReference('program_' . $faker->numberBetween(0, 5)));
            }
            $manager->persist($actor);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [ProgramFixtures::class];
    }
}
