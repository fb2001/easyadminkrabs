<?php

namespace App\Factory;

use App\Entity\Utilisateur;
use Doctrine\ORM\EntityManagerInterface;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;
use App\Entity\Enseigne;  // Add this import

/**
 * @extends PersistentProxyObjectFactory<Utilisateur>
 */
final class UtilisateurFactory extends PersistentProxyObjectFactory
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public static function class(): string
    {
        return Utilisateur::class;
    }

    protected function defaults(): array|callable
    {
        return [
            'age' => self::faker()->numberBetween(18, 90),
            'email' => self::faker()->unique()->safeEmail(),
            'nom' => self::faker()->lastName(),
            'password' => 'password',
            'prenom' => self::faker()->firstName(),
            'numeroTelephone' => self::faker()->e164PhoneNumber(),
            'photoProfil' => self::faker()->imageUrl(640, 480, 'people'),
        ];
    }

    protected function initialize(): static
    {
        return $this
            ->afterInstantiate(function(Utilisateur $utilisateur): void {
                // Fetch existing Enseigne entities instead of creating new ones
                $enseignes = $this->entityManager->getRepository(Enseigne::class)->findBy([], null, 3);
                
                // If not enough existing entities, create some
                if (count($enseignes) < 3) {
                    $enseignes = array_merge(
                        $enseignes, 
                        EnseigneFactory::createMany(3 - count($enseignes))
                    );
                }
                
                // Add existing or newly created Enseigne entities
                foreach ($enseignes as $enseigne) {
                    $utilisateur->addEnseignesFavorite($enseigne);
                }
            })
        ;
    }
}