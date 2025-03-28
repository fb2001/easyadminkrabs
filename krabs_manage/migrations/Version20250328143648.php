<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250328143648 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE favoris DROP FOREIGN KEY FK_8933C432A76ED395
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE notation DROP FOREIGN KEY FK_268BC95A76ED395
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, age INT NOT NULL, numero_telephone VARCHAR(255) DEFAULT NULL, adresse_mail VARCHAR(255) DEFAULT NULL, photo_profil VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_1D1C63B3E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE user
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_8933C432A76ED395 ON favoris
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX `primary` ON favoris
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE favoris CHANGE user_id utilisateur_id INT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE favoris ADD CONSTRAINT FK_8933C432FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_8933C432FB88E14F ON favoris (utilisateur_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE favoris ADD PRIMARY KEY (enseigne_id, utilisateur_id)
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_268BC95A76ED395 ON notation
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE notation CHANGE user_id utilisateur_id INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE notation ADD CONSTRAINT FK_268BC95FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_268BC95FB88E14F ON notation (utilisateur_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE favoris DROP FOREIGN KEY FK_8933C432FB88E14F
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE notation DROP FOREIGN KEY FK_268BC95FB88E14F
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, email VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, password VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, prenom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, age INT NOT NULL, numero_telephone VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, adresse_mail VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, photo_profil VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = '' 
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE utilisateur
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_8933C432FB88E14F ON favoris
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX `PRIMARY` ON favoris
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE favoris CHANGE utilisateur_id user_id INT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE favoris ADD CONSTRAINT FK_8933C432A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_8933C432A76ED395 ON favoris (user_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE favoris ADD PRIMARY KEY (enseigne_id, user_id)
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_268BC95FB88E14F ON notation
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE notation CHANGE utilisateur_id user_id INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE notation ADD CONSTRAINT FK_268BC95A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_268BC95A76ED395 ON notation (user_id)
        SQL);
    }
}
