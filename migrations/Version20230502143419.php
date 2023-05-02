<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230502143419 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, orgid_id INT DEFAULT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, email VARCHAR(255) DEFAULT NULL, phonenumber INT DEFAULT NULL, address VARCHAR(255) DEFAULT NULL, INDEX IDX_4C62E638BB89FAD4 (orgid_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE formation (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE formation_action (id INT AUTO_INCREMENT NOT NULL, formationid_id INT NOT NULL, duration VARCHAR(255) NOT NULL COMMENT \'(DC2Type:dateinterval)\', price DOUBLE PRECISION NOT NULL, studentcount INT NOT NULL, INDEX IDX_67D582BF75BE0B0C (formationid_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE funder (id INT AUTO_INCREMENT NOT NULL, orgid_id INT NOT NULL, name VARCHAR(255) NOT NULL, fundingtype INT DEFAULT NULL, UNIQUE INDEX UNIQ_6CFB4E65BB89FAD4 (orgid_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE organisation (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE session (id INT AUTO_INCREMENT NOT NULL, actionid_id INT NOT NULL, funderid_id INT NOT NULL, startdate DATE NOT NULL, enddate DATE NOT NULL, INDEX IDX_D044D5D454805542 (actionid_id), INDEX IDX_D044D5D42584F1FE (funderid_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE session_student (session_id INT NOT NULL, student_id INT NOT NULL, INDEX IDX_A5FB2D69613FECDF (session_id), INDEX IDX_A5FB2D69CB944F1A (student_id), PRIMARY KEY(session_id, student_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE student (id INT AUTO_INCREMENT NOT NULL, contactid_id INT NOT NULL, UNIQUE INDEX UNIQ_B723AF33A9E6CB3 (contactid_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, contactid_id INT DEFAULT NULL, username VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, role INT NOT NULL, INDEX IDX_8D93D649A9E6CB3 (contactid_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE contact ADD CONSTRAINT FK_4C62E638BB89FAD4 FOREIGN KEY (orgid_id) REFERENCES organisation (id)');
        $this->addSql('ALTER TABLE formation_action ADD CONSTRAINT FK_67D582BF75BE0B0C FOREIGN KEY (formationid_id) REFERENCES formation (id)');
        $this->addSql('ALTER TABLE funder ADD CONSTRAINT FK_6CFB4E65BB89FAD4 FOREIGN KEY (orgid_id) REFERENCES organisation (id)');
        $this->addSql('ALTER TABLE session ADD CONSTRAINT FK_D044D5D454805542 FOREIGN KEY (actionid_id) REFERENCES formation_action (id)');
        $this->addSql('ALTER TABLE session ADD CONSTRAINT FK_D044D5D42584F1FE FOREIGN KEY (funderid_id) REFERENCES funder (id)');
        $this->addSql('ALTER TABLE session_student ADD CONSTRAINT FK_A5FB2D69613FECDF FOREIGN KEY (session_id) REFERENCES session (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE session_student ADD CONSTRAINT FK_A5FB2D69CB944F1A FOREIGN KEY (student_id) REFERENCES student (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE student ADD CONSTRAINT FK_B723AF33A9E6CB3 FOREIGN KEY (contactid_id) REFERENCES contact (id)');
        $this->addSql('ALTER TABLE `user` ADD CONSTRAINT FK_8D93D649A9E6CB3 FOREIGN KEY (contactid_id) REFERENCES contact (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contact DROP FOREIGN KEY FK_4C62E638BB89FAD4');
        $this->addSql('ALTER TABLE formation_action DROP FOREIGN KEY FK_67D582BF75BE0B0C');
        $this->addSql('ALTER TABLE funder DROP FOREIGN KEY FK_6CFB4E65BB89FAD4');
        $this->addSql('ALTER TABLE session DROP FOREIGN KEY FK_D044D5D454805542');
        $this->addSql('ALTER TABLE session DROP FOREIGN KEY FK_D044D5D42584F1FE');
        $this->addSql('ALTER TABLE session_student DROP FOREIGN KEY FK_A5FB2D69613FECDF');
        $this->addSql('ALTER TABLE session_student DROP FOREIGN KEY FK_A5FB2D69CB944F1A');
        $this->addSql('ALTER TABLE student DROP FOREIGN KEY FK_B723AF33A9E6CB3');
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D649A9E6CB3');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE formation');
        $this->addSql('DROP TABLE formation_action');
        $this->addSql('DROP TABLE funder');
        $this->addSql('DROP TABLE organisation');
        $this->addSql('DROP TABLE session');
        $this->addSql('DROP TABLE session_student');
        $this->addSql('DROP TABLE student');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
