<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181014124010 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE tags (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE travel (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, country VARCHAR(30) NOT NULL, climate VARCHAR(20) NOT NULL, city VARCHAR(50) NOT NULL, season VARCHAR(20) NOT NULL, price INT NOT NULL, picture VARCHAR(255) NOT NULL, picturetwo VARCHAR(255) DEFAULT NULL, INDEX IDX_2D0B6BCEA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE travel_tags (travel_id INT NOT NULL, tags_id INT NOT NULL, INDEX IDX_A4E4778BECAB15B3 (travel_id), INDEX IDX_A4E4778B8D7B4FB4 (tags_id), PRIMARY KEY(travel_id, tags_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(100) NOT NULL, password VARCHAR(255) NOT NULL, firstname VARCHAR(50) NOT NULL, lastname VARCHAR(50) NOT NULL, avatar_file_name VARCHAR(255) DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:simple_array)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE travel ADD CONSTRAINT FK_2D0B6BCEA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE travel_tags ADD CONSTRAINT FK_A4E4778BECAB15B3 FOREIGN KEY (travel_id) REFERENCES travel (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE travel_tags ADD CONSTRAINT FK_A4E4778B8D7B4FB4 FOREIGN KEY (tags_id) REFERENCES tags (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE travel_tags DROP FOREIGN KEY FK_A4E4778B8D7B4FB4');
        $this->addSql('ALTER TABLE travel_tags DROP FOREIGN KEY FK_A4E4778BECAB15B3');
        $this->addSql('ALTER TABLE travel DROP FOREIGN KEY FK_2D0B6BCEA76ED395');
        $this->addSql('DROP TABLE tags');
        $this->addSql('DROP TABLE travel');
        $this->addSql('DROP TABLE travel_tags');
        $this->addSql('DROP TABLE user');
    }
}
