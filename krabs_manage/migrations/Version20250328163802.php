<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250328163802 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE favoris DROP FOREIGN KEY FK_8933C4326C2A0A71
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE favoris DROP FOREIGN KEY FK_8933C432FB88E14F
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE favoris
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE favoris (enseigne_id INT NOT NULL, utilisateur_id INT NOT NULL, INDEX IDX_8933C4326C2A0A71 (enseigne_id), INDEX IDX_8933C432FB88E14F (utilisateur_id), PRIMARY KEY(enseigne_id, utilisateur_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = '' 
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE favoris ADD CONSTRAINT FK_8933C4326C2A0A71 FOREIGN KEY (enseigne_id) REFERENCES enseigne (id) ON UPDATE NO ACTION ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE favoris ADD CONSTRAINT FK_8933C432FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id) ON UPDATE NO ACTION ON DELETE CASCADE
        SQL);
    }
}
