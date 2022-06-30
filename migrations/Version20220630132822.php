<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220630132822 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE matching (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE project ADD matching_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE project ADD CONSTRAINT FK_2FB3D0EEB39876B8 FOREIGN KEY (matching_id) REFERENCES matching (id)');
        $this->addSql('CREATE INDEX IDX_2FB3D0EEB39876B8 ON project (matching_id)');
        $this->addSql('ALTER TABLE user ADD matching_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649B39876B8 FOREIGN KEY (matching_id) REFERENCES matching (id)');
        $this->addSql('CREATE INDEX IDX_8D93D649B39876B8 ON user (matching_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE project DROP FOREIGN KEY FK_2FB3D0EEB39876B8');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649B39876B8');
        $this->addSql('DROP TABLE matching');
        $this->addSql('DROP INDEX IDX_2FB3D0EEB39876B8 ON project');
        $this->addSql('ALTER TABLE project DROP matching_id');
        $this->addSql('DROP INDEX IDX_8D93D649B39876B8 ON user');
        $this->addSql('ALTER TABLE user DROP matching_id');
    }
}
