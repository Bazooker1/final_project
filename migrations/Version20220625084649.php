<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220625084649 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE company (id INT AUTO_INCREMENT NOT NULL, company_name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, product_name VARCHAR(255) NOT NULL, weight INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_storage (product_id INT NOT NULL, storage_id INT NOT NULL, INDEX IDX_85A300844584665A (product_id), INDEX IDX_85A300845CC5DB90 (storage_id), PRIMARY KEY(product_id, storage_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE provider (id INT AUTO_INCREMENT NOT NULL, companies_id INT DEFAULT NULL, provider_name VARCHAR(255) NOT NULL, phone_number VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_92C4739C6AE4741E (companies_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE provider_product (provider_id INT NOT NULL, product_id INT NOT NULL, INDEX IDX_2312A60AA53A8AA (provider_id), INDEX IDX_2312A60A4584665A (product_id), PRIMARY KEY(provider_id, product_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ship (id INT AUTO_INCREMENT NOT NULL, company_id INT DEFAULT NULL, ship_name VARCHAR(255) NOT NULL, max_weight INT NOT NULL, INDEX IDX_FA30EB24979B1AD6 (company_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE storage (id INT AUTO_INCREMENT NOT NULL, storage_name VARCHAR(255) NOT NULL, capacity INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE product_storage ADD CONSTRAINT FK_85A300844584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_storage ADD CONSTRAINT FK_85A300845CC5DB90 FOREIGN KEY (storage_id) REFERENCES storage (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE provider ADD CONSTRAINT FK_92C4739C6AE4741E FOREIGN KEY (companies_id) REFERENCES company (id)');
        $this->addSql('ALTER TABLE provider_product ADD CONSTRAINT FK_2312A60AA53A8AA FOREIGN KEY (provider_id) REFERENCES provider (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE provider_product ADD CONSTRAINT FK_2312A60A4584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ship ADD CONSTRAINT FK_FA30EB24979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE provider DROP FOREIGN KEY FK_92C4739C6AE4741E');
        $this->addSql('ALTER TABLE ship DROP FOREIGN KEY FK_FA30EB24979B1AD6');
        $this->addSql('ALTER TABLE product_storage DROP FOREIGN KEY FK_85A300844584665A');
        $this->addSql('ALTER TABLE provider_product DROP FOREIGN KEY FK_2312A60A4584665A');
        $this->addSql('ALTER TABLE provider_product DROP FOREIGN KEY FK_2312A60AA53A8AA');
        $this->addSql('ALTER TABLE product_storage DROP FOREIGN KEY FK_85A300845CC5DB90');
        $this->addSql('DROP TABLE company');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE product_storage');
        $this->addSql('DROP TABLE provider');
        $this->addSql('DROP TABLE provider_product');
        $this->addSql('DROP TABLE ship');
        $this->addSql('DROP TABLE storage');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
