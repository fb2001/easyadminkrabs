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
        'ambiance' => self::faker()->numberBetween(1, 5),
        'prix' => self::faker()->numberBetween(1, 5),
        'qualite' => self::faker()->numberBetween(1, 5),
        'typeNotation' => self::faker()->randomElement(['Restaurant', 'Bar', 'Café', 'Shop']),
        'utilisateur' => UtilisateurFactory::new(),
        'enseigne' => EnseigneFactory::new(),
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
