<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240215142936 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE commentaires (id INT AUTO_INCREMENT NOT NULL, com_ressources_id INT NOT NULL, com_content LONGTEXT NOT NULL, com_date_publication DATETIME NOT NULL, com_statut_validation TINYINT(1) NOT NULL, INDEX IDX_D9BEC0C4A2D601AA (com_ressources_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ressources (id INT AUTO_INCREMENT NOT NULL, res_titre VARCHAR(255) NOT NULL, res_content LONGTEXT NOT NULL, res_date_creation DATETIME NOT NULL, res_est_exploitee TINYINT(1) DEFAULT NULL, res_est_restrictif TINYINT(1) DEFAULT NULL, res_type VARCHAR(255) DEFAULT NULL, res_path VARCHAR(255) DEFAULT NULL, res_etiquette VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commentaires ADD CONSTRAINT FK_D9BEC0C4A2D601AA FOREIGN KEY (com_ressources_id) REFERENCES ressources (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentaires DROP FOREIGN KEY FK_D9BEC0C4A2D601AA');
        $this->addSql('DROP TABLE commentaires');
        $this->addSql('DROP TABLE ressources');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
