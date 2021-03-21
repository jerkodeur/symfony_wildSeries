<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setUsername('user');
        $user->setEmail('jejouelas@hotmail.fr');
        $user->setPassword($this->passwordEncoder->encodePassword($user, 'hello'));
        $user->setRoles(['ROLE_USER']);

        $manager->persist($user);

        $admin = new User();
        $admin->setUsername('admin');
        $admin->setEmail('jerome.potie@gmail.com');
        $admin->setPassword($this->passwordEncoder->encodePassword($admin, 'hello'));
        $admin->setRoles(['ROLE_ADMIN']);

        $manager->persist($admin);

        $manager->flush();
    }
}
