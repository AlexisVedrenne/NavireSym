<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201217145819 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        //$this->addSql('DROP TABLE navire_ais_ship_type');
        //$this->addSql('ALTER TABLE navire ADD letype VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE navire_ais_ship_type (navire_id INT NOT NULL, ais_ship_type_id INT NOT NULL, INDEX IDX_8954FF47D840FD82 (navire_id), INDEX IDX_8954FF47479E0B84 (ais_ship_type_id), PRIMARY KEY(navire_id, ais_ship_type_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE navire_ais_ship_type ADD CONSTRAINT FK_8954FF47479E0B84 FOREIGN KEY (ais_ship_type_id) REFERENCES aisshiptype (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE navire_ais_ship_type ADD CONSTRAINT FK_8954FF47D840FD82 FOREIGN KEY (navire_id) REFERENCES navire (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE navire DROP letype');
    }
}
