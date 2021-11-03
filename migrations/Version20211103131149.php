<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211103131149 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE coefficient_matiere (id INT AUTO_INCREMENT NOT NULL, class_id INT NOT NULL, matiere_id INT NOT NULL, valeur INT NOT NULL, INDEX IDX_68EC126CEA000B10 (class_id), INDEX IDX_68EC126CF46CD258 (matiere_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etudiant_cour (id INT AUTO_INCREMENT NOT NULL, etudiants_id INT NOT NULL, cours_id INT NOT NULL, presence TINYINT(1) NOT NULL, motif VARCHAR(255) DEFAULT NULL, date DATETIME NOT NULL, INDEX IDX_F73E3103A873A5C6 (etudiants_id), INDEX IDX_F73E31037ECF78B0 (cours_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE matiere_dans_filiere (id INT AUTO_INCREMENT NOT NULL, filiere_id INT NOT NULL, matiere_id INT NOT NULL, duree INT NOT NULL, INDEX IDX_B28F69BE180AA129 (filiere_id), INDEX IDX_B28F69BEF46CD258 (matiere_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE coefficient_matiere ADD CONSTRAINT FK_68EC126CEA000B10 FOREIGN KEY (class_id) REFERENCES classe (id)');
        $this->addSql('ALTER TABLE coefficient_matiere ADD CONSTRAINT FK_68EC126CF46CD258 FOREIGN KEY (matiere_id) REFERENCES matiere (id)');
        $this->addSql('ALTER TABLE etudiant_cour ADD CONSTRAINT FK_F73E3103A873A5C6 FOREIGN KEY (etudiants_id) REFERENCES etudiant (id)');
        $this->addSql('ALTER TABLE etudiant_cour ADD CONSTRAINT FK_F73E31037ECF78B0 FOREIGN KEY (cours_id) REFERENCES cour (id)');
        $this->addSql('ALTER TABLE matiere_dans_filiere ADD CONSTRAINT FK_B28F69BE180AA129 FOREIGN KEY (filiere_id) REFERENCES filiere (id)');
        $this->addSql('ALTER TABLE matiere_dans_filiere ADD CONSTRAINT FK_B28F69BEF46CD258 FOREIGN KEY (matiere_id) REFERENCES matiere (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE coefficient_matiere');
        $this->addSql('DROP TABLE etudiant_cour');
        $this->addSql('DROP TABLE matiere_dans_filiere');
    }
}
