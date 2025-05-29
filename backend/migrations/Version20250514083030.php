<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250514083030 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE coordinateur_syllabus (coordinateur_id INT NOT NULL, syllabus_id INT NOT NULL, INDEX IDX_8587C057D32E46EA (coordinateur_id), INDEX IDX_8587C057824D79E7 (syllabus_id), PRIMARY KEY(coordinateur_id, syllabus_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE coordinateur_syllabus ADD CONSTRAINT FK_8587C057D32E46EA FOREIGN KEY (coordinateur_id) REFERENCES coordinateur (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE coordinateur_syllabus ADD CONSTRAINT FK_8587C057824D79E7 FOREIGN KEY (syllabus_id) REFERENCES syllabus (id) ON DELETE CASCADE
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE coordinateur_syllabus DROP FOREIGN KEY FK_8587C057D32E46EA
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE coordinateur_syllabus DROP FOREIGN KEY FK_8587C057824D79E7
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE coordinateur_syllabus
        SQL);
    }
}
