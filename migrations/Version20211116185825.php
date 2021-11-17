<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211116185825 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE adresse (id INT AUTO_INCREMENT NOT NULL, numero_villa VARCHAR(255) NOT NULL, quartier VARCHAR(255) NOT NULL, rue VARCHAR(255) DEFAULT NULL, pays VARCHAR(255) NOT NULL, ville VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE bulletin (id INT AUTO_INCREMENT NOT NULL, etudiant_id INT DEFAULT NULL, numero_semestre INT NOT NULL, moyenne NUMERIC(10, 2) NOT NULL, annee_academique VARCHAR(255) NOT NULL, INDEX IDX_2B7D8942DDEAB1A3 (etudiant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE classe (id INT AUTO_INCREMENT NOT NULL, filiere_id INT DEFAULT NULL, cours_id INT DEFAULT NULL, code VARCHAR(255) NOT NULL, salle VARCHAR(255) NOT NULL, designation VARCHAR(255) NOT NULL, INDEX IDX_8F87BF96180AA129 (filiere_id), INDEX IDX_8F87BF967ECF78B0 (cours_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE coefficient_matiere (id INT AUTO_INCREMENT NOT NULL, class_id INT NOT NULL, matiere_id INT NOT NULL, valeur INT NOT NULL, INDEX IDX_68EC126CEA000B10 (class_id), INDEX IDX_68EC126CF46CD258 (matiere_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cour (id INT AUTO_INCREMENT NOT NULL, professeur_id INT NOT NULL, date DATE NOT NULL, debut DATETIME NOT NULL, fin DATETIME NOT NULL, INDEX IDX_A71F964FBAB22EE9 (professeur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE departement (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(255) NOT NULL, designation VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dossier_etudiant (id INT AUTO_INCREMENT NOT NULL, numero VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etablissement_provenance (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, annee_academique VARCHAR(255) NOT NULL, niveau VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etudiant (id INT AUTO_INCREMENT NOT NULL, formation_id INT NOT NULL, filiere_id INT NOT NULL, provenance_id INT NOT NULL, parent_etudiant_id INT NOT NULL, dossier_id INT NOT NULL, matricule VARCHAR(255) NOT NULL, occupation VARCHAR(255) DEFAULT NULL, signature VARCHAR(255) NOT NULL, INDEX IDX_717E22E35200282E (formation_id), INDEX IDX_717E22E3180AA129 (filiere_id), INDEX IDX_717E22E3C24AFBDB (provenance_id), INDEX IDX_717E22E3B6C6A3D3 (parent_etudiant_id), UNIQUE INDEX UNIQ_717E22E3611C0C56 (dossier_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etudiant_cour (id INT AUTO_INCREMENT NOT NULL, etudiants_id INT NOT NULL, cours_id INT NOT NULL, presence TINYINT(1) NOT NULL, motif VARCHAR(255) DEFAULT NULL, date DATETIME NOT NULL, INDEX IDX_F73E3103A873A5C6 (etudiants_id), INDEX IDX_F73E31037ECF78B0 (cours_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE filiere (id INT AUTO_INCREMENT NOT NULL, departement_id INT NOT NULL, code VARCHAR(255) NOT NULL, designation VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_2ED05D9ECCF9E01E (departement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE formation (id INT AUTO_INCREMENT NOT NULL, designation VARCHAR(255) NOT NULL, cout DOUBLE PRECISION NOT NULL, created_at DATETIME NOT NULL, etat VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE matiere (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(255) NOT NULL, designation VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE matiere_dans_filiere (id INT AUTO_INCREMENT NOT NULL, filiere_id INT NOT NULL, matiere_id INT NOT NULL, duree INT NOT NULL, INDEX IDX_B28F69BE180AA129 (filiere_id), INDEX IDX_B28F69BEF46CD258 (matiere_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE note (id INT AUTO_INCREMENT NOT NULL, etudiant_id INT NOT NULL, matiere_id INT NOT NULL, bulletin_id INT DEFAULT NULL, designation VARCHAR(255) NOT NULL, note NUMERIC(10, 0) NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_CFBDFA14DDEAB1A3 (etudiant_id), INDEX IDX_CFBDFA14F46CD258 (matiere_id), INDEX IDX_CFBDFA14D1AAB236 (bulletin_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE option_filiere (id INT AUTO_INCREMENT NOT NULL, filiere_id INT DEFAULT NULL, code VARCHAR(255) NOT NULL, designation VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_36244AEB180AA129 (filiere_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE parent_etudiant (id INT AUTO_INCREMENT NOT NULL, nom_pere VARCHAR(255) NOT NULL, prenom_pere VARCHAR(255) NOT NULL, profession_pere VARCHAR(255) DEFAULT NULL, prenom_mere VARCHAR(255) NOT NULL, nom_mere VARCHAR(255) NOT NULL, profession_mere VARCHAR(255) DEFAULT NULL, tel_pere VARCHAR(255) DEFAULT NULL, tel_mere VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE personne (id INT AUTO_INCREMENT NOT NULL, adresse_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, avatar VARCHAR(255) DEFAULT NULL, profession VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, INDEX IDX_FCEC9EF4DE7DC5C (adresse_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE personne_ajoindre (id INT AUTO_INCREMENT NOT NULL, personne_id INT NOT NULL, lien VARCHAR(255) NOT NULL, INDEX IDX_4C01A87EA21BD112 (personne_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE professeur (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reglement_formation (id INT AUTO_INCREMENT NOT NULL, annee DATE NOT NULL, mode_reglement VARCHAR(255) NOT NULL, montant_a_regler INT NOT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE responsable_departement (id INT AUTO_INCREMENT NOT NULL, departement_id INT NOT NULL, date_entre_fonction DATETIME NOT NULL, date_sortie_fonction DATETIME DEFAULT NULL, INDEX IDX_C1827290CCF9E01E (departement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tuteur (id INT AUTO_INCREMENT NOT NULL, signature VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, personne_id INT NOT NULL, tuteur_id INT DEFAULT NULL, etudiant_id INT DEFAULT NULL, responsable_id INT DEFAULT NULL, professeur_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, is_verified TINYINT(1) NOT NULL, etat VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), UNIQUE INDEX UNIQ_8D93D649A21BD112 (personne_id), UNIQUE INDEX UNIQ_8D93D64986EC68D8 (tuteur_id), UNIQUE INDEX UNIQ_8D93D649DDEAB1A3 (etudiant_id), UNIQUE INDEX UNIQ_8D93D64953C59D72 (responsable_id), UNIQUE INDEX UNIQ_8D93D649BAB22EE9 (professeur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE bulletin ADD CONSTRAINT FK_2B7D8942DDEAB1A3 FOREIGN KEY (etudiant_id) REFERENCES etudiant (id)');
        $this->addSql('ALTER TABLE classe ADD CONSTRAINT FK_8F87BF96180AA129 FOREIGN KEY (filiere_id) REFERENCES filiere (id)');
        $this->addSql('ALTER TABLE classe ADD CONSTRAINT FK_8F87BF967ECF78B0 FOREIGN KEY (cours_id) REFERENCES cour (id)');
        $this->addSql('ALTER TABLE coefficient_matiere ADD CONSTRAINT FK_68EC126CEA000B10 FOREIGN KEY (class_id) REFERENCES classe (id)');
        $this->addSql('ALTER TABLE coefficient_matiere ADD CONSTRAINT FK_68EC126CF46CD258 FOREIGN KEY (matiere_id) REFERENCES matiere (id)');
        $this->addSql('ALTER TABLE cour ADD CONSTRAINT FK_A71F964FBAB22EE9 FOREIGN KEY (professeur_id) REFERENCES professeur (id)');
        $this->addSql('ALTER TABLE etudiant ADD CONSTRAINT FK_717E22E35200282E FOREIGN KEY (formation_id) REFERENCES formation (id)');
        $this->addSql('ALTER TABLE etudiant ADD CONSTRAINT FK_717E22E3180AA129 FOREIGN KEY (filiere_id) REFERENCES filiere (id)');
        $this->addSql('ALTER TABLE etudiant ADD CONSTRAINT FK_717E22E3C24AFBDB FOREIGN KEY (provenance_id) REFERENCES etablissement_provenance (id)');
        $this->addSql('ALTER TABLE etudiant ADD CONSTRAINT FK_717E22E3B6C6A3D3 FOREIGN KEY (parent_etudiant_id) REFERENCES parent_etudiant (id)');
        $this->addSql('ALTER TABLE etudiant ADD CONSTRAINT FK_717E22E3611C0C56 FOREIGN KEY (dossier_id) REFERENCES dossier_etudiant (id)');
        $this->addSql('ALTER TABLE etudiant_cour ADD CONSTRAINT FK_F73E3103A873A5C6 FOREIGN KEY (etudiants_id) REFERENCES etudiant (id)');
        $this->addSql('ALTER TABLE etudiant_cour ADD CONSTRAINT FK_F73E31037ECF78B0 FOREIGN KEY (cours_id) REFERENCES cour (id)');
        $this->addSql('ALTER TABLE filiere ADD CONSTRAINT FK_2ED05D9ECCF9E01E FOREIGN KEY (departement_id) REFERENCES departement (id)');
        $this->addSql('ALTER TABLE matiere_dans_filiere ADD CONSTRAINT FK_B28F69BE180AA129 FOREIGN KEY (filiere_id) REFERENCES filiere (id)');
        $this->addSql('ALTER TABLE matiere_dans_filiere ADD CONSTRAINT FK_B28F69BEF46CD258 FOREIGN KEY (matiere_id) REFERENCES matiere (id)');
        $this->addSql('ALTER TABLE note ADD CONSTRAINT FK_CFBDFA14DDEAB1A3 FOREIGN KEY (etudiant_id) REFERENCES etudiant (id)');
        $this->addSql('ALTER TABLE note ADD CONSTRAINT FK_CFBDFA14F46CD258 FOREIGN KEY (matiere_id) REFERENCES matiere (id)');
        $this->addSql('ALTER TABLE note ADD CONSTRAINT FK_CFBDFA14D1AAB236 FOREIGN KEY (bulletin_id) REFERENCES bulletin (id)');
        $this->addSql('ALTER TABLE option_filiere ADD CONSTRAINT FK_36244AEB180AA129 FOREIGN KEY (filiere_id) REFERENCES filiere (id)');
        $this->addSql('ALTER TABLE personne ADD CONSTRAINT FK_FCEC9EF4DE7DC5C FOREIGN KEY (adresse_id) REFERENCES adresse (id)');
        $this->addSql('ALTER TABLE personne_ajoindre ADD CONSTRAINT FK_4C01A87EA21BD112 FOREIGN KEY (personne_id) REFERENCES personne (id)');
        $this->addSql('ALTER TABLE responsable_departement ADD CONSTRAINT FK_C1827290CCF9E01E FOREIGN KEY (departement_id) REFERENCES departement (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649A21BD112 FOREIGN KEY (personne_id) REFERENCES personne (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64986EC68D8 FOREIGN KEY (tuteur_id) REFERENCES tuteur (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649DDEAB1A3 FOREIGN KEY (etudiant_id) REFERENCES etudiant (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64953C59D72 FOREIGN KEY (responsable_id) REFERENCES responsable_departement (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649BAB22EE9 FOREIGN KEY (professeur_id) REFERENCES professeur (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE personne DROP FOREIGN KEY FK_FCEC9EF4DE7DC5C');
        $this->addSql('ALTER TABLE note DROP FOREIGN KEY FK_CFBDFA14D1AAB236');
        $this->addSql('ALTER TABLE coefficient_matiere DROP FOREIGN KEY FK_68EC126CEA000B10');
        $this->addSql('ALTER TABLE classe DROP FOREIGN KEY FK_8F87BF967ECF78B0');
        $this->addSql('ALTER TABLE etudiant_cour DROP FOREIGN KEY FK_F73E31037ECF78B0');
        $this->addSql('ALTER TABLE filiere DROP FOREIGN KEY FK_2ED05D9ECCF9E01E');
        $this->addSql('ALTER TABLE responsable_departement DROP FOREIGN KEY FK_C1827290CCF9E01E');
        $this->addSql('ALTER TABLE etudiant DROP FOREIGN KEY FK_717E22E3611C0C56');
        $this->addSql('ALTER TABLE etudiant DROP FOREIGN KEY FK_717E22E3C24AFBDB');
        $this->addSql('ALTER TABLE bulletin DROP FOREIGN KEY FK_2B7D8942DDEAB1A3');
        $this->addSql('ALTER TABLE etudiant_cour DROP FOREIGN KEY FK_F73E3103A873A5C6');
        $this->addSql('ALTER TABLE note DROP FOREIGN KEY FK_CFBDFA14DDEAB1A3');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649DDEAB1A3');
        $this->addSql('ALTER TABLE classe DROP FOREIGN KEY FK_8F87BF96180AA129');
        $this->addSql('ALTER TABLE etudiant DROP FOREIGN KEY FK_717E22E3180AA129');
        $this->addSql('ALTER TABLE matiere_dans_filiere DROP FOREIGN KEY FK_B28F69BE180AA129');
        $this->addSql('ALTER TABLE option_filiere DROP FOREIGN KEY FK_36244AEB180AA129');
        $this->addSql('ALTER TABLE etudiant DROP FOREIGN KEY FK_717E22E35200282E');
        $this->addSql('ALTER TABLE coefficient_matiere DROP FOREIGN KEY FK_68EC126CF46CD258');
        $this->addSql('ALTER TABLE matiere_dans_filiere DROP FOREIGN KEY FK_B28F69BEF46CD258');
        $this->addSql('ALTER TABLE note DROP FOREIGN KEY FK_CFBDFA14F46CD258');
        $this->addSql('ALTER TABLE etudiant DROP FOREIGN KEY FK_717E22E3B6C6A3D3');
        $this->addSql('ALTER TABLE personne_ajoindre DROP FOREIGN KEY FK_4C01A87EA21BD112');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649A21BD112');
        $this->addSql('ALTER TABLE cour DROP FOREIGN KEY FK_A71F964FBAB22EE9');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649BAB22EE9');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64953C59D72');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64986EC68D8');
        $this->addSql('DROP TABLE adresse');
        $this->addSql('DROP TABLE bulletin');
        $this->addSql('DROP TABLE classe');
        $this->addSql('DROP TABLE coefficient_matiere');
        $this->addSql('DROP TABLE cour');
        $this->addSql('DROP TABLE departement');
        $this->addSql('DROP TABLE dossier_etudiant');
        $this->addSql('DROP TABLE etablissement_provenance');
        $this->addSql('DROP TABLE etudiant');
        $this->addSql('DROP TABLE etudiant_cour');
        $this->addSql('DROP TABLE filiere');
        $this->addSql('DROP TABLE formation');
        $this->addSql('DROP TABLE matiere');
        $this->addSql('DROP TABLE matiere_dans_filiere');
        $this->addSql('DROP TABLE note');
        $this->addSql('DROP TABLE option_filiere');
        $this->addSql('DROP TABLE parent_etudiant');
        $this->addSql('DROP TABLE personne');
        $this->addSql('DROP TABLE personne_ajoindre');
        $this->addSql('DROP TABLE professeur');
        $this->addSql('DROP TABLE reglement_formation');
        $this->addSql('DROP TABLE responsable_departement');
        $this->addSql('DROP TABLE tuteur');
        $this->addSql('DROP TABLE user');
    }
}
