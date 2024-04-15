<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240328090611 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE gift (id INT AUTO_INCREMENT NOT NULL, amount VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gift_list (id INT AUTO_INCREMENT NOT NULL, finished TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gift_list_gift (gift_list_id INT NOT NULL, gift_id INT NOT NULL, INDEX IDX_5301C71484A12BDD (gift_list_id), INDEX IDX_5301C714D9D5ED84 (gift_id), PRIMARY KEY(gift_list_id, gift_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE gift_list_gift ADD CONSTRAINT FK_5301C71484A12BDD FOREIGN KEY (gift_list_id) REFERENCES gift_list (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE gift_list_gift ADD CONSTRAINT FK_5301C714D9D5ED84 FOREIGN KEY (gift_id) REFERENCES gift (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE gift_list_gift DROP FOREIGN KEY FK_5301C71484A12BDD');
        $this->addSql('ALTER TABLE gift_list_gift DROP FOREIGN KEY FK_5301C714D9D5ED84');
        $this->addSql('DROP TABLE gift');
        $this->addSql('DROP TABLE gift_list');
        $this->addSql('DROP TABLE gift_list_gift');
    }
}
