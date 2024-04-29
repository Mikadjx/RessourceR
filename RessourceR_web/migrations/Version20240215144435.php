<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240215144435 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categories (id INT AUTO_INCREMENT NOT NULL, cat_etiquette VARCHAR(255) NOT NULL, cat_date_creation DATETIME NOT NULL, car_date_maj DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categories_ressources (categories_id INT NOT NULL, ressources_id INT NOT NULL, INDEX IDX_CBA295CFA21214B7 (categories_id), INDEX IDX_CBA295CF3C361826 (ressources_id), PRIMARY KEY(categories_id, ressources_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE categories_ressources ADD CONSTRAINT FK_CBA295CFA21214B7 FOREIGN KEY (categories_id) REFERENCES categories (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE categories_ressources ADD CONSTRAINT FK_CBA295CF3C361826 FOREIGN KEY (ressources_id) REFERENCES ressources (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE categories_ressources DROP FOREIGN KEY FK_CBA295CFA21214B7');
        $this->addSql('ALTER TABLE categories_ressources DROP FOREIGN KEY FK_CBA295CF3C361826');
        $this->addSql('DROP TABLE categories');
        $this->addSql('DROP TABLE categories_ressources');
    }
}
