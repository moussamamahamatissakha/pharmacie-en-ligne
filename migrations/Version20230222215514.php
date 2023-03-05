<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230222215514 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE medicament (id INT AUTO_INCREMENT NOT NULL, date_debut DATE NOT NULL, date_exp DATE NOT NULL, libelle VARCHAR(255) NOT NULL, prix DOUBLE PRECISION NOT NULL, etat VARCHAR(30) NOT NULL, image VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE payement (id INT AUTO_INCREMENT NOT NULL, prix DOUBLE PRECISION NOT NULL, date DATE NOT NULL, etat VARCHAR(30) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commande ADD client_id INT DEFAULT NULL, ADD medicament_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D19EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DAB0D61F7 FOREIGN KEY (medicament_id) REFERENCES medicament (id)');
        $this->addSql('CREATE INDEX IDX_6EEAA67D19EB6921 ON commande (client_id)');
        $this->addSql('CREATE INDEX IDX_6EEAA67DAB0D61F7 ON commande (medicament_id)');
        $this->addSql('ALTER TABLE livreur ADD image VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE user ADD image VARCHAR(255) DEFAULT NULL, CHANGE nom_complet nom_complet VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DAB0D61F7');
        $this->addSql('DROP TABLE medicament');
        $this->addSql('DROP TABLE payement');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D19EB6921');
        $this->addSql('DROP INDEX IDX_6EEAA67D19EB6921 ON commande');
        $this->addSql('DROP INDEX IDX_6EEAA67DAB0D61F7 ON commande');
        $this->addSql('ALTER TABLE commande DROP client_id, DROP medicament_id');
        $this->addSql('ALTER TABLE livreur DROP image');
        $this->addSql('ALTER TABLE user DROP image, CHANGE nom_complet nom_complet VARCHAR(255) DEFAULT NULL');
    }
}
