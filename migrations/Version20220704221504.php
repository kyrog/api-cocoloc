<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220704221504 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE actions ADD categories_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE actions ADD CONSTRAINT FK_548F1EFA21214B7 FOREIGN KEY (categories_id) REFERENCES categories (id)');
        $this->addSql('CREATE INDEX IDX_548F1EFA21214B7 ON actions (categories_id)');
        $this->addSql('ALTER TABLE user ADD categories_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649A21214B7 FOREIGN KEY (categories_id) REFERENCES categories (id)');
        $this->addSql('CREATE INDEX IDX_8D93D649A21214B7 ON user (categories_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE actions DROP FOREIGN KEY FK_548F1EFA21214B7');
        $this->addSql('DROP INDEX IDX_548F1EFA21214B7 ON actions');
        $this->addSql('ALTER TABLE actions DROP categories_id');
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D649A21214B7');
        $this->addSql('DROP INDEX IDX_8D93D649A21214B7 ON `user`');
        $this->addSql('ALTER TABLE `user` DROP categories_id');
    }
}
