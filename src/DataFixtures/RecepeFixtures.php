<?php

namespace App\DataFixtures;

use App\Entity\Recepe;
use Faker\Factory;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class RecepeFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        for ($i = 0; $i < 40; $i++){
            $recepe = new Recepe();
            $recepe->setName($faker->sentence(4));
            $recepe->setUser($this->getReference("user" . \random_int(0, 9)));
            $this->addReference("recepe" . $i , $recepe);
            $manager->persist($recepe);
        }
        
        $manager->flush();
    }
    public function getDependencies()
    {
        return [UserFixtures::class];
    }
}
