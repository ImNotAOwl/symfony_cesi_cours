<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230227084258 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE structure ADD LOGO VARCHAR(255) DEFAULT NULL');
        $this->addSql('DROP INDEX `primary` ON dirig_struct');
        $this->addSql('ALTER TABLE dirig_struct ADD PRIMARY KEY (structure_id, dirigeant_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX `PRIMARY` ON dirig_struct');
        $this->addSql('ALTER TABLE dirig_struct ADD PRIMARY KEY (dirigeant_id, structure_id)');
        $this->addSql('ALTER TABLE structure DROP LOGO');
    }
}
