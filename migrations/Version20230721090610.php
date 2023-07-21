<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230721090610 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE skill (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE test (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, skill_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL, score INTEGER NOT NULL, CONSTRAINT FK_D87F7E0C5585C142 FOREIGN KEY (skill_id) REFERENCES skill (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_D87F7E0C5585C142 ON test (skill_id)');
        $this->addSql('ALTER TABLE formation ADD COLUMN code VARCHAR(6) NOT NULL');
        $this->addSql('ALTER TABLE formation ADD COLUMN global_goal VARCHAR(1024) DEFAULT NULL');
        $this->addSql('ALTER TABLE formation ADD COLUMN peda_goal VARCHAR(1024) DEFAULT NULL');
        $this->addSql('ALTER TABLE formation ADD COLUMN content VARCHAR(1024) DEFAULT NULL');
        $this->addSql('ALTER TABLE formation ADD COLUMN highlights VARCHAR(1024) DEFAULT NULL');
        $this->addSql('ALTER TABLE formation ADD COLUMN expected_results VARCHAR(1024) DEFAULT NULL');
        $this->addSql('CREATE TEMPORARY TABLE __temp__formation_action AS SELECT id, duration, price FROM formation_action');
        $this->addSql('DROP TABLE formation_action');
        $this->addSql('CREATE TABLE formation_action (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, formation_id INTEGER NOT NULL, duration VARCHAR(255) NOT NULL --(DC2Type:dateinterval)
        , price DOUBLE PRECISION NOT NULL, expected_student_count INTEGER DEFAULT NULL, remote BOOLEAN NOT NULL, presential BOOLEAN NOT NULL, level_required INTEGER DEFAULT NULL, CONSTRAINT FK_67D582BF5200282E FOREIGN KEY (formation_id) REFERENCES formation (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO formation_action (id, duration, price) SELECT id, duration, price FROM __temp__formation_action');
        $this->addSql('DROP TABLE __temp__formation_action');
        $this->addSql('CREATE INDEX IDX_67D582BF5200282E ON formation_action (formation_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__session AS SELECT id FROM session');
        $this->addSql('DROP TABLE session');
        $this->addSql('CREATE TABLE session (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, formation_action_id INTEGER NOT NULL, start_date DATE NOT NULL, end_date DATE NOT NULL, CONSTRAINT FK_D044D5D4574FA0E8 FOREIGN KEY (formation_action_id) REFERENCES formation_action (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO session (id) SELECT id FROM __temp__session');
        $this->addSql('DROP TABLE __temp__session');
        $this->addSql('CREATE INDEX IDX_D044D5D4574FA0E8 ON session (formation_action_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__student AS SELECT id, contactid_id FROM student');
        $this->addSql('DROP TABLE student');
        $this->addSql('CREATE TABLE student (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, contact_id INTEGER NOT NULL, CONSTRAINT FK_B723AF33E7A1254A FOREIGN KEY (contact_id) REFERENCES contact (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO student (id, contact_id) SELECT id, contactid_id FROM __temp__student');
        $this->addSql('DROP TABLE __temp__student');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B723AF33E7A1254A ON student (contact_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE skill');
        $this->addSql('DROP TABLE test');
        $this->addSql('CREATE TEMPORARY TABLE __temp__formation AS SELECT id, name, description FROM formation');
        $this->addSql('DROP TABLE formation');
        $this->addSql('CREATE TABLE formation (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description CLOB DEFAULT NULL)');
        $this->addSql('INSERT INTO formation (id, name, description) SELECT id, name, description FROM __temp__formation');
        $this->addSql('DROP TABLE __temp__formation');
        $this->addSql('CREATE TEMPORARY TABLE __temp__formation_action AS SELECT id, formation_id, duration, price FROM formation_action');
        $this->addSql('DROP TABLE formation_action');
        $this->addSql('CREATE TABLE formation_action (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, formationid_id INTEGER NOT NULL, duration VARCHAR(255) NOT NULL --(DC2Type:dateinterval)
        , price DOUBLE PRECISION NOT NULL, studentcount INTEGER NOT NULL, CONSTRAINT FK_67D582BF75BE0B0C FOREIGN KEY (formationid_id) REFERENCES formation (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO formation_action (id, formationid_id, duration, price) SELECT id, formation_id, duration, price FROM __temp__formation_action');
        $this->addSql('DROP TABLE __temp__formation_action');
        $this->addSql('CREATE INDEX IDX_67D582BF75BE0B0C ON formation_action (formationid_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__session AS SELECT id, formation_action_id FROM session');
        $this->addSql('DROP TABLE session');
        $this->addSql('CREATE TABLE session (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, actionid_id INTEGER NOT NULL, funderid_id INTEGER NOT NULL, startdate DATE NOT NULL, enddate DATE NOT NULL, CONSTRAINT FK_D044D5D454805542 FOREIGN KEY (actionid_id) REFERENCES formation_action (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_D044D5D42584F1FE FOREIGN KEY (funderid_id) REFERENCES funder (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO session (id, actionid_id) SELECT id, formation_action_id FROM __temp__session');
        $this->addSql('DROP TABLE __temp__session');
        $this->addSql('CREATE INDEX IDX_D044D5D42584F1FE ON session (funderid_id)');
        $this->addSql('CREATE INDEX IDX_D044D5D454805542 ON session (actionid_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__student AS SELECT id, contact_id FROM student');
        $this->addSql('DROP TABLE student');
        $this->addSql('CREATE TABLE student (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, contactid_id INTEGER NOT NULL, CONSTRAINT FK_B723AF33A9E6CB3 FOREIGN KEY (contactid_id) REFERENCES contact (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO student (id, contactid_id) SELECT id, contact_id FROM __temp__student');
        $this->addSql('DROP TABLE __temp__student');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B723AF33A9E6CB3 ON student (contactid_id)');
    }
}
