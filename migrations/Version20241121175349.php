<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241121175349 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__news AS SELECT id, author, title, description, content, insert_date, picture_path FROM news');
        $this->addSql('DROP TABLE news');
        $this->addSql('CREATE TABLE news (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, author VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, content CLOB NOT NULL, insert_date DATE NOT NULL --(DC2Type:date_immutable)
        , picture_path VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO news (id, author, title, description, content, insert_date, picture_path) SELECT id, author, title, description, content, insert_date, picture_path FROM __temp__news');
        $this->addSql('DROP TABLE __temp__news');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__news AS SELECT id, author, title, description, content, insert_date, picture_path FROM news');
        $this->addSql('DROP TABLE news');
        $this->addSql('CREATE TABLE news (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, author VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, content CLOB NOT NULL, insert_date DATE NOT NULL, picture_path VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO news (id, author, title, description, content, insert_date, picture_path) SELECT id, author, title, description, content, insert_date, picture_path FROM __temp__news');
        $this->addSql('DROP TABLE __temp__news');
    }
}
