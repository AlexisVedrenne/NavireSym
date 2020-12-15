<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201215111141 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE aisshiptype DROP FOREIGN KEY FK_FF348A27BC0739A9');
        $this->addSql('DROP INDEX IDX_FF348A27BC0739A9 ON aisshiptype');
        $this->addSql('ALTER TABLE aisshiptype ADD lesPortsId VARCHAR(255) NOT NULL, DROP les_ports_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE aisshiptype ADD les_ports_id INT NOT NULL, DROP lesPortsId');
        $this->addSql('ALTER TABLE aisshiptype ADD CONSTRAINT FK_FF348A27BC0739A9 FOREIGN KEY (les_ports_id) REFERENCES port (id)');
        $this->addSql('CREATE INDEX IDX_FF348A27BC0739A9 ON aisshiptype (les_ports_id)');
    }
}
