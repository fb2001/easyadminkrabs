<?php

namespace App\Factory;

use App\Entity\Notation;
use Doctrine\ORM\EntityRepository;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;
use Zenstruck\Foundry\Persistence\Proxy;
use Zenstruck\Foundry\Persistence\ProxyRepositoryDecorator;

/**
 * @extends PersistentProxyObjectFactory<Notation>
 */
final class NotationFactory extends PersistentProxyObjectFactory{
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
        return Notation::class;
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function defaults(): array|callable
{
    return [
        'note' => self::faker()->randomFloat(1, 0, 5),  // Note entre 0 et 5 avec 1 décimale
        'commentaire' => self::faker()->optional(0.7)->text(),  // 70% de chance davoi un commentaire
        //'typeNotation' => self::faker()->randomElement(['Restaurant', 'Bar', 'Café', 'Shop']),
        'utilisateur' => UtilisateurFactory::randomOrCreate(),
        'enseigne' => EnseigneFactory::randomOrCreate(),
    ];
}



    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): static
    {
        return $this
            // ->afterInstantiate(function(Notation $notation): void {})
        ;
    }
}
