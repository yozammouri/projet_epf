<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250612101152 extends AbstractMigration
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
            CREATE TABLE activite_enseignement_intervenant (activite_enseignement_id INT NOT NULL, intervenant_id INT NOT NULL, INDEX IDX_5628AECD648BA380 (activite_enseignement_id), INDEX IDX_5628AECDAB9A1716 (intervenant_id), PRIMARY KEY(activite_enseignement_id, intervenant_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);


        $this->addSql(<<<'SQL'
            CREATE TABLE refresh_tokens (id INT AUTO_INCREMENT NOT NULL, refresh_token VARCHAR(128) NOT NULL, username VARCHAR(255) NOT NULL, valid DATETIME NOT NULL, UNIQUE INDEX UNIQ_9BACE7E1C74F2195 (refresh_token), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE apprenant_session ADD CONSTRAINT FK_F3DA1D4C5697D6D FOREIGN KEY (apprenant_id) REFERENCES apprenant (id_apprenant)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE apprenant_session ADD CONSTRAINT FK_F3DA1D4613FECDF FOREIGN KEY (session_id) REFERENCES session (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE coordinateur_formation ADD CONSTRAINT FK_AB85E4EBD32E46EA FOREIGN KEY (coordinateur_id) REFERENCES coordinateur (id_coordinateur)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE coordinateur_formation ADD CONSTRAINT FK_AB85E4EB5200282E FOREIGN KEY (formation_id) REFERENCES formation (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE coordinateur_syllabus ADD CONSTRAINT FK_8587C057D32E46EA FOREIGN KEY (coordinateur_id) REFERENCES coordinateur (id_coordinateur)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE coordinateur_syllabus ADD CONSTRAINT FK_8587C057824D79E7 FOREIGN KEY (syllabus_id) REFERENCES syllabus (id)
        SQL);
        

        $this->addSql(<<<'SQL'
            ALTER TABLE activite_enseignement_intervenant ADD CONSTRAINT FK_5628AECD648BA380 FOREIGN KEY (activite_enseignement_id) REFERENCES activite_enseignement (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE activite_enseignement_intervenant ADD CONSTRAINT FK_5628AECDAB9A1716 FOREIGN KEY (intervenant_id) REFERENCES intervenant (id_intervenant) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE apprenant ADD user_id INT NOT NULL, DROP nom, DROP prenom
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE apprenant ADD CONSTRAINT FK_C4EB462EA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX UNIQ_C4EB462EA76ED395 ON apprenant (user_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE coordinateur ADD user_id INT NOT NULL, DROP nom, DROP prenom, CHANGE tel tel VARCHAR(20) NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE coordinateur ADD CONSTRAINT FK_83AD9AC4A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX UNIQ_83AD9AC4A76ED395 ON coordinateur (user_id)
        SQL);
        // <-------------------------------------------------------------------------------------
        $this->addSql(<<<'SQL'
            ALTER TABLE intervenant ADD user_id INT NOT NULL, DROP nom, DROP prenom, DROP email
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE intervenant ADD CONSTRAINT FK_73D0145CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX UNIQ_73D0145CA76ED395 ON intervenant (user_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE user ADD nom VARCHAR(255) NOT NULL, ADD prenom VARCHAR(255) NOT NULL
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
        $this->addSql(<<<'SQL'
            ALTER TABLE activite_enseignement_intervenant DROP FOREIGN KEY FK_5628AECD648BA380
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE activite_enseignement_intervenant DROP FOREIGN KEY FK_5628AECDAB9A1716
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE activite_enseignement_intervenant ADD CONSTRAINT FK_5628AECD648BA380 FOREIGN KEY (activite_enseignement_id) REFERENCES activite_enseignement (id) ON UPDATE NO ACTION ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE activite_enseignement_intervenant ADD CONSTRAINT FK_5628AECDAB9A1716 FOREIGN KEY (intervenant_id) REFERENCES intervenant (id) ON UPDATE NO ACTION ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE apprenant DROP FOREIGN KEY FK_C4EB462EA76ED395
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX UNIQ_C4EB462EA76ED395 ON apprenant
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE apprenant ADD nom VARCHAR(255) NOT NULL, ADD prenom VARCHAR(255) NOT NULL, DROP user_id, CHANGE id_apprenant id_apprenant INT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE coordinateur DROP FOREIGN KEY FK_83AD9AC4A76ED395
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX UNIQ_83AD9AC4A76ED395 ON coordinateur
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE coordinateur ADD nom VARCHAR(255) NOT NULL, ADD prenom VARCHAR(255) NOT NULL, DROP user_id, CHANGE id_coordinateur id_coordinateur INT NOT NULL, CHANGE tel tel INT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE intervenant MODIFY id_intervenant INT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE intervenant DROP FOREIGN KEY FK_73D0145CA76ED395
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX UNIQ_73D0145CA76ED395 ON intervenant
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX `PRIMARY` ON intervenant
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE intervenant ADD nom VARCHAR(255) NOT NULL, ADD prenom VARCHAR(255) NOT NULL, ADD email VARCHAR(255) NOT NULL, DROP user_id, CHANGE id_intervenant id INT AUTO_INCREMENT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE intervenant ADD PRIMARY KEY (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE user DROP nom, DROP prenom
        SQL);
    }
}
