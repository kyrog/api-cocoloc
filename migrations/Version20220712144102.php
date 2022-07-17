<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220712144102 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE poll_answer (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, poll_id INT DEFAULT NULL, answer TINYINT(1) DEFAULT NULL, INDEX IDX_36D8097EA76ED395 (user_id), INDEX IDX_36D8097E3C947C0F (poll_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE polls (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(100) NOT NULL, description LONGTEXT DEFAULT NULL, number_diners INT DEFAULT NULL, budget INT DEFAULT NULL, date DATE NOT NULL, featured_image VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE poll_answer ADD CONSTRAINT FK_36D8097EA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE poll_answer ADD CONSTRAINT FK_36D8097E3C947C0F FOREIGN KEY (poll_id) REFERENCES polls (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE poll_answer DROP FOREIGN KEY FK_36D8097E3C947C0F');
        $this->addSql('DROP TABLE poll_answer');
        $this->addSql('DROP TABLE polls');
    }
}
