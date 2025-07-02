<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250627220632 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE message (id INT AUTO_INCREMENT NOT NULL, sender_id INT DEFAULT NULL, receiver_id INT DEFAULT NULL, content LONGTEXT NOT NULL, created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', INDEX IDX_B6BD307FF624B39D (sender_id), INDEX IDX_B6BD307FCD53EDB6 (receiver_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE message ADD CONSTRAINT FK_B6BD307FF624B39D FOREIGN KEY (sender_id) REFERENCES user (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE message ADD CONSTRAINT FK_B6BD307FCD53EDB6 FOREIGN KEY (receiver_id) REFERENCES user (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE activite_enseignement_intervenant DROP FOREIGN KEY FK_5628AECDAB9A1716
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE activite_enseignement_intervenant DROP FOREIGN KEY FK_5628AECD648BA380
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE activite_enseignement_intervenant ADD CONSTRAINT FK_5628AECDAB9A1716 FOREIGN KEY (intervenant_id) REFERENCES intervenant (id_intervenant)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE activite_enseignement_intervenant ADD CONSTRAINT FK_5628AECD648BA380 FOREIGN KEY (activite_enseignement_id) REFERENCES activite_enseignement (id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE message DROP FOREIGN KEY FK_B6BD307FF624B39D
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE message DROP FOREIGN KEY FK_B6BD307FCD53EDB6
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE message
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
            ALTER TABLE activite_enseignement_intervenant ADD CONSTRAINT FK_5628AECDAB9A1716 FOREIGN KEY (intervenant_id) REFERENCES intervenant (id_intervenant) ON UPDATE NO ACTION ON DELETE CASCADE
        SQL);
    }
}
