<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201012060556 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE order_item (id INT AUTO_INCREMENT NOT NULL, order_id INT NOT NULL, order_uid VARCHAR(32) NOT NULL, barcode VARCHAR(32) NOT NULL, price DOUBLE PRECISION NOT NULL, quantity INT NOT NULL, tax_perc DOUBLE PRECISION NOT NULL, tax_amt DOUBLE PRECISION NOT NULL, tracking_number VARCHAR(128) DEFAULT NULL, canceled TINYINT(1) NOT NULL, shipped_status_sku VARCHAR(32) NOT NULL, INDEX IDX_52EA1F09FCDAEAAA (order_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE order_item ADD CONSTRAINT FK_52EA1F09FCDAEAAA FOREIGN KEY (order_id) REFERENCES `order` (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE order_item');
        $this->addSql('DROP INDEX order_id ON `order`');
    }
}
