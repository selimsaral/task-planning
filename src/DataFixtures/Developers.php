<?php

namespace App\DataFixtures;

use App\Entity\Developer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class Developers extends Fixture
{
    public function load(ObjectManager $manager)
    {
        /**
         * DEV1
         */
        $developer = new Developer();
        $developer->setName('DEV1');
        $developer->setHourlyCapacity('1');

        $manager->persist($developer);
        $manager->flush();

        /**
         * DEV 2
         */
        $developer = new Developer();
        $developer->setName('DEV2');
        $developer->setHourlyCapacity('2');

        $manager->persist($developer);

        /**
         * DEV 3
         */
        $developer = new Developer();
        $developer->setName('DEV3');
        $developer->setHourlyCapacity('3');

        $manager->persist($developer);

        /**
         * DEV 4
         */
        $developer = new Developer();
        $developer->setName('DEV4');
        $developer->setHourlyCapacity('4');

        $manager->persist($developer);

        /**
         * DEV 5
         */
        $developer = new Developer();
        $developer->setName('DEV5');
        $developer->setHourlyCapacity('5');

        $manager->persist($developer);
        $manager->flush();


    }
}
