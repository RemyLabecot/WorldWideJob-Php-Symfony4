<?php

namespace App\DataFixtures;

use App\Entity\Skill;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class SkillsFixtures extends Fixture
{
    const BATCH_SIZE = 20;
    public function load(ObjectManager $manager)
    {
        $csv = fopen(dirname(__FILE__) . '/Resources/skill.csv', 'r');

        $i = 0;

        while (!feof($csv)) {
            $line = fgetcsv($csv);
            $skill = new Skill();
            $skill->setName($line[0] ?? 'Symfony');
            $this->addReference('skill_'.$i, $skill);
            $manager->persist($skill);
            if (($i % self::BATCH_SIZE) === 0) {
                $manager->flush();
                $manager->clear();
            }
            $i++;
        }
        $manager->flush();
        $manager->clear();
    }
}
