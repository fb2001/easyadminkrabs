<?php

namespace App\Factory;

use App\Entity\Horaire;
use App\Enum\JourEnum;
use Doctrine\ORM\EntityRepository;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;
use Zenstruck\Foundry\Persistence\Proxy;
use Zenstruck\Foundry\Persistence\ProxyRepositoryDecorator;

/**
 * @extends PersistentProxyObjectFactory<Horaire>
 */
final class HoraireFactory extends PersistentProxyObjectFactory{
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
        return Horaire::class;
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function defaults(): array|callable
{
    $ouverture = self::faker()->dateTimeBetween('08:00', '12:00');
    $fermeture = clone $ouverture;
    $fermeture->modify('+'.self::faker()->numberBetween(6, 10).' hours');

    return [
        'enseigne' => EnseigneFactory::new(),
        'heureOuverture' => $ouverture,
        'heureFermeture' => $fermeture,
        'jour' => self::faker()->randomElement(JourEnum::cases()),
    ];
}

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): static
    {
        return $this
            // ->afterInstantiate(function(Horaire $horaire): void {})
        ;
    }
}
