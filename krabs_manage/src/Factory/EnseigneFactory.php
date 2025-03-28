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
final class EnseigneFactory extends PersistentProxyObjectFactory
{
    public static function class(): string
    {
        return Enseigne::class;
    }

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
    
    protected function initialize(): static
{
    return $this
        ->afterInstantiate(function(Enseigne $enseigne): void {
            // Create between 2 and 4 categories
            $categories = CategorieFactory::createMany(self::faker()->numberBetween(2, 4));
            foreach ($categories as $categorieProxy) {
                $categorie = $categorieProxy->_real();
                $enseigne->addCategory($categorie);
            }
        })
    ;
}
}