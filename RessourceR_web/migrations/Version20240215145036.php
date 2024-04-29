<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240215145036 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE tags (id INT AUTO_INCREMENT NOT NULL, tag VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tags_ressources (tags_id INT NOT NULL, ressources_id INT NOT NULL, INDEX IDX_895C9268D7B4FB4 (tags_id), INDEX IDX_895C9263C361826 (ressources_id), PRIMARY KEY(tags_id, ressources_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tags_ressources ADD CONSTRAINT FK_895C9268D7B4FB4 FOREIGN KEY (tags_id) REFERENCES tags (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tags_ressources ADD CONSTRAINT FK_895C9263C361826 FOREIGN KEY (ressources_id) REFERENCES ressources (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tags_ressources DROP FOREIGN KEY FK_895C9268D7B4FB4');
        $this->addSql('ALTER TABLE tags_ressources DROP FOREIGN KEY FK_895C9263C361826');
        $this->addSql('DROP TABLE tags');
        $this->addSql('DROP TABLE tags_ressources');
    }
}
