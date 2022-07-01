<?php

namespace App\DataFixtures;

use App\Entity\Project;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ProjectFictures extends Fixture
{

    public const TEAM = ['Orléans', 'Paris', 'Lyon', 'Strasbourg', 'Lille'];
    public const NAME = ['New App', 'New Fonctionality', 'Marketing', 'Communication', 'Lifestyle'];

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        for ($i = 0; $i < 50; $i++){
        $project = new Project;
        $project->setName(self::NAME[array_rand(self::NAME)]);
        $project->setTeam(self::TEAM[array_rand(self::TEAM)]);
        $project->setContent($faker->paragraphs(rand(7, 15), true));
        $project->setPicture1('https://picsum.photos/1000/300');
        $project->setImage2('https://picsum.photos/400/300');
        $project->setImage3('https://picsum.photos/400/300');
        $project->setStatus('open');
        $project->setHasSuperProject(false);

        $manager->persist($project);
        }

        $faker = Factory::create();
        for ($i = 0; $i < 9; $i++){
        $project = new Project;
        $project->setName(self::NAME[array_rand(self::NAME)]);
        $project->setTeam(self::TEAM[array_rand(self::TEAM)]);
        $project->setContent($faker->paragraphs(rand(7, 15), true));
        $project->setPicture1('https://picsum.photos/1000/300');
        $project->setImage2('https://picsum.photos/400/300');
        $project->setImage3('https://picsum.photos/400/300');
        $project->setStatus('open');
        $project->setHasSuperProject(true);

        $manager->persist($project);
        }
    
        $manager->flush();
    }
}
