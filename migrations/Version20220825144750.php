<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220825144750 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE agent (id INT AUTO_INCREMENT NOT NULL, users_id INT DEFAULT NULL, nom VARCHAR(255) DEFAULT NULL, prenom VARCHAR(255) DEFAULT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, created_by VARCHAR(255) DEFAULT NULL, updated_by VARCHAR(255) DEFAULT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_268B9C9D67B3B43D (users_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE bons_materiel (id INT AUTO_INCREMENT NOT NULL, agent_id INT NOT NULL, date_pret DATE NOT NULL, materiel VARCHAR(255) NOT NULL, date_retour DATE NOT NULL, created_at DATETIME NOT NULL, created_by VARCHAR(255) DEFAULT NULL, observation VARCHAR(255) DEFAULT NULL, INDEX IDX_F4DAB8143414710B (agent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE bons_travail (id INT AUTO_INCREMENT NOT NULL, client_id INT DEFAULT NULL, date_execution_prevue DATE NOT NULL, heure_arrivee DATETIME DEFAULT NULL, observations LONGTEXT DEFAULT NULL, travail LONGTEXT NOT NULL, etat VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, created_by VARCHAR(255) DEFAULT NULL, updated_by VARCHAR(255) DEFAULT NULL, signe TINYINT(1) DEFAULT NULL, signature VARCHAR(255) DEFAULT NULL, bon_pdf VARCHAR(255) DEFAULT NULL, lattitude_depart VARCHAR(255) DEFAULT NULL, lattitude_arrivee VARCHAR(255) DEFAULT NULL, longitude_depart VARCHAR(255) DEFAULT NULL, longitude_arrivee VARCHAR(255) DEFAULT NULL, nom_signature VARCHAR(255) DEFAULT NULL, enregistre TINYINT(1) DEFAULT NULL, heureagent TIME DEFAULT NULL, temps_travail TIME DEFAULT NULL, image_name VARCHAR(255) DEFAULT NULL, image_name_agent VARCHAR(255) DEFAULT NULL, numero VARCHAR(255) NOT NULL, INDEX IDX_FB73D97A19EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE bons_travail_agent (bons_travail_id INT NOT NULL, agent_id INT NOT NULL, INDEX IDX_42F4D0CDA6D1769D (bons_travail_id), INDEX IDX_42F4D0CD3414710B (agent_id), PRIMARY KEY(bons_travail_id, agent_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, users_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, email VARCHAR(180) NOT NULL, adresse VARCHAR(255) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', ville VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, created_by VARCHAR(255) DEFAULT NULL, updated_by VARCHAR(255) DEFAULT NULL, password VARCHAR(255) NOT NULL, code_postale VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_C744045567B3B43D (users_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE agent ADD CONSTRAINT FK_268B9C9D67B3B43D FOREIGN KEY (users_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE bons_materiel ADD CONSTRAINT FK_F4DAB8143414710B FOREIGN KEY (agent_id) REFERENCES agent (id)');
        $this->addSql('ALTER TABLE bons_travail ADD CONSTRAINT FK_FB73D97A19EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE bons_travail_agent ADD CONSTRAINT FK_42F4D0CDA6D1769D FOREIGN KEY (bons_travail_id) REFERENCES bons_travail (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE bons_travail_agent ADD CONSTRAINT FK_42F4D0CD3414710B FOREIGN KEY (agent_id) REFERENCES agent (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C744045567B3B43D FOREIGN KEY (users_id) REFERENCES `user` (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bons_materiel DROP FOREIGN KEY FK_F4DAB8143414710B');
        $this->addSql('ALTER TABLE bons_travail_agent DROP FOREIGN KEY FK_42F4D0CD3414710B');
        $this->addSql('ALTER TABLE bons_travail_agent DROP FOREIGN KEY FK_42F4D0CDA6D1769D');
        $this->addSql('ALTER TABLE bons_travail DROP FOREIGN KEY FK_FB73D97A19EB6921');
        $this->addSql('ALTER TABLE agent DROP FOREIGN KEY FK_268B9C9D67B3B43D');
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C744045567B3B43D');
        $this->addSql('DROP TABLE agent');
        $this->addSql('DROP TABLE bons_materiel');
        $this->addSql('DROP TABLE bons_travail');
        $this->addSql('DROP TABLE bons_travail_agent');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
