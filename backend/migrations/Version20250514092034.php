<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250514092034 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE activite_enseignement (id INT AUTO_INCREMENT NOT NULL, module_id INT NOT NULL, intitule VARCHAR(255) NOT NULL, vh DOUBLE PRECISION NOT NULL, th DOUBLE PRECISION NOT NULL, langue VARCHAR(255) NOT NULL, nb_seance INT NOT NULL, nb_groupe INT NOT NULL, INDEX IDX_4E2C7FCCAFC2B591 (module_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE activite_enseignement ADD CONSTRAINT FK_4E2C7FCCAFC2B591 FOREIGN KEY (module_id) REFERENCES module (id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE activite_enseignement DROP FOREIGN KEY FK_4E2C7FCCAFC2B591
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE activite_enseignement
        SQL);
    }
}
