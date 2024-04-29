<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240215152930 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE favoris (id INT AUTO_INCREMENT NOT NULL, ressources_id INT NOT NULL, utilisateurs_id INT NOT NULL, fav_date_creation DATETIME NOT NULL, fav_titre VARCHAR(255) NOT NULL, INDEX IDX_8933C4323C361826 (ressources_id), INDEX IDX_8933C4321E969C5 (utilisateurs_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE roles (id INT AUTO_INCREMENT NOT NULL, nom_role VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateurs (id INT AUTO_INCREMENT NOT NULL, role_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, usr_prenom VARCHAR(50) DEFAULT NULL, usr_nom VARCHAR(50) DEFAULT NULL, usr_date_creation DATETIME NOT NULL, usr_derniere_connexion DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_497B315EE7927C74 (email), INDEX IDX_497B315ED60322AC (role_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE favoris ADD CONSTRAINT FK_8933C4323C361826 FOREIGN KEY (ressources_id) REFERENCES ressources (id)');
        $this->addSql('ALTER TABLE favoris ADD CONSTRAINT FK_8933C4321E969C5 FOREIGN KEY (utilisateurs_id) REFERENCES utilisateurs (id)');
        $this->addSql('ALTER TABLE utilisateurs ADD CONSTRAINT FK_497B315ED60322AC FOREIGN KEY (role_id) REFERENCES roles (id)');
        $this->addSql('ALTER TABLE commentaires ADD utilisateurs_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commentaires ADD CONSTRAINT FK_D9BEC0C41E969C5 FOREIGN KEY (utilisateurs_id) REFERENCES utilisateurs (id)');
        $this->addSql('CREATE INDEX IDX_D9BEC0C41E969C5 ON commentaires (utilisateurs_id)');
        $this->addSql('ALTER TABLE ressources ADD utilisateurs_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ressources ADD CONSTRAINT FK_6A2CD5C71E969C5 FOREIGN KEY (utilisateurs_id) REFERENCES utilisateurs (id)');
        $this->addSql('CREATE INDEX IDX_6A2CD5C71E969C5 ON ressources (utilisateurs_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentaires DROP FOREIGN KEY FK_D9BEC0C41E969C5');
        $this->addSql('ALTER TABLE ressources DROP FOREIGN KEY FK_6A2CD5C71E969C5');
        $this->addSql('ALTER TABLE favoris DROP FOREIGN KEY FK_8933C4323C361826');
        $this->addSql('ALTER TABLE favoris DROP FOREIGN KEY FK_8933C4321E969C5');
        $this->addSql('ALTER TABLE utilisateurs DROP FOREIGN KEY FK_497B315ED60322AC');
        $this->addSql('DROP TABLE favoris');
        $this->addSql('DROP TABLE roles');
        $this->addSql('DROP TABLE utilisateurs');
        $this->addSql('DROP INDEX IDX_D9BEC0C41E969C5 ON commentaires');
        $this->addSql('ALTER TABLE commentaires DROP utilisateurs_id');
        $this->addSql('DROP INDEX IDX_6A2CD5C71E969C5 ON ressources');
        $this->addSql('ALTER TABLE ressources DROP utilisateurs_id');
    }
}
