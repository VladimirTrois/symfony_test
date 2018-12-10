<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181208211542 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE revendeur_biere');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE revendeur_biere (revendeur_id INT NOT NULL, biere_id INT NOT NULL, INDEX IDX_BE431318F4218D56 (revendeur_id), INDEX IDX_BE431318A71147CC (biere_id), PRIMARY KEY(revendeur_id, biere_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE revendeur_biere ADD CONSTRAINT FK_BE431318A71147CC FOREIGN KEY (biere_id) REFERENCES biere (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE revendeur_biere ADD CONSTRAINT FK_BE431318F4218D56 FOREIGN KEY (revendeur_id) REFERENCES revendeur (id) ON DELETE CASCADE');
    }
}
