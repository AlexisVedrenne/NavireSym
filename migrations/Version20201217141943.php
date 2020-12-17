<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201217141943 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE porttypecompatible (idport INT NOT NULL, idaistype INT NOT NULL, INDEX IDX_2C02FFDB905EAC6C (idport), INDEX IDX_2C02FFDB53BA86F9 (idaistype), PRIMARY KEY(idport, idaistype)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE porttypecompatible ADD CONSTRAINT FK_2C02FFDB905EAC6C FOREIGN KEY (idport) REFERENCES port (id)');
        $this->addSql('ALTER TABLE porttypecompatible ADD CONSTRAINT FK_2C02FFDB53BA86F9 FOREIGN KEY (idaistype) REFERENCES aisshiptype (id)');
        $this->addSql('ALTER TABLE aisshiptype DROP lesports, CHANGE ais_ship_type aisshiptype INT NOT NULL');
        $this->addSql('ALTER TABLE navire ADD letype VARCHAR(255) NOT NULL, ADD lepavillon VARCHAR(255) NOT NULL, ADD triantdeau NUMERIC(4, 1) NOT NULL, DROP le_type_id, DROP idpays, DROP tirantdeau, CHANGE eta eta DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE port RENAME INDEX idx_43915dcc47626230 TO IDX_43915DCCE750CD0E');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE porttypecompatible');
        $this->addSql('ALTER TABLE aisshiptype ADD lesports VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE aisshiptype ais_ship_type INT NOT NULL');
        $this->addSql('ALTER TABLE navire ADD le_type_id INT NOT NULL, ADD idpays INT NOT NULL, ADD tirantdeau NUMERIC(10, 1) NOT NULL, DROP letype, DROP lepavillon, DROP triantdeau, CHANGE eta eta DATETIME NOT NULL');
        $this->addSql('ALTER TABLE port RENAME INDEX idx_43915dcce750cd0e TO IDX_43915DCC47626230');
    }
}
