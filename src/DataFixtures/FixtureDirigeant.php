<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Dirigeant;
use DateTime;

class FixtureDirigeant extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        for ($i = 0; $i < 20; $i++) {
            $dirigeant = new Dirigeant('dirigeant '.$i, "dirigeant prenom".$i, new DateTime('now'));
            $manager->persist($dirigeant);
        }

        $manager->flush();
    }
}
