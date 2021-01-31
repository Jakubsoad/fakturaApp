<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210131185134 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE faktura_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE person_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE pozycja_faktura_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE faktura (id INT NOT NULL, nabywca_id INT DEFAULT NULL, odbiorca_id INT DEFAULT NULL, value DOUBLE PRECISION DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_C99BEBC85EAD47CC ON faktura (nabywca_id)');
        $this->addSql('CREATE INDEX IDX_C99BEBC8328A74B5 ON faktura (odbiorca_id)');
        $this->addSql('CREATE TABLE person (id INT NOT NULL, name VARCHAR(255) NOT NULL, surname VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE pozycja_faktura (id INT NOT NULL, faktura_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, value DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_AE9467E823AA62EA ON pozycja_faktura (faktura_id)');
        $this->addSql('ALTER TABLE faktura ADD CONSTRAINT FK_C99BEBC85EAD47CC FOREIGN KEY (nabywca_id) REFERENCES person (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE faktura ADD CONSTRAINT FK_C99BEBC8328A74B5 FOREIGN KEY (odbiorca_id) REFERENCES person (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE pozycja_faktura ADD CONSTRAINT FK_AE9467E823AA62EA FOREIGN KEY (faktura_id) REFERENCES faktura (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE pozycja_faktura DROP CONSTRAINT FK_AE9467E823AA62EA');
        $this->addSql('ALTER TABLE faktura DROP CONSTRAINT FK_C99BEBC85EAD47CC');
        $this->addSql('ALTER TABLE faktura DROP CONSTRAINT FK_C99BEBC8328A74B5');
        $this->addSql('DROP SEQUENCE faktura_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE person_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE pozycja_faktura_id_seq CASCADE');
        $this->addSql('DROP TABLE faktura');
        $this->addSql('DROP TABLE person');
        $this->addSql('DROP TABLE pozycja_faktura');
    }
}
