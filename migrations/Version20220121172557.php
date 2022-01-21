<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220121172557 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE sub_liens (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, sub_link_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL, path VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4CE4DE05D27C5E85 ON sub_liens (sub_link_id)');
        $this->addSql('DROP INDEX IDX_23A0E6612469DE2');
        $this->addSql('CREATE TEMPORARY TABLE __temp__article AS SELECT id, category_id, title, content FROM article');
        $this->addSql('DROP TABLE article');
        $this->addSql('CREATE TABLE article (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, category_id INTEGER NOT NULL, title VARCHAR(255) NOT NULL COLLATE BINARY, content CLOB NOT NULL COLLATE BINARY, CONSTRAINT FK_23A0E6612469DE2 FOREIGN KEY (category_id) REFERENCES category (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO article (id, category_id, title, content) SELECT id, category_id, title, content FROM __temp__article');
        $this->addSql('DROP TABLE __temp__article');
        $this->addSql('CREATE INDEX IDX_23A0E6612469DE2 ON article (category_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__liens AS SELECT id, name, path, sub_link FROM liens');
        $this->addSql('DROP TABLE liens');
        $this->addSql('CREATE TABLE liens (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL COLLATE BINARY, path VARCHAR(255) NOT NULL COLLATE BINARY, sub_link BOOLEAN NOT NULL)');
        $this->addSql('INSERT INTO liens (id, name, path, sub_link) SELECT id, name, path, sub_link FROM __temp__liens');
        $this->addSql('DROP TABLE __temp__liens');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE sub_liens');
        $this->addSql('DROP INDEX IDX_23A0E6612469DE2');
        $this->addSql('CREATE TEMPORARY TABLE __temp__article AS SELECT id, category_id, title, content FROM article');
        $this->addSql('DROP TABLE article');
        $this->addSql('CREATE TABLE article (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, category_id INTEGER NOT NULL, title VARCHAR(255) NOT NULL, content CLOB NOT NULL)');
        $this->addSql('INSERT INTO article (id, category_id, title, content) SELECT id, category_id, title, content FROM __temp__article');
        $this->addSql('DROP TABLE __temp__article');
        $this->addSql('CREATE INDEX IDX_23A0E6612469DE2 ON article (category_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__liens AS SELECT id, name, path, sub_link FROM liens');
        $this->addSql('DROP TABLE liens');
        $this->addSql('CREATE TABLE liens (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, path VARCHAR(255) NOT NULL, sub_link BOOLEAN DEFAULT NULL, sub_liens BOOLEAN DEFAULT NULL)');
        $this->addSql('INSERT INTO liens (id, name, path, sub_link) SELECT id, name, path, sub_link FROM __temp__liens');
        $this->addSql('DROP TABLE __temp__liens');
    }
}
