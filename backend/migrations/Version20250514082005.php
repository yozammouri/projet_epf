<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250514082005 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE syllabus (id INT AUTO_INCREMENT NOT NULL, semestre_id INT NOT NULL, libelle VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_4E74AB925577AFDB (semestre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE syllabus ADD CONSTRAINT FK_4E74AB925577AFDB FOREIGN KEY (semestre_id) REFERENCES semestre (id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE syllabus DROP FOREIGN KEY FK_4E74AB925577AFDB
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE syllabus
        SQL);
    }
}
