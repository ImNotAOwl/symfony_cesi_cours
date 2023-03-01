<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230126141546 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE dirigeant (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, ddn DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dirig_struct (dirigeant_id INT NOT NULL, structure_id INT NOT NULL, INDEX IDX_7D871D8EE233AF25 (dirigeant_id), INDEX IDX_7D871D8E2534008B (structure_id), PRIMARY KEY(dirigeant_id, structure_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE secteur (ID INT AUTO_INCREMENT NOT NULL, LIBELLE VARCHAR(100) NOT NULL, UNIQUE INDEX secteur_uq (LIBELLE), PRIMARY KEY(ID)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE secteurs_structures (ID INT AUTO_INCREMENT NOT NULL, ID_STRUCTURE INT DEFAULT NULL, ID_SECTEUR INT DEFAULT NULL, INDEX secteurs_structures_secteur_fk (ID_SECTEUR), INDEX IDX_ECF28C16355BC10D (ID_STRUCTURE), UNIQUE INDEX secteurs_structures_uq (ID_STRUCTURE, ID_SECTEUR), PRIMARY KEY(ID)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE structure (id INT AUTO_INCREMENT NOT NULL, NOM VARCHAR(100) NOT NULL, RUE VARCHAR(200) NOT NULL, CP CHAR(5) NOT NULL, VILLE VARCHAR(100) NOT NULL, ESTASSO TINYINT(1) NOT NULL, NB_DONATEURS INT DEFAULT NULL, NB_ACTIONNAIRES INT DEFAULT NULL, UNIQUE INDEX structure_lieu_uq (RUE, CP, VILLE), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE dirig_struct ADD CONSTRAINT FK_7D871D8EE233AF25 FOREIGN KEY (dirigeant_id) REFERENCES dirigeant (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE dirig_struct ADD CONSTRAINT FK_7D871D8E2534008B FOREIGN KEY (structure_id) REFERENCES structure (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE secteurs_structures ADD CONSTRAINT FK_ECF28C16355BC10D FOREIGN KEY (ID_STRUCTURE) REFERENCES structure (id)');
        $this->addSql('ALTER TABLE secteurs_structures ADD CONSTRAINT FK_ECF28C16AC31F306 FOREIGN KEY (ID_SECTEUR) REFERENCES secteur (ID)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE dirig_struct DROP FOREIGN KEY FK_7D871D8EE233AF25');
        $this->addSql('ALTER TABLE dirig_struct DROP FOREIGN KEY FK_7D871D8E2534008B');
        $this->addSql('ALTER TABLE secteurs_structures DROP FOREIGN KEY FK_ECF28C16355BC10D');
        $this->addSql('ALTER TABLE secteurs_structures DROP FOREIGN KEY FK_ECF28C16AC31F306');
        $this->addSql('DROP TABLE dirigeant');
        $this->addSql('DROP TABLE dirig_struct');
        $this->addSql('DROP TABLE secteur');
        $this->addSql('DROP TABLE secteurs_structures');
        $this->addSql('DROP TABLE structure');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
