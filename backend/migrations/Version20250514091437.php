<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250514091437 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE module (id INT AUTO_INCREMENT NOT NULL, unite_enseignement_id INT NOT NULL, code_module INT NOT NULL, code_matiere VARCHAR(255) NOT NULL, nature VARCHAR(255) NOT NULL, intitule VARCHAR(255) NOT NULL, details_contenu VARCHAR(255) DEFAULT NULL, details_groupes VARCHAR(255) DEFAULT NULL, ects DOUBLE PRECISION NOT NULL, vh DOUBLE PRECISION NOT NULL, vh_cm DOUBLE PRECISION DEFAULT NULL, vh_cma DOUBLE PRECISION DEFAULT NULL, vh_td DOUBLE PRECISION DEFAULT NULL, vh_tp DOUBLE PRECISION DEFAULT NULL, vh_projet DOUBLE PRECISION DEFAULT NULL, vh_hap DOUBLE PRECISION DEFAULT NULL, vh_hanp DOUBLE PRECISION DEFAULT NULL, cout_eq_td INT NOT NULL, cout_taux_a INT NOT NULL, cout_taux_b INT NOT NULL, cout_taux_c INT NOT NULL, cout_taux_d INT NOT NULL, cout_taux_e INT NOT NULL, cout_taux_f INT NOT NULL, cout_taux_h INT DEFAULT NULL, INDEX IDX_C24262818DEEBA5 (unite_enseignement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE module ADD CONSTRAINT FK_C24262818DEEBA5 FOREIGN KEY (unite_enseignement_id) REFERENCES unite_enseignement (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE unite_enseignement CHANGE ects ects DOUBLE PRECISION NOT NULL, CHANGE vh vh DOUBLE PRECISION NOT NULL, CHANGE vh_cm vh_cm DOUBLE PRECISION DEFAULT NULL, CHANGE vh_cma vh_cma DOUBLE PRECISION DEFAULT NULL, CHANGE vh_td vh_td DOUBLE PRECISION DEFAULT NULL, CHANGE vh_tp vh_tp DOUBLE PRECISION DEFAULT NULL, CHANGE vh_projet vh_projet DOUBLE PRECISION DEFAULT NULL, CHANGE vh_hap vh_hap DOUBLE PRECISION DEFAULT NULL, CHANGE vh_hanp vh_hanp DOUBLE PRECISION DEFAULT NULL, CHANGE cout_eq_td cout_eq_td INT DEFAULT NULL
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE module DROP FOREIGN KEY FK_C24262818DEEBA5
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE module
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE unite_enseignement CHANGE ects ects INT NOT NULL, CHANGE vh vh INT NOT NULL, CHANGE vh_cm vh_cm INT NOT NULL, CHANGE vh_cma vh_cma INT NOT NULL, CHANGE vh_td vh_td DOUBLE PRECISION NOT NULL, CHANGE vh_tp vh_tp DOUBLE PRECISION NOT NULL, CHANGE vh_projet vh_projet DOUBLE PRECISION NOT NULL, CHANGE vh_hap vh_hap DOUBLE PRECISION NOT NULL, CHANGE vh_hanp vh_hanp DOUBLE PRECISION NOT NULL, CHANGE cout_eq_td cout_eq_td INT NOT NULL
        SQL);
    }
}
