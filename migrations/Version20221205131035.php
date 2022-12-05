<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221205131035 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE episode DROP FOREIGN KEY FK_DDAA1CDAB748AAC3');
        $this->addSql('DROP INDEX IDX_DDAA1CDAB748AAC3 ON episode');
        $this->addSql('ALTER TABLE episode DROP serie_id_id, CHANGE numero numero INT DEFAULT NULL, CHANGE note note INT DEFAULT NULL');
        $this->addSql('ALTER TABLE serie CHANGE saison saison INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE episode ADD serie_id_id INT DEFAULT NULL, CHANGE numero numero INT NOT NULL, CHANGE note note INT NOT NULL');
        $this->addSql('ALTER TABLE episode ADD CONSTRAINT FK_DDAA1CDAB748AAC3 FOREIGN KEY (serie_id_id) REFERENCES serie (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_DDAA1CDAB748AAC3 ON episode (serie_id_id)');
        $this->addSql('ALTER TABLE serie CHANGE saison saison VARCHAR(255) NOT NULL');
    }
}
