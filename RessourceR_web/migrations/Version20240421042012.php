<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240421042012 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {

            // Supprimer toutes les données de la table
    $this->addSql('DELETE FROM ressources;');
    
    // Réinitialiser les valeurs des identifiants (ID)
    $this->addSql('ALTER TABLE resssources AUTO_INCREMENT = 1;');
    }

}
