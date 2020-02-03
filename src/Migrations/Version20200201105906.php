<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200201105906 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE order_head (id VARCHAR(255) NOT NULL, phone VARCHAR(255) DEFAULT NULL, shipping_status TINYINT(1) NOT NULL, shipping_price NUMERIC(10, 2) NOT NULL, shipping_payment_status TINYINT(1) NOT NULL, payment_status TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE order_body (id INT AUTO_INCREMENT NOT NULL, id_order_head_id VARCHAR(255) NOT NULL, barcode NUMERIC(13, 0) NOT NULL, price NUMERIC(10, 2) NOT NULL, cost NUMERIC(10, 0) NOT NULL, tax_perc NUMERIC(4, 2) NOT NULL, tax_amt NUMERIC(10, 2) NOT NULL, quantity NUMERIC(5, 0) NOT NULL, tracking_number VARCHAR(50) DEFAULT NULL, canceled TINYINT(1) NOT NULL, shipped_status_sku TINYINT(1) NOT NULL, INDEX IDX_965931A5BC4819B0 (id_order_head_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE order_body ADD CONSTRAINT FK_965931A5BC4819B0 FOREIGN KEY (id_order_head_id) REFERENCES order_head (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE order_body DROP FOREIGN KEY FK_965931A5BC4819B0');
        $this->addSql('DROP TABLE order_head');
        $this->addSql('DROP TABLE order_body');
    }
}
