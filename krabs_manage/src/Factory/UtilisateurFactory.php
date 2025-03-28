<?php

namespace App\Factory;

use App\Entity\Utilisateur;
use Doctrine\ORM\EntityRepository;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;
use Zenstruck\Foundry\Persistence\Proxy;
use Zenstruck\Foundry\Persistence\ProxyRepositoryDecorator;

/**
 * @extends PersistentProxyObjectFactory<Utilisateur>
 */
final class UtilisateurFactory extends PersistentProxyObjectFactory{
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
        return Utilisateur::class;
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function defaults(): array|callable
{
    return [
        'age' => self::faker()->numberBetween(18, 90),
        'email' => self::faker()->unique()->email(),
        'nom' => self::faker()->lastName(),
        'password' => faker()->text(255), // À adapter avec votre système de hash
        'prenom' => self::faker()->firstName(),
        'numeroTelephone' => self::faker()->e164PhoneNumber(),
        'photoProfil' => self::faker()->imageUrl(640, 480, 'people'),
    ];
}

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): static
{
    return $this
        ->afterInstantiate(function(Utilisateur $utilisateur): void {
            // Ajout d'enseignes favorites
            $enseignes = EnseigneFactory::new()->many(3, 5);
            foreach ($enseignes as $enseigne) {
                $utilisateur->addEnseignesFavorite($enseigne);
            }
        })
    ;
}
}
