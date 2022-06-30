<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220630191311 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE matching (id INT AUTO_INCREMENT NOT NULL, apsidian_id INT NOT NULL, master_chief_id INT DEFAULT NULL, project_id INT NOT NULL, apsidian_like TINYINT(1) NOT NULL, INDEX IDX_DC10F289BCB7CD87 (apsidian_id), INDEX IDX_DC10F28939CEA666 (master_chief_id), INDEX IDX_DC10F289166D1F9C (project_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE matching ADD CONSTRAINT FK_DC10F289BCB7CD87 FOREIGN KEY (apsidian_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE matching ADD CONSTRAINT FK_DC10F28939CEA666 FOREIGN KEY (master_chief_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE matching ADD CONSTRAINT FK_DC10F289166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE matching');
    }
}
