<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250514092950 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE activite_enseignement_intervenant (activite_enseignement_id INT NOT NULL, intervenant_id INT NOT NULL, INDEX IDX_5628AECD648BA380 (activite_enseignement_id), INDEX IDX_5628AECDAB9A1716 (intervenant_id), PRIMARY KEY(activite_enseignement_id, intervenant_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE intervenant (id INT AUTO_INCREMENT NOT NULL, civilite VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, tel INT NOT NULL, mode_paiement VARCHAR(255) NOT NULL, etablissement_origine VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE activite_enseignement_intervenant ADD CONSTRAINT FK_5628AECD648BA380 FOREIGN KEY (activite_enseignement_id) REFERENCES activite_enseignement (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE activite_enseignement_intervenant ADD CONSTRAINT FK_5628AECDAB9A1716 FOREIGN KEY (intervenant_id) REFERENCES intervenant (id) ON DELETE CASCADE
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE activite_enseignement_intervenant DROP FOREIGN KEY FK_5628AECD648BA380
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE activite_enseignement_intervenant DROP FOREIGN KEY FK_5628AECDAB9A1716
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE activite_enseignement_intervenant
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE intervenant
        SQL);
    }
}
