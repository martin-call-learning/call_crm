<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230809105919 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE funder_funding_type (funder_id INTEGER NOT NULL, funding_type_id INTEGER NOT NULL, PRIMARY KEY(funder_id, funding_type_id), CONSTRAINT FK_1A871D646CC88588 FOREIGN KEY (funder_id) REFERENCES funder (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_1A871D64E090CD3 FOREIGN KEY (funding_type_id) REFERENCES funding_type (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_1A871D646CC88588 ON funder_funding_type (funder_id)');
        $this->addSql('CREATE INDEX IDX_1A871D64E090CD3 ON funder_funding_type (funding_type_id)');
        $this->addSql('CREATE TABLE funding_type (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__funder AS SELECT id, orgid_id, name FROM funder');
        $this->addSql('DROP TABLE funder');
        $this->addSql('CREATE TABLE funder (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, organisation_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL, CONSTRAINT FK_6CFB4E659E6B1585 FOREIGN KEY (organisation_id) REFERENCES organisation (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO funder (id, organisation_id, name) SELECT id, orgid_id, name FROM __temp__funder');
        $this->addSql('DROP TABLE __temp__funder');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6CFB4E659E6B1585 ON funder (organisation_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE funder_funding_type');
        $this->addSql('DROP TABLE funding_type');
        $this->addSql('CREATE TEMPORARY TABLE __temp__funder AS SELECT id, organisation_id, name FROM funder');
        $this->addSql('DROP TABLE funder');
        $this->addSql('CREATE TABLE funder (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, orgid_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL, fundingtype INTEGER DEFAULT NULL, CONSTRAINT FK_6CFB4E65BB89FAD4 FOREIGN KEY (orgid_id) REFERENCES organisation (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO funder (id, orgid_id, name) SELECT id, organisation_id, name FROM __temp__funder');
        $this->addSql('DROP TABLE __temp__funder');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6CFB4E65BB89FAD4 ON funder (orgid_id)');
    }
}
