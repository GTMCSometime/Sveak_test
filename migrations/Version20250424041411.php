<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250424041411 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE user_score 
            (id INT AUTO_INCREMENT NOT NULL,
            user_id INT NOT NULL, 
            score SMALLINT NOT NULL, 
            UNIQUE INDEX UNIQ_D05BCC09A76ED395 (user_id), 
            PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE user_score ADD CONSTRAINT FK_D05BCC09A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX UNIQ_IDENTIFIER_EMAIL ON user
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE user CHANGE education education VARCHAR(50) NOT NULL, CHANGE agree_terms agree_terms INT NOT NULL
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE user_score DROP FOREIGN KEY FK_D05BCC09A76ED395
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE user_score
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE user CHANGE education education VARCHAR(30) NOT NULL, CHANGE agree_terms agree_terms INT DEFAULT 0
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL ON user (email)
        SQL);
    }
}
