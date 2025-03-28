<?php

namespace App\Factory;

use App\Entity\Enseigne;
use Doctrine\ORM\EntityRepository;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;
use Zenstruck\Foundry\Persistence\Proxy;
use Zenstruck\Foundry\Persistence\ProxyRepositoryDecorator;

/**
 * @extends PersistentProxyObjectFactory<Enseigne>
 */
final class EnseigneFactory extends PersistentProxyObjectFactory{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
    }

    public static function class(): string
    {
        return Enseigne::class;
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function defaults(): array|callable
    {
        return [
            'adresse' => self::faker()->address(),
            'description' => self::faker()->paragraphs(3, true),
            'gpsLocation' => self::faker()->latitude().','.self::faker()->longitude(),
            'nom' => self::faker()->company(),
            'noteSeuil' => self::faker()->randomFloat(1, 0, 5),
            'numeroTelephone' => self::faker()->e164PhoneNumber(),
            'photo' => self::faker()->imageUrl(640, 480, 'business'),
        ];
    }
    

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): static
{
    return $this
        ->afterInstantiate(function(Enseigne $enseigne): void {
            // Ajout de catégories
            $categories = CategorieFactory::new()->many(2, 4);
            foreach ($categories as $categorie) {
                $enseigne->addCategory($categorie);
            }
        })
    ;
}
}
