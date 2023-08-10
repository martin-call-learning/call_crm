<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230810130144 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__contact AS SELECT id, organisation_id, firstname, lastname, email, phonenumber, address FROM contact');
        $this->addSql('DROP TABLE contact');
        $this->addSql('CREATE TABLE contact (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, organisation_id INTEGER DEFAULT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, email VARCHAR(255) DEFAULT NULL, phone_number INTEGER DEFAULT NULL, address VARCHAR(255) DEFAULT NULL, created_at DATETIME DEFAULT NULL --(DC2Type:datetime_immutable)
        , updated_at DATETIME DEFAULT NULL --(DC2Type:datetime_immutable)
        , deleted_at DATETIME DEFAULT NULL --(DC2Type:datetime_immutable)
        , CONSTRAINT FK_4C62E6389E6B1585 FOREIGN KEY (organisation_id) REFERENCES organisation (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO contact (id, organisation_id, firstname, lastname, email, phone_number, address) SELECT id, organisation_id, firstname, lastname, email, phonenumber, address FROM __temp__contact');
        $this->addSql('DROP TABLE __temp__contact');
        $this->addSql('CREATE INDEX IDX_4C62E6389E6B1585 ON contact (organisation_id)');
        $this->addSql('ALTER TABLE formation ADD COLUMN created_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE formation ADD COLUMN updated_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE formation ADD COLUMN deleted_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE formation_action ADD COLUMN created_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE formation_action ADD COLUMN updated_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE formation_action ADD COLUMN deleted_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE funder ADD COLUMN created_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE funder ADD COLUMN updated_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE funder ADD COLUMN deleted_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE funding_type ADD COLUMN created_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE funding_type ADD COLUMN updated_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE funding_type ADD COLUMN deleted_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE organisation ADD COLUMN created_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE organisation ADD COLUMN updated_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE organisation ADD COLUMN deleted_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE session ADD COLUMN created_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE session ADD COLUMN updated_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE session ADD COLUMN deleted_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE skill ADD COLUMN created_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE skill ADD COLUMN updated_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE skill ADD COLUMN deleted_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE student ADD COLUMN created_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE student ADD COLUMN updated_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE student ADD COLUMN deleted_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE test ADD COLUMN created_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE test ADD COLUMN updated_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE test ADD COLUMN deleted_at DATETIME DEFAULT NULL');
        $this->addSql('CREATE TEMPORARY TABLE __temp__user AS SELECT id, contactid_id, username, password, role FROM user');
        $this->addSql('DROP TABLE user');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, contact_id INTEGER DEFAULT NULL, username VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, role INTEGER NOT NULL, created_at DATETIME DEFAULT NULL --(DC2Type:datetime_immutable)
        , updated_at DATETIME DEFAULT NULL --(DC2Type:datetime_immutable)
        , deleted_at DATETIME DEFAULT NULL --(DC2Type:datetime_immutable)
        , CONSTRAINT FK_8D93D649E7A1254A FOREIGN KEY (contact_id) REFERENCES contact (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO user (id, contact_id, username, password, role) SELECT id, contactid_id, username, password, role FROM __temp__user');
        $this->addSql('DROP TABLE __temp__user');
        $this->addSql('CREATE INDEX IDX_8D93D649E7A1254A ON user (contact_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__contact AS SELECT id, organisation_id, firstname, lastname, email, phone_number, address FROM contact');
        $this->addSql('DROP TABLE contact');
        $this->addSql('CREATE TABLE contact (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, organisation_id INTEGER DEFAULT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, email VARCHAR(255) DEFAULT NULL, phonenumber INTEGER DEFAULT NULL, address VARCHAR(255) DEFAULT NULL, CONSTRAINT FK_4C62E6389E6B1585 FOREIGN KEY (organisation_id) REFERENCES organisation (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO contact (id, organisation_id, firstname, lastname, email, phonenumber, address) SELECT id, organisation_id, firstname, lastname, email, phone_number, address FROM __temp__contact');
        $this->addSql('DROP TABLE __temp__contact');
        $this->addSql('CREATE INDEX IDX_4C62E6389E6B1585 ON contact (organisation_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__formation AS SELECT id, name, code, global_goal, peda_goal, content, highlights, expected_results FROM formation');
        $this->addSql('DROP TABLE formation');
        $this->addSql('CREATE TABLE formation (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, code VARCHAR(6) NOT NULL, global_goal VARCHAR(1024) DEFAULT NULL, peda_goal VARCHAR(1024) DEFAULT NULL, content VARCHAR(1024) DEFAULT NULL, highlights VARCHAR(1024) DEFAULT NULL, expected_results VARCHAR(1024) DEFAULT NULL)');
        $this->addSql('INSERT INTO formation (id, name, code, global_goal, peda_goal, content, highlights, expected_results) SELECT id, name, code, global_goal, peda_goal, content, highlights, expected_results FROM __temp__formation');
        $this->addSql('DROP TABLE __temp__formation');
        $this->addSql('CREATE TEMPORARY TABLE __temp__formation_action AS SELECT id, formation_id, duration, price, expected_student_count, remote, presential, level_required FROM formation_action');
        $this->addSql('DROP TABLE formation_action');
        $this->addSql('CREATE TABLE formation_action (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, formation_id INTEGER NOT NULL, duration VARCHAR(255) NOT NULL --(DC2Type:dateinterval)
        , price DOUBLE PRECISION NOT NULL, expected_student_count INTEGER DEFAULT NULL, remote BOOLEAN NOT NULL, presential BOOLEAN NOT NULL, level_required INTEGER DEFAULT NULL, CONSTRAINT FK_67D582BF5200282E FOREIGN KEY (formation_id) REFERENCES formation (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO formation_action (id, formation_id, duration, price, expected_student_count, remote, presential, level_required) SELECT id, formation_id, duration, price, expected_student_count, remote, presential, level_required FROM __temp__formation_action');
        $this->addSql('DROP TABLE __temp__formation_action');
        $this->addSql('CREATE INDEX IDX_67D582BF5200282E ON formation_action (formation_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__funder AS SELECT id, organisation_id, name FROM funder');
        $this->addSql('DROP TABLE funder');
        $this->addSql('CREATE TABLE funder (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, organisation_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL, CONSTRAINT FK_6CFB4E659E6B1585 FOREIGN KEY (organisation_id) REFERENCES organisation (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO funder (id, organisation_id, name) SELECT id, organisation_id, name FROM __temp__funder');
        $this->addSql('DROP TABLE __temp__funder');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6CFB4E659E6B1585 ON funder (organisation_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__funding_type AS SELECT id, name FROM funding_type');
        $this->addSql('DROP TABLE funding_type');
        $this->addSql('CREATE TABLE funding_type (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO funding_type (id, name) SELECT id, name FROM __temp__funding_type');
        $this->addSql('DROP TABLE __temp__funding_type');
        $this->addSql('CREATE TEMPORARY TABLE __temp__organisation AS SELECT id, name FROM organisation');
        $this->addSql('DROP TABLE organisation');
        $this->addSql('CREATE TABLE organisation (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO organisation (id, name) SELECT id, name FROM __temp__organisation');
        $this->addSql('DROP TABLE __temp__organisation');
        $this->addSql('CREATE TEMPORARY TABLE __temp__session AS SELECT id, formation_action_id, start_date, end_date FROM session');
        $this->addSql('DROP TABLE session');
        $this->addSql('CREATE TABLE session (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, formation_action_id INTEGER NOT NULL, start_date DATE NOT NULL, end_date DATE NOT NULL, CONSTRAINT FK_D044D5D4574FA0E8 FOREIGN KEY (formation_action_id) REFERENCES formation_action (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO session (id, formation_action_id, start_date, end_date) SELECT id, formation_action_id, start_date, end_date FROM __temp__session');
        $this->addSql('DROP TABLE __temp__session');
        $this->addSql('CREATE INDEX IDX_D044D5D4574FA0E8 ON session (formation_action_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__skill AS SELECT id, name FROM skill');
        $this->addSql('DROP TABLE skill');
        $this->addSql('CREATE TABLE skill (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO skill (id, name) SELECT id, name FROM __temp__skill');
        $this->addSql('DROP TABLE __temp__skill');
        $this->addSql('CREATE TEMPORARY TABLE __temp__student AS SELECT id, contact_id FROM student');
        $this->addSql('DROP TABLE student');
        $this->addSql('CREATE TABLE student (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, contact_id INTEGER NOT NULL, CONSTRAINT FK_B723AF33E7A1254A FOREIGN KEY (contact_id) REFERENCES contact (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO student (id, contact_id) SELECT id, contact_id FROM __temp__student');
        $this->addSql('DROP TABLE __temp__student');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B723AF33E7A1254A ON student (contact_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__test AS SELECT id, skill_id, student_id, name, score FROM test');
        $this->addSql('DROP TABLE test');
        $this->addSql('CREATE TABLE test (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, skill_id INTEGER NOT NULL, student_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL, score INTEGER NOT NULL, CONSTRAINT FK_D87F7E0C5585C142 FOREIGN KEY (skill_id) REFERENCES skill (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_D87F7E0CCB944F1A FOREIGN KEY (student_id) REFERENCES student (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO test (id, skill_id, student_id, name, score) SELECT id, skill_id, student_id, name, score FROM __temp__test');
        $this->addSql('DROP TABLE __temp__test');
        $this->addSql('CREATE INDEX IDX_D87F7E0C5585C142 ON test (skill_id)');
        $this->addSql('CREATE INDEX IDX_D87F7E0CCB944F1A ON test (student_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__user AS SELECT id, contact_id, username, password, role FROM "user"');
        $this->addSql('DROP TABLE "user"');
        $this->addSql('CREATE TABLE "user" (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, contactid_id INTEGER DEFAULT NULL, username VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, role INTEGER NOT NULL, CONSTRAINT FK_8D93D649A9E6CB3 FOREIGN KEY (contactid_id) REFERENCES contact (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO "user" (id, contactid_id, username, password, role) SELECT id, contact_id, username, password, role FROM __temp__user');
        $this->addSql('DROP TABLE __temp__user');
        $this->addSql('CREATE INDEX IDX_8D93D649A9E6CB3 ON "user" (contactid_id)');
    }
}
