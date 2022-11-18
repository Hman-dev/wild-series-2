<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    const CATEGORIES = [
        'Action',
        'Aventure',
        'Animation',
        'Fantatisque',
        'Horreur',
    ];

    public function load(ObjectManager $manager)
    {
        // $category = new Category();
        // $category->setName('Horreur');
        // $manager->persist($category);
        // $manager->flush();
        
    // for ($i = 1; $i <= 50; $i++) {  
    //     $category = new Category();  
    //     $category->setName('Nom de catégorie ' . $i);  
    //     $manager->persist($category); prends en compte l'objet $category qui
    // a été instancié
    // }  
    // $manager->flush(); la méthode flush()qui permet d'executer toutes les reqêutes
    // SQL necessaires

    foreach (self::CATEGORIES as $categoryName) {  
        $category = new Category();  
        $category->setName($categoryName);  
        $manager->persist($category);
        $this->addReference('category_' . $categoryName, $category); 
    }  
    $manager->flush();

    }
}