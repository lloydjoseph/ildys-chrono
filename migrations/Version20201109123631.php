<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201109123631 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE permission CHANGE courrier_add courrier_add TINYINT(1) DEFAULT \'0\', CHANGE courrier_mod courrier_mod TINYINT(1) DEFAULT \'0\', CHANGE courrier_del courrier_del TINYINT(1) DEFAULT \'0\', CHANGE information_add information_add TINYINT(1) DEFAULT \'0\', CHANGE information_mod information_mod TINYINT(1) DEFAULT \'0\', CHANGE information_del information_del TINYINT(1) DEFAULT \'0\', CHANGE service_add service_add TINYINT(1) DEFAULT \'0\', CHANGE service_mod service_mod TINYINT(1) DEFAULT \'0\', CHANGE service_del service_del TINYINT(1) DEFAULT \'0\'');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE permission CHANGE courrier_add courrier_add SMALLINT DEFAULT NULL, CHANGE courrier_mod courrier_mod SMALLINT DEFAULT NULL, CHANGE courrier_del courrier_del SMALLINT DEFAULT NULL, CHANGE information_add information_add SMALLINT DEFAULT NULL, CHANGE information_mod information_mod SMALLINT DEFAULT NULL, CHANGE information_del information_del SMALLINT DEFAULT NULL, CHANGE service_add service_add SMALLINT DEFAULT NULL, CHANGE service_mod service_mod SMALLINT DEFAULT NULL, CHANGE service_del service_del SMALLINT DEFAULT NULL');
    }
}
