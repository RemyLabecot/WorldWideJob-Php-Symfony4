<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190125093609 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE experience (id INT AUTO_INCREMENT NOT NULL, student_id INT DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, company_brand VARCHAR(255) DEFAULT NULL, begin_date DATE DEFAULT NULL, end_date DATE DEFAULT NULL, place VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, INDEX IDX_590C103CB944F1A (student_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE company (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, image_name VARCHAR(255) DEFAULT NULL, updated_at DATETIME DEFAULT NULL, name VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, address1 VARCHAR(255) NOT NULL, address2 VARCHAR(255) DEFAULT NULL, zipcode VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, type VARCHAR(100) NOT NULL, siret VARCHAR(20) DEFAULT NULL, updated DATETIME NOT NULL, description LONGTEXT DEFAULT NULL, UNIQUE INDEX UNIQ_4FBF094FA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE offer (id INT AUTO_INCREMENT NOT NULL, company_id INT NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, type VARCHAR(255) NOT NULL, begin DATE NOT NULL, duration VARCHAR(255) NOT NULL, job_domain VARCHAR(255) NOT NULL, job VARCHAR(255) NOT NULL, salary VARCHAR(255) DEFAULT NULL, tutor VARCHAR(255) DEFAULT NULL, driving_licence VARCHAR(255) DEFAULT NULL, created DATETIME NOT NULL, updated DATETIME NOT NULL, INDEX IDX_29D6873E979B1AD6 (company_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE candidates_students (offer_id INT NOT NULL, student_id INT NOT NULL, INDEX IDX_C0B3F6A053C674EE (offer_id), INDEX IDX_C0B3F6A0CB944F1A (student_id), PRIMARY KEY(offer_id, student_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE offer_student (offer_id INT NOT NULL, student_id INT NOT NULL, INDEX IDX_162B693A53C674EE (offer_id), INDEX IDX_162B693ACB944F1A (student_id), PRIMARY KEY(offer_id, student_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE student (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, image_name VARCHAR(255) DEFAULT NULL, updated_at DATETIME DEFAULT NULL, lastname VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, ine VARCHAR(11) DEFAULT NULL, phone VARCHAR(255) NOT NULL, address1 VARCHAR(255) NOT NULL, address2 VARCHAR(255) DEFAULT NULL, zipcode VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, civility VARCHAR(4) NOT NULL, created DATETIME NOT NULL, updated DATETIME NOT NULL, birthdate DATE NOT NULL, UNIQUE INDEX UNIQ_B723AF33A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE school (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, image_name VARCHAR(255) DEFAULT NULL, updated_at DATETIME DEFAULT NULL, name VARCHAR(255) NOT NULL, description TINYTEXT DEFAULT NULL, phone VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, address1 VARCHAR(255) NOT NULL, address2 VARCHAR(255) DEFAULT NULL, zipcode VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, uai VARCHAR(8) DEFAULT NULL, siret VARCHAR(20) DEFAULT NULL, updated DATETIME NOT NULL, UNIQUE INDEX UNIQ_F99EDABBA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE skill (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE skill_student (skill_id INT NOT NULL, student_id INT NOT NULL, INDEX IDX_ADD6311A5585C142 (skill_id), INDEX IDX_ADD6311ACB944F1A (student_id), PRIMARY KEY(skill_id, student_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) DEFAULT NULL, created DATETIME NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE formation (id INT AUTO_INCREMENT NOT NULL, student_id INT DEFAULT NULL, formation_name VARCHAR(255) DEFAULT NULL, diploma VARCHAR(255) DEFAULT NULL, domain VARCHAR(255) DEFAULT NULL, begin_date DATE DEFAULT NULL, end_date DATE DEFAULT NULL, description LONGTEXT DEFAULT NULL, INDEX IDX_404021BFCB944F1A (student_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE experience ADD CONSTRAINT FK_590C103CB944F1A FOREIGN KEY (student_id) REFERENCES student (id)');
        $this->addSql('ALTER TABLE company ADD CONSTRAINT FK_4FBF094FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE offer ADD CONSTRAINT FK_29D6873E979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id)');
        $this->addSql('ALTER TABLE candidates_students ADD CONSTRAINT FK_C0B3F6A053C674EE FOREIGN KEY (offer_id) REFERENCES offer (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE candidates_students ADD CONSTRAINT FK_C0B3F6A0CB944F1A FOREIGN KEY (student_id) REFERENCES student (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE offer_student ADD CONSTRAINT FK_162B693A53C674EE FOREIGN KEY (offer_id) REFERENCES offer (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE offer_student ADD CONSTRAINT FK_162B693ACB944F1A FOREIGN KEY (student_id) REFERENCES student (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE student ADD CONSTRAINT FK_B723AF33A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE school ADD CONSTRAINT FK_F99EDABBA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE skill_student ADD CONSTRAINT FK_ADD6311A5585C142 FOREIGN KEY (skill_id) REFERENCES skill (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE skill_student ADD CONSTRAINT FK_ADD6311ACB944F1A FOREIGN KEY (student_id) REFERENCES student (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE formation ADD CONSTRAINT FK_404021BFCB944F1A FOREIGN KEY (student_id) REFERENCES student (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE offer DROP FOREIGN KEY FK_29D6873E979B1AD6');
        $this->addSql('ALTER TABLE candidates_students DROP FOREIGN KEY FK_C0B3F6A053C674EE');
        $this->addSql('ALTER TABLE offer_student DROP FOREIGN KEY FK_162B693A53C674EE');
        $this->addSql('ALTER TABLE experience DROP FOREIGN KEY FK_590C103CB944F1A');
        $this->addSql('ALTER TABLE candidates_students DROP FOREIGN KEY FK_C0B3F6A0CB944F1A');
        $this->addSql('ALTER TABLE offer_student DROP FOREIGN KEY FK_162B693ACB944F1A');
        $this->addSql('ALTER TABLE skill_student DROP FOREIGN KEY FK_ADD6311ACB944F1A');
        $this->addSql('ALTER TABLE formation DROP FOREIGN KEY FK_404021BFCB944F1A');
        $this->addSql('ALTER TABLE skill_student DROP FOREIGN KEY FK_ADD6311A5585C142');
        $this->addSql('ALTER TABLE company DROP FOREIGN KEY FK_4FBF094FA76ED395');
        $this->addSql('ALTER TABLE student DROP FOREIGN KEY FK_B723AF33A76ED395');
        $this->addSql('ALTER TABLE school DROP FOREIGN KEY FK_F99EDABBA76ED395');
        $this->addSql('DROP TABLE experience');
        $this->addSql('DROP TABLE company');
        $this->addSql('DROP TABLE offer');
        $this->addSql('DROP TABLE candidates_students');
        $this->addSql('DROP TABLE offer_student');
        $this->addSql('DROP TABLE student');
        $this->addSql('DROP TABLE school');
        $this->addSql('DROP TABLE skill');
        $this->addSql('DROP TABLE skill_student');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE formation');
    }
}
