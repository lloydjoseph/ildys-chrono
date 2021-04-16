<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210414143324 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE permission ADD i_id_perm INT AUTO_INCREMENT NOT NULL, ADD i_id_user INT NOT NULL, ADD b_ajout_courrier TINYINT(1) DEFAULT \'0\', ADD b_modif_courrier TINYINT(1) DEFAULT \'0\', ADD b_suppr_courrier TINYINT(1) DEFAULT \'0\', ADD b_ajout_note_info TINYINT(1) DEFAULT \'0\', ADD b_modif_note_info TINYINT(1) DEFAULT \'0\', ADD b_suppr_note_info TINYINT(1) DEFAULT \'0\', ADD b_ajout_note_serv TINYINT(1) DEFAULT \'0\', ADD b_modif_note_serv TINYINT(1) DEFAULT \'0\', ADD b_suppr_note_serv TINYINT(1) DEFAULT \'0\', DROP id, DROP id_user, DROP courrier_add, DROP courrier_mod, DROP courrier_del, DROP information_add, DROP information_mod, DROP information_del, DROP service_add, DROP service_mod, DROP service_del, ADD PRIMARY KEY (i_id_perm)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE permission MODIFY i_id_perm INT NOT NULL');
        $this->addSql('ALTER TABLE permission DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE permission ADD id_user INT NOT NULL, ADD courrier_add TINYINT(1) DEFAULT \'0\', ADD courrier_mod TINYINT(1) DEFAULT \'0\', ADD courrier_del TINYINT(1) DEFAULT \'0\', ADD information_add TINYINT(1) DEFAULT \'0\', ADD information_mod TINYINT(1) DEFAULT \'0\', ADD information_del TINYINT(1) DEFAULT \'0\', ADD service_add TINYINT(1) DEFAULT \'0\', ADD service_mod TINYINT(1) DEFAULT \'0\', ADD service_del TINYINT(1) DEFAULT \'0\', DROP i_id_perm, DROP b_ajout_courrier, DROP b_modif_courrier, DROP b_suppr_courrier, DROP b_ajout_note_info, DROP b_modif_note_info, DROP b_suppr_note_info, DROP b_ajout_note_serv, DROP b_modif_note_serv, DROP b_suppr_note_serv, CHANGE i_id_user id INT NOT NULL');
    }
}
