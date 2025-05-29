<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250513231106 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE apprenant (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, date_naissance DATE NOT NULL COMMENT '(DC2Type:date_immutable)', tel INT NOT NULL, email VARCHAR(255) NOT NULL, sexe VARCHAR(255) NOT NULL, nationnalite VARCHAR(255) NOT NULL, profession VARCHAR(255) NOT NULL, anne_experience INT NOT NULL, dernier_diplome VARCHAR(255) NOT NULL, photo VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE apprenant_session (apprenant_id INT NOT NULL, session_id INT NOT NULL, INDEX IDX_F3DA1D4C5697D6D (apprenant_id), INDEX IDX_F3DA1D4613FECDF (session_id), PRIMARY KEY(apprenant_id, session_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE apprenant_session ADD CONSTRAINT FK_F3DA1D4C5697D6D FOREIGN KEY (apprenant_id) REFERENCES apprenant (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE apprenant_session ADD CONSTRAINT FK_F3DA1D4613FECDF FOREIGN KEY (session_id) REFERENCES session (id) ON DELETE CASCADE
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE apprenant_session DROP FOREIGN KEY FK_F3DA1D4C5697D6D
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE apprenant_session DROP FOREIGN KEY FK_F3DA1D4613FECDF
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE apprenant
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE apprenant_session
        SQL);
    }
}
