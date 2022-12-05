<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221205134708 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE serie ADD platefrome_id INT DEFAULT NULL, DROP platefrome, DROP saison');
        $this->addSql('ALTER TABLE serie ADD CONSTRAINT FK_AA3A9334805FCE20 FOREIGN KEY (platefrome_id) REFERENCES platefrome (id)');
        $this->addSql('CREATE INDEX IDX_AA3A9334805FCE20 ON serie (platefrome_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE serie DROP FOREIGN KEY FK_AA3A9334805FCE20');
        $this->addSql('DROP INDEX IDX_AA3A9334805FCE20 ON serie');
        $this->addSql('ALTER TABLE serie ADD saison INT DEFAULT NULL, CHANGE platefrome_id platefrome INT DEFAULT NULL');
    }
}
