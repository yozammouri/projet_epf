<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250513230219 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE coordinateur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, tel INT NOT NULL, matricule VARCHAR(255) NOT NULL, photo VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE coordinateur_formation (coordinateur_id INT NOT NULL, formation_id INT NOT NULL, INDEX IDX_AB85E4EBD32E46EA (coordinateur_id), INDEX IDX_AB85E4EB5200282E (formation_id), PRIMARY KEY(coordinateur_id, formation_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE coordinateur_formation ADD CONSTRAINT FK_AB85E4EBD32E46EA FOREIGN KEY (coordinateur_id) REFERENCES coordinateur (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE coordinateur_formation ADD CONSTRAINT FK_AB85E4EB5200282E FOREIGN KEY (formation_id) REFERENCES formation (id) ON DELETE CASCADE
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE coordinateur_formation DROP FOREIGN KEY FK_AB85E4EBD32E46EA
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE coordinateur_formation DROP FOREIGN KEY FK_AB85E4EB5200282E
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE coordinateur
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE coordinateur_formation
        SQL);
    }
}
