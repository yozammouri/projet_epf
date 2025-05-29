<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250513215949 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE session (id INT AUTO_INCREMENT NOT NULL, promotion_id INT NOT NULL, libelle_session VARCHAR(255) NOT NULL, date_demarrage DATE NOT NULL COMMENT '(DC2Type:date_immutable)', effectif INT NOT NULL, annee INT NOT NULL, INDEX IDX_D044D5D4139DF194 (promotion_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE session ADD CONSTRAINT FK_D044D5D4139DF194 FOREIGN KEY (promotion_id) REFERENCES promotion (id)
        SQL);
        // $this->addSql(<<<'SQL'
        //     ALTER TABLE formation CHANGE objectifs objectifs TEXT(8000) NOT NULL, CHANGE public public TEXT(8000) NOT NULL
        // SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE session DROP FOREIGN KEY FK_D044D5D4139DF194
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE session
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE formation CHANGE objectifs objectifs TEXT NOT NULL, CHANGE public public TEXT NOT NULL
        SQL);
    }
}
