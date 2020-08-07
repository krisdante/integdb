<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200807200248 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('DROP SEQUENCE greeting_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE industry_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE integration_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE partner_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE software_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE industry (id INT NOT NULL, name VARCHAR(255) NOT NULL, symbol VARCHAR(100) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE integration (id INT NOT NULL, software_id INT NOT NULL, partner_id INT NOT NULL, industry_id INT DEFAULT NULL, customer VARCHAR(255) DEFAULT NULL, url VARCHAR(255) DEFAULT NULL, year INT NOT NULL, market VARCHAR(200) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_FDE96D9BD7452741 ON integration (software_id)');
        $this->addSql('CREATE INDEX IDX_FDE96D9B9393F8FE ON integration (partner_id)');
        $this->addSql('CREATE INDEX IDX_FDE96D9B2B19A734 ON integration (industry_id)');
        $this->addSql('CREATE TABLE partner (id INT NOT NULL, name VARCHAR(255) NOT NULL, url VARCHAR(255) NOT NULL, logo VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE software (id INT NOT NULL, name VARCHAR(160) NOT NULL, company VARCHAR(200) NOT NULL, logo VARCHAR(100) DEFAULT NULL, type VARCHAR(100) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE integration ADD CONSTRAINT FK_FDE96D9BD7452741 FOREIGN KEY (software_id) REFERENCES software (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE integration ADD CONSTRAINT FK_FDE96D9B9393F8FE FOREIGN KEY (partner_id) REFERENCES partner (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE integration ADD CONSTRAINT FK_FDE96D9B2B19A734 FOREIGN KEY (industry_id) REFERENCES industry (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE greeting');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE integration DROP CONSTRAINT FK_FDE96D9B2B19A734');
        $this->addSql('ALTER TABLE integration DROP CONSTRAINT FK_FDE96D9B9393F8FE');
        $this->addSql('ALTER TABLE integration DROP CONSTRAINT FK_FDE96D9BD7452741');
        $this->addSql('DROP SEQUENCE industry_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE integration_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE partner_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE software_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE greeting_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE greeting (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('DROP TABLE industry');
        $this->addSql('DROP TABLE integration');
        $this->addSql('DROP TABLE partner');
        $this->addSql('DROP TABLE software');
    }
}
