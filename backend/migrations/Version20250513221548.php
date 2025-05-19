<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250513221548 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE semestre (id INT AUTO_INCREMENT NOT NULL, session_id INT NOT NULL, libelle VARCHAR(255) NOT NULL, date_debut DATE NOT NULL COMMENT '(DC2Type:date_immutable)', date_fin DATE NOT NULL COMMENT '(DC2Type:date_immutable)', INDEX IDX_71688FBC613FECDF (session_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE semestre ADD CONSTRAINT FK_71688FBC613FECDF FOREIGN KEY (session_id) REFERENCES session (id)
        SQL);
        // $this->addSql(<<<'SQL'
        //     ALTER TABLE formation CHANGE objectifs objectifs TEXT(8000) NOT NULL, CHANGE public public TEXT(8000) NOT NULL
        // SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE semestre DROP FOREIGN KEY FK_71688FBC613FECDF
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE semestre
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE formation CHANGE objectifs objectifs TEXT NOT NULL, CHANGE public public TEXT NOT NULL
        SQL);
    }
}
