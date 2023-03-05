<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230227181509 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DAB0D61F7');
        $this->addSql('DROP INDEX IDX_6EEAA67DAB0D61F7 ON commande');
        $this->addSql('ALTER TABLE commande ADD date DATE NOT NULL, DROP medicament_id');
        $this->addSql('ALTER TABLE medicament ADD commande_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE medicament ADD CONSTRAINT FK_9A9C723A82EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('CREATE INDEX IDX_9A9C723A82EA2E54 ON medicament (commande_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande ADD medicament_id INT DEFAULT NULL, DROP date');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DAB0D61F7 FOREIGN KEY (medicament_id) REFERENCES medicament (id)');
        $this->addSql('CREATE INDEX IDX_6EEAA67DAB0D61F7 ON commande (medicament_id)');
        $this->addSql('ALTER TABLE medicament DROP FOREIGN KEY FK_9A9C723A82EA2E54');
        $this->addSql('DROP INDEX IDX_9A9C723A82EA2E54 ON medicament');
        $this->addSql('ALTER TABLE medicament DROP commande_id');
    }
}
