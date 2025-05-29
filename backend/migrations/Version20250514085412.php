<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250514085412 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE unite_enseignement (id INT AUTO_INCREMENT NOT NULL, syllabus_id INT NOT NULL, code_ue VARCHAR(255) NOT NULL, nature VARCHAR(255) NOT NULL, intitule_fr VARCHAR(255) NOT NULL, intitule_en VARCHAR(255) NOT NULL, ects INT NOT NULL, vh INT NOT NULL, vh_cm INT NOT NULL, vh_cma INT NOT NULL, vh_td DOUBLE PRECISION NOT NULL, vh_tp DOUBLE PRECISION NOT NULL, vh_projet DOUBLE PRECISION NOT NULL, vh_hap DOUBLE PRECISION NOT NULL, vh_hanp DOUBLE PRECISION NOT NULL, cout_eq_td INT NOT NULL, cout_taux_a INT NOT NULL, cout_taux_b INT NOT NULL, cout_taux_c INT NOT NULL, cout_taux_d INT NOT NULL, cout_taux_e INT NOT NULL, cout_taux_f INT NOT NULL, cout_taux_h INT NOT NULL, coef INT NOT NULL, INDEX IDX_46D07C4F824D79E7 (syllabus_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE unite_enseignement ADD CONSTRAINT FK_46D07C4F824D79E7 FOREIGN KEY (syllabus_id) REFERENCES syllabus (id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE unite_enseignement DROP FOREIGN KEY FK_46D07C4F824D79E7
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE unite_enseignement
        SQL);
    }
}
