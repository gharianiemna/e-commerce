<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Category;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $catList=[
            [  "name"=> "high tech",
                "type"=>'technology', 
            ],
            [  "name"=> "houseware",
                "type"=>"home"
            ],
            [  "name"=> "skincare",
                "type"=>"cosmetics"
            ],
        ];
        foreach ($catList as $cat){
            $category =new Category();
            $category->setName( $cat["name"])
                     ->setType($cat["type"]);
            $manager->persist($category); 
        }
        $manager->flush();
    }
    public function getDependencies()
    {
            return array(
                Category::class,
            );
    }
    
}
