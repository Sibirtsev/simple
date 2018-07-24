<?php

namespace App\DataFixtures;

use App\Entity\Simple;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $rows = [
            ['hello', new \DateTime('2013-12-31'),],
            ['world', new \DateTime('2014-01-01'),],
        ];

        foreach ($rows as [$name, $date]) {
            $simple = new Simple();
            $simple->setName($name)->setCreatedOn($date);

            $manager->persist($simple);
        }

        $manager->flush();
    }
}
