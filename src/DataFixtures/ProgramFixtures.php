<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    public const PROGRAM = [
        'Shining(1980)'=> 'folie meurtriere d\'un écrivain dans un hotel',
        'Pulp Fiction(1994)' => 'Insomniaque, désillusionné par sa vie personnelle ',
       ' Interstellar (2014)'=> 'Alors que la vie sur Terre touche à sa fin, un groupe ',
       'Blade Runner(1982)'=> '2019, Los Angeles. La Terre est surpeuplée et l’humanité est partie coloniser l’espace.',
       'The Dark Knight - Le Chevalier noir (2008)'=> 'Avec l\'appui du lieutenant de police Jim Gordon et du procureur',
       'Inception (2010)' => 'Dom Cobb est un voleur expérimenté, le meilleur dans l\'art dangereux de l\'extraction : ',
    ];
    public function load(ObjectManager $manager): void
    {
        foreach (self::PROGRAM as $ProgramName=>$SynopsisName ) 
        {
            # code...

            $program = new Program();
            $program->setTitle($ProgramName);
            $program->setSynopsis($SynopsisName);
            $program->setCategory($this->getReference('category_Horreur'));
            $manager->persist($program);
        }

        $manager->flush();
        
    }

    public function getDependencies()
    {
        return[
            CategoryFixtures::class,
        ];
    }
}
