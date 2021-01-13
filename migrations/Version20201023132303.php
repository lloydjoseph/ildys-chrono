<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201023132303 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE courrier (id INT AUTO_INCREMENT NOT NULL, number INT DEFAULT NULL, creation_date DATETIME DEFAULT NULL, user INT DEFAULT NULL, subject VARCHAR(255) DEFAULT NULL, recipient VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE log (id INT AUTO_INCREMENT NOT NULL, user INT DEFAULT NULL, modification_date DATETIME DEFAULT NULL, entry_nb INT DEFAULT NULL, entry_type VARCHAR(255) DEFAULT NULL, modification_type VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE note_information (id INT AUTO_INCREMENT NOT NULL, number INT DEFAULT NULL, creation_date DATETIME DEFAULT NULL, user INT DEFAULT NULL, subject VARCHAR(255) DEFAULT NULL, service VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE note_service (id INT AUTO_INCREMENT NOT NULL, number INT DEFAULT NULL, creation_date DATETIME DEFAULT NULL, user INT DEFAULT NULL, service VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, service VARCHAR(255) DEFAULT NULL, code INT DEFAULT NULL, password VARCHAR(255) DEFAULT NULL, firstname VARCHAR(255) DEFAULT NULL, lastname VARCHAR(255) DEFAULT NULL, modification_date DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE courrier');
        $this->addSql('DROP TABLE log');
        $this->addSql('DROP TABLE note_information');
        $this->addSql('DROP TABLE note_service');
        $this->addSql('DROP TABLE user');
    }
}
