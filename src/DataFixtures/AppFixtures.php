<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Category;
use App\Entity\Product;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        for($i=0; $i < 10; $i++){
            $category = new Category();
            $category->setName("NomDeCategorie $i");
            $manager->persist($category);
        
                for($j=0; $j < 10; $j++){
                    $Subcategory = new Category();
                    $Subcategory->setName("NomDeSousCategorie $i-$j")
                                ->setParent($category);
                    $manager->persist($Subcategory);
                
                    for($k=0; $k < 10; $k++){
                        $product = new Product();
                        $product->setTitle("Titre Produit $i - $j - $k")
                                ->setBrand("Marque $i - $j - $k")
                                ->setDescription("Description zaertyyirezoopipo $i - $j - $k qgsdhjklkmjm $i - $j - $k")
                                ->setPhotos("Photo $i - $j - $k")
                                ->setURLaffiliation("https://www.google.fr")
                                ->setCategory($Subcategory);            
                        $manager->persist($product);
                        }
                }
        }
    $manager->flush();
    }
        
}