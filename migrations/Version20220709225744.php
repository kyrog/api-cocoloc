<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220709225744 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE actions (id INT AUTO_INCREMENT NOT NULL, id_categories_id INT NOT NULL, user_id INT DEFAULT NULL, categories_id INT DEFAULT NULL, is_incoming TINYINT(1) NOT NULL, title VARCHAR(50) NOT NULL, amount INT NOT NULL, INDEX IDX_548F1EF1C3AC5D2 (id_categories_id), INDEX IDX_548F1EFA76ED395 (user_id), INDEX IDX_548F1EFA21214B7 (categories_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categories (id INT AUTO_INCREMENT NOT NULL, roommate_id INT DEFAULT NULL, title VARCHAR(50) NOT NULL, budget INT DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, color VARCHAR(255) DEFAULT NULL, type VARCHAR(255) DEFAULT NULL, INDEX IDX_3AF34668957252FA (roommate_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE roommate (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tasks (id INT AUTO_INCREMENT NOT NULL, id_user_id INT DEFAULT NULL, title VARCHAR(50) NOT NULL, description LONGTEXT NOT NULL, comment LONGTEXT NOT NULL, start_date DATETIME NOT NULL, end_date DATETIME NOT NULL, time TIME NOT NULL, is_finished TINYINT(1) NOT NULL, INDEX IDX_5058659779F37AE5 (id_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, categories_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, phone_number VARCHAR(20) DEFAULT NULL, profile_picture VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), INDEX IDX_8D93D649A21214B7 (categories_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE actions ADD CONSTRAINT FK_548F1EF1C3AC5D2 FOREIGN KEY (id_categories_id) REFERENCES categories (id)');
        $this->addSql('ALTER TABLE actions ADD CONSTRAINT FK_548F1EFA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE actions ADD CONSTRAINT FK_548F1EFA21214B7 FOREIGN KEY (categories_id) REFERENCES categories (id)');
        $this->addSql('ALTER TABLE categories ADD CONSTRAINT FK_3AF34668957252FA FOREIGN KEY (roommate_id) REFERENCES roommate (id)');
        $this->addSql('ALTER TABLE tasks ADD CONSTRAINT FK_5058659779F37AE5 FOREIGN KEY (id_user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE `user` ADD CONSTRAINT FK_8D93D649A21214B7 FOREIGN KEY (categories_id) REFERENCES categories (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE actions DROP FOREIGN KEY FK_548F1EF1C3AC5D2');
        $this->addSql('ALTER TABLE actions DROP FOREIGN KEY FK_548F1EFA21214B7');
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D649A21214B7');
        $this->addSql('ALTER TABLE categories DROP FOREIGN KEY FK_3AF34668957252FA');
        $this->addSql('ALTER TABLE actions DROP FOREIGN KEY FK_548F1EFA76ED395');
        $this->addSql('ALTER TABLE tasks DROP FOREIGN KEY FK_5058659779F37AE5');
        $this->addSql('DROP TABLE actions');
        $this->addSql('DROP TABLE categories');
        $this->addSql('DROP TABLE roommate');
        $this->addSql('DROP TABLE tasks');
        $this->addSql('DROP TABLE `user`');
    }
}
