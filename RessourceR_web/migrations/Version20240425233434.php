<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240425233434 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE categories CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('DROP INDEX categories_id ON categories_ressources');
        $this->addSql('DROP INDEX categories_id_2 ON categories_ressources');
        $this->addSql('ALTER TABLE ressources CHANGE image_size image_size INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ressources CHANGE image_size image_size BLOB DEFAULT NULL');
        $this->addSql('CREATE INDEX categories_id ON categories_ressources (categories_id, ressources_id)');
        $this->addSql('CREATE INDEX categories_id_2 ON categories_ressources (categories_id, ressources_id)');
        $this->addSql('ALTER TABLE categories CHANGE id id INT NOT NULL');
    }
}
