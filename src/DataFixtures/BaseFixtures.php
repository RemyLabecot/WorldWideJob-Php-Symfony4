<?php
/**
 * Created by PhpStorm.
 * User: Damien-trqr
 * Date: 13/01/19
 * Time: 23:08
 */

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

abstract class BaseFixtures extends Fixture
{
    /**
     * @const int
     */
    const BATCH_MAX_SIZE = 10;

    /**
     * @var ObjectManager
     */
    protected $manager;

    /**
     * @var Generator
     */
    protected $faker;

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $this->manager = $manager;
        $this->faker = Factory::create('fr_FR');
        $this->loadData($manager);
        //$manager->flush();
    }

    abstract protected function loadData(ObjectManager $manager);

    protected function createMany(string $className, int $count, callable $factory)
    {
        for ($i = 0; $i < $count; $i++) {
            $entity = new $className();
            $this->manager->persist($entity);
            $this->addReference($className . '_' .$i, $entity);
            $factory($entity, $i);
        }
    }
}
