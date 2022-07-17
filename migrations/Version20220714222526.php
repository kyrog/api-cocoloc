<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220714222526 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE actions DROP FOREIGN KEY FK_548F1EF1C3AC5D2');
        $this->addSql('DROP INDEX IDX_548F1EF1C3AC5D2 ON actions');
        $this->addSql('ALTER TABLE actions DROP id_categories_id, CHANGE categories_id categories_id INT NOT NULL');
        $this->addSql('ALTER TABLE user ADD roommate_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649957252FA FOREIGN KEY (roommate_id) REFERENCES roommate (id)');
        $this->addSql('CREATE INDEX IDX_8D93D649957252FA ON user (roommate_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE actions ADD id_categories_id INT NOT NULL, CHANGE categories_id categories_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE actions ADD CONSTRAINT FK_548F1EF1C3AC5D2 FOREIGN KEY (id_categories_id) REFERENCES categories (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_548F1EF1C3AC5D2 ON actions (id_categories_id)');
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D649957252FA');
        $this->addSql('DROP INDEX IDX_8D93D649957252FA ON `user`');
        $this->addSql('ALTER TABLE `user` DROP roommate_id');
    }
}
