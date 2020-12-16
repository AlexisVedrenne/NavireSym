<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201216155647 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE aisshiptype DROP lesports');
        $this->addSql('ALTER TABLE porttypecompatible DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE porttypecompatible ADD PRIMARY KEY (idport, idaistype)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE aisshiptype ADD lesports VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE porttypecompatible DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE porttypecompatible ADD PRIMARY KEY (idaistype, idport)');
    }
}
