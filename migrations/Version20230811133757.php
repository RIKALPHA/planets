<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230811133757 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE planet_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE planet (
            id INT NOT NULL,
            name VARCHAR(100) DEFAULT NULL,
            image VARCHAR(255) DEFAULT NULL,
            description VARCHAR(255) DEFAULT NULL,
            status INT NOT NULL DEFAULT 0,
            robots_exploring INT NOT NULL DEFAULT 0,
            PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX status_idx ON planet (status)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE planet_id_seq CASCADE');
        $this->addSql('DROP INDEX status_idx IF EXISTS');
        $this->addSql('DROP TABLE planet');
    }
}
