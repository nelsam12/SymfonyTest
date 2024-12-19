<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241216203454 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE article (id SERIAL NOT NULL, libelle VARCHAR(255) NOT NULL, qte_stock INT NOT NULL, prix_unitaire DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE article_demande (id SERIAL NOT NULL, article_id INT DEFAULT NULL, demande_dette_id INT DEFAULT NULL, qte INT NOT NULL, montant DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_CB4693127294869C ON article_demande (article_id)');
        $this->addSql('CREATE INDEX IDX_CB469312A74D4963 ON article_demande (demande_dette_id)');
        $this->addSql('CREATE TABLE article_dette (id SERIAL NOT NULL, dette_id INT DEFAULT NULL, article_id INT DEFAULT NULL, qte_achete INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_F4ACBA19E11400A1 ON article_dette (dette_id)');
        $this->addSql('CREATE INDEX IDX_F4ACBA197294869C ON article_dette (article_id)');
        $this->addSql('CREATE TABLE client (id SERIAL NOT NULL, compte_id INT DEFAULT NULL, surnom VARCHAR(255) NOT NULL, telephone VARCHAR(255) NOT NULL, adresse VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C7440455F2C56620 ON client (compte_id)');
        $this->addSql('CREATE TABLE demande_dette (id SERIAL NOT NULL, create_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, montant DOUBLE PRECISION NOT NULL, montant_verse DOUBLE PRECISION NOT NULL, update_at DATE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN demande_dette.create_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE dette (id SERIAL NOT NULL, client_id INT NOT NULL, create_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, update_at DATE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_831BC80819EB6921 ON dette (client_id)');
        $this->addSql('COMMENT ON COLUMN dette.create_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE paiement (id SERIAL NOT NULL, dette_id INT DEFAULT NULL, create_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, montant_paye DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_B1DC7A1EE11400A1 ON paiement (dette_id)');
        $this->addSql('COMMENT ON COLUMN paiement.create_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE article_demande ADD CONSTRAINT FK_CB4693127294869C FOREIGN KEY (article_id) REFERENCES article (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE article_demande ADD CONSTRAINT FK_CB469312A74D4963 FOREIGN KEY (demande_dette_id) REFERENCES demande_dette (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE article_dette ADD CONSTRAINT FK_F4ACBA19E11400A1 FOREIGN KEY (dette_id) REFERENCES dette (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE article_dette ADD CONSTRAINT FK_F4ACBA197294869C FOREIGN KEY (article_id) REFERENCES article (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C7440455F2C56620 FOREIGN KEY (compte_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE dette ADD CONSTRAINT FK_831BC80819EB6921 FOREIGN KEY (client_id) REFERENCES client (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE paiement ADD CONSTRAINT FK_B1DC7A1EE11400A1 FOREIGN KEY (dette_id) REFERENCES dette (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE article_demande DROP CONSTRAINT FK_CB4693127294869C');
        $this->addSql('ALTER TABLE article_demande DROP CONSTRAINT FK_CB469312A74D4963');
        $this->addSql('ALTER TABLE article_dette DROP CONSTRAINT FK_F4ACBA19E11400A1');
        $this->addSql('ALTER TABLE article_dette DROP CONSTRAINT FK_F4ACBA197294869C');
        $this->addSql('ALTER TABLE client DROP CONSTRAINT FK_C7440455F2C56620');
        $this->addSql('ALTER TABLE dette DROP CONSTRAINT FK_831BC80819EB6921');
        $this->addSql('ALTER TABLE paiement DROP CONSTRAINT FK_B1DC7A1EE11400A1');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE article_demande');
        $this->addSql('DROP TABLE article_dette');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE demande_dette');
        $this->addSql('DROP TABLE dette');
        $this->addSql('DROP TABLE paiement');
    }
}
