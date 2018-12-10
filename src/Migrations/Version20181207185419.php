<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181207185419 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE biere (id INT AUTO_INCREMENT NOT NULL, id_brasserie_id INT NOT NULL, nom VARCHAR(255) NOT NULL, robe VARCHAR(255) DEFAULT NULL, type VARCHAR(255) DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, ibu INT DEFAULT NULL, abv VARCHAR(255) DEFAULT NULL, date_creation DATETIME NOT NULL, INDEX IDX_D33ECD171596D32 (id_brasserie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE brasserie (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, numero_rue INT DEFAULT NULL, rue VARCHAR(255) DEFAULT NULL, code_postale INT DEFAULT NULL, pays VARCHAR(255) DEFAULT NULL, date_creation DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE revendeur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, numero_rue INT NOT NULL, rue VARCHAR(255) NOT NULL, code_postale INT NOT NULL, pays VARCHAR(255) NOT NULL, date_creation DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE revendeur_biere (revendeur_id INT NOT NULL, biere_id INT NOT NULL, INDEX IDX_BE431318F4218D56 (revendeur_id), INDEX IDX_BE431318A71147CC (biere_id), PRIMARY KEY(revendeur_id, biere_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE biere ADD CONSTRAINT FK_D33ECD171596D32 FOREIGN KEY (id_brasserie_id) REFERENCES brasserie (id)');
        $this->addSql('ALTER TABLE revendeur_biere ADD CONSTRAINT FK_BE431318F4218D56 FOREIGN KEY (revendeur_id) REFERENCES revendeur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE revendeur_biere ADD CONSTRAINT FK_BE431318A71147CC FOREIGN KEY (biere_id) REFERENCES biere (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE revendeur_biere DROP FOREIGN KEY FK_BE431318A71147CC');
        $this->addSql('ALTER TABLE biere DROP FOREIGN KEY FK_D33ECD171596D32');
        $this->addSql('ALTER TABLE revendeur_biere DROP FOREIGN KEY FK_BE431318F4218D56');
        $this->addSql('DROP TABLE biere');
        $this->addSql('DROP TABLE brasserie');
        $this->addSql('DROP TABLE revendeur');
        $this->addSql('DROP TABLE revendeur_biere');
    }
}
