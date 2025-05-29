<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250513145803 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE formation_catalogue (formation_id INT NOT NULL, catalogue_id INT NOT NULL, INDEX IDX_93DBC9285200282E (formation_id), INDEX IDX_93DBC9284A7843DC (catalogue_id), PRIMARY KEY(formation_id, catalogue_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE formation_catalogue ADD CONSTRAINT FK_93DBC9285200282E FOREIGN KEY (formation_id) REFERENCES formation (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE formation_catalogue ADD CONSTRAINT FK_93DBC9284A7843DC FOREIGN KEY (catalogue_id) REFERENCES catalogue (id) ON DELETE CASCADE
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE formation_catalogue DROP FOREIGN KEY FK_93DBC9285200282E
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE formation_catalogue DROP FOREIGN KEY FK_93DBC9284A7843DC
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE formation_catalogue
        SQL);
    }
}
