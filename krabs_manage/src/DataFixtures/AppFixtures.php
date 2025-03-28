<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Factory\UserFactory;
use App\Factory\EnseigneFactory;
use App\Factory\CategorieFactory;
use App\Factory\NotationFactory;
use App\Factory\HoraireFactory;
use App\Factory\UtilisateurFactory;


class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        CategorieFactory::createMany(10);
        EnseigneFactory::createMany(10);
        UtilisateurFactory::createMany(10);
        NotationFactory::createMany(10);
        HoraireFactory::createMany(10);
        UserFactory::createMany(1);

        $manager->flush();
    }
}
