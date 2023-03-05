<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230226002813 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE comprime (id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE poudre (id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sirop (id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE comprime ADD CONSTRAINT FK_60BBA0F3BF396750 FOREIGN KEY (id) REFERENCES medicament (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE poudre ADD CONSTRAINT FK_926CF10FBF396750 FOREIGN KEY (id) REFERENCES medicament (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sirop ADD CONSTRAINT FK_DB6B6FE1BF396750 FOREIGN KEY (id) REFERENCES medicament (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE medicament ADD type VARCHAR(255) NOT NULL, ADD disc VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comprime DROP FOREIGN KEY FK_60BBA0F3BF396750');
        $this->addSql('ALTER TABLE poudre DROP FOREIGN KEY FK_926CF10FBF396750');
        $this->addSql('ALTER TABLE sirop DROP FOREIGN KEY FK_DB6B6FE1BF396750');
        $this->addSql('DROP TABLE comprime');
        $this->addSql('DROP TABLE poudre');
        $this->addSql('DROP TABLE sirop');
        $this->addSql('ALTER TABLE medicament DROP type, DROP disc');
    }
}
