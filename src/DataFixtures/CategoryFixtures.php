<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    const CATEGORIES = [
        'Horreur',
        'Humour',
        'Policier',
        'Action',
        'Thriller',
        'Fantastique',
        'Médiéval'
    ];

    public function load(ObjectManager $manager)
    {
        //TODO Load one fixture
        $category = new Category();
        $category->setName('Aventure');
        $manager->persist($category);

        //TODO Load many features
        foreach (self::CATEGORIES as $category_name) {
            $category = new Category();
            $category->setName($category_name);
            $manager->persist($category);
            $this->addReference($category_name, $category);
        };

        $manager->flush();
    }
}
