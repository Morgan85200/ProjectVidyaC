<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230816125141 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comment (id INT AUTO_INCREMENT NOT NULL, user_id_id INT NOT NULL, review_id_id INT NOT NULL, body LONGTEXT NOT NULL, INDEX IDX_9474526C9D86650F (user_id_id), INDEX IDX_9474526C6CCAB24C (review_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE creator (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE game (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, release_date DATE NOT NULL, image VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE game_category (id INT AUTO_INCREMENT NOT NULL, game_id_id INT NOT NULL, category_id_id INT NOT NULL, INDEX IDX_AD08E6E74D77E7D8 (game_id_id), INDEX IDX_AD08E6E79777D11E (category_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE game_creator (id INT AUTO_INCREMENT NOT NULL, game_id_id INT DEFAULT NULL, creator_id_id INT DEFAULT NULL, INDEX IDX_29C4954C4D77E7D8 (game_id_id), INDEX IDX_29C4954CF05788E9 (creator_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE game_platform (id INT AUTO_INCREMENT NOT NULL, game_id_id INT NOT NULL, platform_id_id INT NOT NULL, INDEX IDX_92162FED4D77E7D8 (game_id_id), INDEX IDX_92162FED4D18FAD3 (platform_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE game_user (id INT AUTO_INCREMENT NOT NULL, user_id_id INT NOT NULL, game_id_id INT NOT NULL, note INT DEFAULT NULL, statut VARCHAR(20) DEFAULT NULL, time_spent INT DEFAULT NULL, is_favorited TINYINT(1) NOT NULL, INDEX IDX_6686BA659D86650F (user_id_id), INDEX IDX_6686BA654D77E7D8 (game_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE network (id INT AUTO_INCREMENT NOT NULL, initiator_id_id INT NOT NULL, receiver_id_id INT NOT NULL, INDEX IDX_608487BC848214A8 (initiator_id_id), INDEX IDX_608487BCBE20CAB0 (receiver_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE platform (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(30) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE review (id INT AUTO_INCREMENT NOT NULL, game_id_id INT NOT NULL, user_id_id INT NOT NULL, body LONGTEXT NOT NULL, note INT NOT NULL, is_hidden TINYINT(1) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_794381C64D77E7D8 (game_id_id), INDEX IDX_794381C69D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, bio VARCHAR(255) DEFAULT NULL, profile_picture VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C9D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C6CCAB24C FOREIGN KEY (review_id_id) REFERENCES review (id)');
        $this->addSql('ALTER TABLE game_category ADD CONSTRAINT FK_AD08E6E74D77E7D8 FOREIGN KEY (game_id_id) REFERENCES game (id)');
        $this->addSql('ALTER TABLE game_category ADD CONSTRAINT FK_AD08E6E79777D11E FOREIGN KEY (category_id_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE game_creator ADD CONSTRAINT FK_29C4954C4D77E7D8 FOREIGN KEY (game_id_id) REFERENCES game (id)');
        $this->addSql('ALTER TABLE game_creator ADD CONSTRAINT FK_29C4954CF05788E9 FOREIGN KEY (creator_id_id) REFERENCES creator (id)');
        $this->addSql('ALTER TABLE game_platform ADD CONSTRAINT FK_92162FED4D77E7D8 FOREIGN KEY (game_id_id) REFERENCES game (id)');
        $this->addSql('ALTER TABLE game_platform ADD CONSTRAINT FK_92162FED4D18FAD3 FOREIGN KEY (platform_id_id) REFERENCES platform (id)');
        $this->addSql('ALTER TABLE game_user ADD CONSTRAINT FK_6686BA659D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE game_user ADD CONSTRAINT FK_6686BA654D77E7D8 FOREIGN KEY (game_id_id) REFERENCES game (id)');
        $this->addSql('ALTER TABLE network ADD CONSTRAINT FK_608487BC848214A8 FOREIGN KEY (initiator_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE network ADD CONSTRAINT FK_608487BCBE20CAB0 FOREIGN KEY (receiver_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE review ADD CONSTRAINT FK_794381C64D77E7D8 FOREIGN KEY (game_id_id) REFERENCES game (id)');
        $this->addSql('ALTER TABLE review ADD CONSTRAINT FK_794381C69D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C9D86650F');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C6CCAB24C');
        $this->addSql('ALTER TABLE game_category DROP FOREIGN KEY FK_AD08E6E74D77E7D8');
        $this->addSql('ALTER TABLE game_category DROP FOREIGN KEY FK_AD08E6E79777D11E');
        $this->addSql('ALTER TABLE game_creator DROP FOREIGN KEY FK_29C4954C4D77E7D8');
        $this->addSql('ALTER TABLE game_creator DROP FOREIGN KEY FK_29C4954CF05788E9');
        $this->addSql('ALTER TABLE game_platform DROP FOREIGN KEY FK_92162FED4D77E7D8');
        $this->addSql('ALTER TABLE game_platform DROP FOREIGN KEY FK_92162FED4D18FAD3');
        $this->addSql('ALTER TABLE game_user DROP FOREIGN KEY FK_6686BA659D86650F');
        $this->addSql('ALTER TABLE game_user DROP FOREIGN KEY FK_6686BA654D77E7D8');
        $this->addSql('ALTER TABLE network DROP FOREIGN KEY FK_608487BC848214A8');
        $this->addSql('ALTER TABLE network DROP FOREIGN KEY FK_608487BCBE20CAB0');
        $this->addSql('ALTER TABLE review DROP FOREIGN KEY FK_794381C64D77E7D8');
        $this->addSql('ALTER TABLE review DROP FOREIGN KEY FK_794381C69D86650F');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE creator');
        $this->addSql('DROP TABLE game');
        $this->addSql('DROP TABLE game_category');
        $this->addSql('DROP TABLE game_creator');
        $this->addSql('DROP TABLE game_platform');
        $this->addSql('DROP TABLE game_user');
        $this->addSql('DROP TABLE network');
        $this->addSql('DROP TABLE platform');
        $this->addSql('DROP TABLE review');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
