<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210505140225 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE courrier (i_id_courrier INT AUTO_INCREMENT NOT NULL, i_numero INT DEFAULT NULL, d_date_creation DATETIME DEFAULT NULL, i_id_user INT DEFAULT NULL, v_libelle VARCHAR(255) DEFAULT NULL, v_destinataire VARCHAR(255) DEFAULT NULL, PRIMARY KEY(i_id_courrier)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE log_action (i_id_log INT AUTO_INCREMENT NOT NULL, i_id_user INT DEFAULT NULL, d_date_transaction DATETIME DEFAULT NULL, v_action VARCHAR(255) DEFAULT NULL, i_type_ref INT DEFAULT NULL, i_id_ref INT DEFAULT NULL, PRIMARY KEY(i_id_log)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE note_information (i_id_note INT AUTO_INCREMENT NOT NULL, i_numero INT DEFAULT NULL, d_date_creation DATETIME DEFAULT NULL, i_id_user INT DEFAULT NULL, v_libelle VARCHAR(255) DEFAULT NULL, v_service VARCHAR(255) DEFAULT NULL, PRIMARY KEY(i_id_note)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE note_service (i_id_note INT AUTO_INCREMENT NOT NULL, i_numero INT DEFAULT NULL, d_date_creation DATETIME DEFAULT NULL, i_id_user INT DEFAULT NULL, v_libelle VARCHAR(255) DEFAULT NULL, v_service VARCHAR(255) DEFAULT NULL, PRIMARY KEY(i_id_note)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE permission (i_id_perm INT AUTO_INCREMENT NOT NULL, i_id_user INT NOT NULL, b_ajout_courrier TINYINT(1) DEFAULT \'0\', b_modif_courrier TINYINT(1) DEFAULT \'0\', b_suppr_courrier TINYINT(1) DEFAULT \'0\', b_ajout_note_info TINYINT(1) DEFAULT \'0\', b_modif_note_info TINYINT(1) DEFAULT \'0\', b_suppr_note_info TINYINT(1) DEFAULT \'0\', b_ajout_note_serv TINYINT(1) DEFAULT \'0\', b_modif_note_serv TINYINT(1) DEFAULT \'0\', b_suppr_note_serv TINYINT(1) DEFAULT \'0\', PRIMARY KEY(i_id_perm)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur (i_id_user INT AUTO_INCREMENT NOT NULL, v_identifiant VARCHAR(255) DEFAULT NULL, v_prenom_user VARCHAR(255) DEFAULT NULL, v_nom_user VARCHAR(255) DEFAULT NULL, b_admin TINYINT(1) DEFAULT NULL, b_actif TINYINT(1) DEFAULT NULL, PRIMARY KEY(i_id_user)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE courrier');
        $this->addSql('DROP TABLE log_action');
        $this->addSql('DROP TABLE note_information');
        $this->addSql('DROP TABLE note_service');
        $this->addSql('DROP TABLE permission');
        $this->addSql('DROP TABLE utilisateur');
    }
}
