<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250526104039 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE apprenant_session (apprenant_id INT NOT NULL, session_id INT NOT NULL, INDEX IDX_F3DA1D4C5697D6D (apprenant_id), INDEX IDX_F3DA1D4613FECDF (session_id), PRIMARY KEY(apprenant_id, session_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE coordinateur_formation (coordinateur_id INT NOT NULL, formation_id INT NOT NULL, INDEX IDX_AB85E4EBD32E46EA (coordinateur_id), INDEX IDX_AB85E4EB5200282E (formation_id), PRIMARY KEY(coordinateur_id, formation_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE coordinateur_syllabus (coordinateur_id INT NOT NULL, syllabus_id INT NOT NULL, INDEX IDX_8587C057D32E46EA (coordinateur_id), INDEX IDX_8587C057824D79E7 (syllabus_id), PRIMARY KEY(coordinateur_id, syllabus_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE refresh_tokens (id INT AUTO_INCREMENT NOT NULL, refresh_token VARCHAR(128) NOT NULL, username VARCHAR(255) NOT NULL, valid DATETIME NOT NULL, UNIQUE INDEX UNIQ_9BACE7E1C74F2195 (refresh_token), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE apprenant_session ADD CONSTRAINT FK_F3DA1D4C5697D6D FOREIGN KEY (apprenant_id) REFERENCES apprenant (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE apprenant_session ADD CONSTRAINT FK_F3DA1D4613FECDF FOREIGN KEY (session_id) REFERENCES session (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE coordinateur_formation ADD CONSTRAINT FK_AB85E4EBD32E46EA FOREIGN KEY (coordinateur_id) REFERENCES coordinateur (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE coordinateur_formation ADD CONSTRAINT FK_AB85E4EB5200282E FOREIGN KEY (formation_id) REFERENCES formation (id) ON DELETE CASCADE
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
            ALTER TABLE apprenant_session DROP FOREIGN KEY FK_F3DA1D4C5697D6D
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE apprenant_session DROP FOREIGN KEY FK_F3DA1D4613FECDF
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE coordinateur_formation DROP FOREIGN KEY FK_AB85E4EBD32E46EA
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE coordinateur_formation DROP FOREIGN KEY FK_AB85E4EB5200282E
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE coordinateur_syllabus DROP FOREIGN KEY FK_8587C057D32E46EA
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE coordinateur_syllabus DROP FOREIGN KEY FK_8587C057824D79E7
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE apprenant_session
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE coordinateur_formation
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE coordinateur_syllabus
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE refresh_tokens
        SQL);
    }
}
