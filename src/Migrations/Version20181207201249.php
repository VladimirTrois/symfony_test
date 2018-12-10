<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181207201249 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE checklist (id INT AUTO_INCREMENT NOT NULL, biere_id INT NOT NULL, revendeur_id INT NOT NULL, user_id INT NOT NULL, note INT NOT NULL, service VARCHAR(255) NOT NULL, date_creation DATETIME NOT NULL, INDEX IDX_5C696D2FA71147CC (biere_id), INDEX IDX_5C696D2FF4218D56 (revendeur_id), INDEX IDX_5C696D2FA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, pseudo VARCHAR(255) NOT NULL, date_creation DATETIME NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE checklist ADD CONSTRAINT FK_5C696D2FA71147CC FOREIGN KEY (biere_id) REFERENCES biere (id)');
        $this->addSql('ALTER TABLE checklist ADD CONSTRAINT FK_5C696D2FF4218D56 FOREIGN KEY (revendeur_id) REFERENCES revendeur (id)');
        $this->addSql('ALTER TABLE checklist ADD CONSTRAINT FK_5C696D2FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE revendeur ADD type VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE checklist DROP FOREIGN KEY FK_5C696D2FA76ED395');
        $this->addSql('DROP TABLE checklist');
        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE revendeur DROP type');
    }
}
