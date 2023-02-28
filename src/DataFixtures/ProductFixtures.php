<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Product;

class ProductFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    { $productList=[
       
        [  "name"=> "Iphone 14",
            "description"=> " 240g, 7.9mm thickness , 
            iOS 16, up to iOS 16.3
            128GB/256GB/1TB storage, no card slot ",
            "reference"=>'I2022',
            "price"=>'1000',
            "quantity"=>50
        ],
        [  "name"=> "Iphone 13",
        "description"=> " 240g, 7.9mm thickness , 
        iOS 16, up to iOS 16.3
        128GB/256GB/1TB storage, no card slot ",
        "reference"=>'I2022',
        "price"=>'1000',
        "quantity"=>50
    ],
    [  "name"=> "Iphone 15",
    "description"=> " 240g, 7.9mm thickness , 
    iOS 16, up to iOS 16.3
    128GB/256GB/1TB storage, no card slot ",
    "reference"=>'I2022',
    "price"=>'1000', 
    "quantity"=>50
],
    ];
    foreach ($productList as $prod){
        $product =new Product();
        $product->setName( $prod["name"])
                ->setDescription($prod["description"])
                ->setReference( $prod["reference"])
                ->setPrice( $prod["price"])
                ->setQuantity( $prod["quantity"]);

        $manager->persist($product); 
}
    $manager->flush();
    }
    public function getDependencies()
    {
        return array(
            Product::class,
        );
}
}
