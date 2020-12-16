<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201216145411 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE ais_ship_type_port');
        //$this->addSql('DROP TABLE porttypecompatible');
        $this->addSql('ALTER TABLE aisshiptype ADD lesports VARCHAR(255) NOT NULL, CHANGE libelle libelle VARCHAR(60) NOT NULL');
        $this->addSql('ALTER TABLE escale DROP FOREIGN KEY FK_C39FEDD36A50BD94');
        $this->addSql('ALTER TABLE escale DROP FOREIGN KEY FK_C39FEDD3905EAC6C');
        $this->addSql('DROP INDEX IDX_C39FEDD3905EAC6C ON escale');
        $this->addSql('DROP INDEX IDX_C39FEDD36A50BD94 ON escale');
        $this->addSql('ALTER TABLE escale CHANGE idnavire idnavire VARCHAR(255) NOT NULL, CHANGE idport idport VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE navire DROP FOREIGN KEY FK_EED1038E750CD0E');
        $this->addSql('ALTER TABLE navire DROP FOREIGN KEY FK_EED1038EA83FAE4');
        $this->addSql('DROP INDEX IDX_EED1038E750CD0E ON navire');
        $this->addSql('DROP INDEX IDX_EED1038EA83FAE4 ON navire');
        $this->addSql('ALTER TABLE navire ADD lepavillon VARCHAR(255) NOT NULL, ADD triantdeau NUMERIC(4, 1) NOT NULL, DROP idpays, DROP tirantdeau, CHANGE letype letype VARCHAR(255) NOT NULL, CHANGE eta eta DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE port DROP FOREIGN KEY FK_43915DCC47626230');
        $this->addSql('DROP INDEX IDX_43915DCC47626230 ON port');
        $this->addSql('ALTER TABLE port CHANGE idPays idpays VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ais_ship_type_port (ais_ship_type_id INT NOT NULL, port_id INT NOT NULL, INDEX IDX_E2C18803479E0B84 (ais_ship_type_id), INDEX IDX_E2C1880376E92A9C (port_id), PRIMARY KEY(ais_ship_type_id, port_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE porttypecompatible (idaistype INT NOT NULL, idport INT NOT NULL, INDEX IDX_2C02FFDB53BA86F9 (idaistype), INDEX IDX_2C02FFDB905EAC6C (idport), PRIMARY KEY(idaistype, idport)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE ais_ship_type_port ADD CONSTRAINT FK_E2C18803479E0B84 FOREIGN KEY (ais_ship_type_id) REFERENCES aisshiptype (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ais_ship_type_port ADD CONSTRAINT FK_E2C1880376E92A9C FOREIGN KEY (port_id) REFERENCES port (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE porttypecompatible ADD CONSTRAINT FK_2C02FFDB53BA86F9 FOREIGN KEY (idaistype) REFERENCES aisshiptype (id)');
        $this->addSql('ALTER TABLE porttypecompatible ADD CONSTRAINT FK_2C02FFDB905EAC6C FOREIGN KEY (idport) REFERENCES port (id)');
        $this->addSql('ALTER TABLE aisshiptype DROP lesports, CHANGE libelle libelle VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE escale CHANGE idnavire idnavire INT NOT NULL, CHANGE idport idport INT NOT NULL');
        $this->addSql('ALTER TABLE escale ADD CONSTRAINT FK_C39FEDD36A50BD94 FOREIGN KEY (idnavire) REFERENCES navire (id)');
        $this->addSql('ALTER TABLE escale ADD CONSTRAINT FK_C39FEDD3905EAC6C FOREIGN KEY (idport) REFERENCES port (id)');
        $this->addSql('CREATE INDEX IDX_C39FEDD3905EAC6C ON escale (idport)');
        $this->addSql('CREATE INDEX IDX_C39FEDD36A50BD94 ON escale (idnavire)');
        $this->addSql('ALTER TABLE navire ADD idpays INT NOT NULL, ADD tirantdeau NUMERIC(10, 1) NOT NULL, DROP lepavillon, DROP triantdeau, CHANGE eta eta DATETIME NOT NULL, CHANGE letype letype INT NOT NULL');
        $this->addSql('ALTER TABLE navire ADD CONSTRAINT FK_EED1038E750CD0E FOREIGN KEY (idpays) REFERENCES pays (id)');
        $this->addSql('ALTER TABLE navire ADD CONSTRAINT FK_EED1038EA83FAE4 FOREIGN KEY (letype) REFERENCES aisshiptype (id)');
        $this->addSql('CREATE INDEX IDX_EED1038E750CD0E ON navire (idpays)');
        $this->addSql('CREATE INDEX IDX_EED1038EA83FAE4 ON navire (letype)');
        $this->addSql('ALTER TABLE port CHANGE idpays idPays INT NOT NULL');
        $this->addSql('ALTER TABLE port ADD CONSTRAINT FK_43915DCC47626230 FOREIGN KEY (idPays) REFERENCES pays (id)');
        $this->addSql('CREATE INDEX IDX_43915DCC47626230 ON port (idPays)');
    }
}
