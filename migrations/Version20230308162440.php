<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230308162440 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE coach_skills (id INT AUTO_INCREMENT NOT NULL, coach_id INT DEFAULT NULL, jeux_id INT DEFAULT NULL, niveau VARCHAR(255) DEFAULT NULL, INDEX IDX_E9E5DC53C105691 (coach_id), INDEX IDX_E9E5DC5EC2AA9D2 (jeux_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE notif (id INT AUTO_INCREMENT NOT NULL, owner_id INT DEFAULT NULL, contenet LONGTEXT DEFAULT NULL, INDEX IDX_C0730D6B7E3C61F9 (owner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE postlike (id INT AUTO_INCREMENT NOT NULL, id_post_id INT DEFAULT NULL, idgamer_id INT DEFAULT NULL, INDEX IDX_B84FD43A9514AA5C (id_post_id), INDEX IDX_B84FD43A8596E91B (idgamer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE coach_skills ADD CONSTRAINT FK_E9E5DC53C105691 FOREIGN KEY (coach_id) REFERENCES coach (id)');
        $this->addSql('ALTER TABLE coach_skills ADD CONSTRAINT FK_E9E5DC5EC2AA9D2 FOREIGN KEY (jeux_id) REFERENCES jeux (id)');
        $this->addSql('ALTER TABLE notif ADD CONSTRAINT FK_C0730D6B7E3C61F9 FOREIGN KEY (owner_id) REFERENCES gamer (id)');
        $this->addSql('ALTER TABLE postlike ADD CONSTRAINT FK_B84FD43A9514AA5C FOREIGN KEY (id_post_id) REFERENCES post (id)');
        $this->addSql('ALTER TABLE postlike ADD CONSTRAINT FK_B84FD43A8596E91B FOREIGN KEY (idgamer_id) REFERENCES gamer (id)');
        $this->addSql('ALTER TABLE classement ADD etat INT DEFAULT NULL, CHANGE score score DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE cours ADD etat INT NOT NULL, CHANGE titre titre VARCHAR(255) DEFAULT NULL, CHANGE video video VARCHAR(255) DEFAULT NULL, CHANGE image image VARCHAR(255) DEFAULT NULL, CHANGE prix prix INT DEFAULT NULL');
        $this->addSql('ALTER TABLE news ADD image VARCHAR(255) NOT NULL, CHANGE date_n date_n DATE NOT NULL, CHANGE description description VARCHAR(65535) NOT NULL');
        $this->addSql('ALTER TABLE planning ADD prix_t DOUBLE PRECISION DEFAULT NULL, CHANGE etat etat INT DEFAULT NULL, CHANGE prix_heure coach_skills_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE planning ADD CONSTRAINT FK_D499BFF6E9870CCF FOREIGN KEY (coach_skills_id) REFERENCES coach_skills (id)');
        $this->addSql('CREATE INDEX IDX_D499BFF6E9870CCF ON planning (coach_skills_id)');
        $this->addSql('ALTER TABLE post ADD idownerpost INT DEFAULT NULL, ADD date DATETIME NOT NULL');
        $this->addSql('ALTER TABLE produit ADD quantite INT DEFAULT NULL, CHANGE description description VARCHAR(65535) DEFAULT NULL');
        $this->addSql('ALTER TABLE review_jeux DROP FOREIGN KEY FK_D5E1F8157F984D83');
        $this->addSql('DROP INDEX IDX_D5E1F8157F984D83 ON review_jeux');
        $this->addSql('ALTER TABLE review_jeux CHANGE rating rating NUMERIC(5, 2) NOT NULL, CHANGE id_gamer_id user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE review_jeux ADD CONSTRAINT FK_D5E1F815A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_D5E1F815A76ED395 ON review_jeux (user_id)');
        $this->addSql('ALTER TABLE team ADD win INT DEFAULT NULL, ADD lose INT DEFAULT NULL, CHANGE idowner ownerteam_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE team ADD CONSTRAINT FK_C4E0A61F75A51373 FOREIGN KEY (ownerteam_id) REFERENCES gamer (id)');
        $this->addSql('CREATE INDEX IDX_C4E0A61F75A51373 ON team (ownerteam_id)');
        $this->addSql('ALTER TABLE tournoi DROP FOREIGN KEY FK_18AFD9DF7E3C61F9');
        $this->addSql('DROP INDEX IDX_18AFD9DF7E3C61F9 ON tournoi');
        $this->addSql('ALTER TABLE tournoi ADD nb_participant INT DEFAULT NULL, CHANGE owner_id ownertournoi_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tournoi ADD CONSTRAINT FK_18AFD9DFB9E0A5A4 FOREIGN KEY (ownertournoi_id) REFERENCES gamer (id)');
        $this->addSql('CREATE INDEX IDX_18AFD9DFB9E0A5A4 ON tournoi (ownertournoi_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE planning DROP FOREIGN KEY FK_D499BFF6E9870CCF');
        $this->addSql('ALTER TABLE coach_skills DROP FOREIGN KEY FK_E9E5DC53C105691');
        $this->addSql('ALTER TABLE coach_skills DROP FOREIGN KEY FK_E9E5DC5EC2AA9D2');
        $this->addSql('ALTER TABLE notif DROP FOREIGN KEY FK_C0730D6B7E3C61F9');
        $this->addSql('ALTER TABLE postlike DROP FOREIGN KEY FK_B84FD43A9514AA5C');
        $this->addSql('ALTER TABLE postlike DROP FOREIGN KEY FK_B84FD43A8596E91B');
        $this->addSql('DROP TABLE coach_skills');
        $this->addSql('DROP TABLE notif');
        $this->addSql('DROP TABLE postlike');
        $this->addSql('ALTER TABLE classement DROP etat, CHANGE score score DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE cours DROP etat, CHANGE titre titre VARCHAR(255) NOT NULL, CHANGE video video VARCHAR(255) NOT NULL, CHANGE image image VARCHAR(255) NOT NULL, CHANGE prix prix INT NOT NULL');
        $this->addSql('ALTER TABLE news DROP image, CHANGE date_n date_n DATETIME NOT NULL, CHANGE description description MEDIUMTEXT NOT NULL');
        $this->addSql('DROP INDEX IDX_D499BFF6E9870CCF ON planning');
        $this->addSql('ALTER TABLE planning DROP prix_t, CHANGE etat etat TINYINT(1) NOT NULL, CHANGE coach_skills_id prix_heure INT DEFAULT NULL');
        $this->addSql('ALTER TABLE post DROP idownerpost, DROP date');
        $this->addSql('ALTER TABLE produit DROP quantite, CHANGE description description MEDIUMTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE review_jeux DROP FOREIGN KEY FK_D5E1F815A76ED395');
        $this->addSql('DROP INDEX IDX_D5E1F815A76ED395 ON review_jeux');
        $this->addSql('ALTER TABLE review_jeux CHANGE rating rating INT NOT NULL, CHANGE user_id id_gamer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE review_jeux ADD CONSTRAINT FK_D5E1F8157F984D83 FOREIGN KEY (id_gamer_id) REFERENCES gamer (id)');
        $this->addSql('CREATE INDEX IDX_D5E1F8157F984D83 ON review_jeux (id_gamer_id)');
        $this->addSql('ALTER TABLE team DROP FOREIGN KEY FK_C4E0A61F75A51373');
        $this->addSql('DROP INDEX IDX_C4E0A61F75A51373 ON team');
        $this->addSql('ALTER TABLE team ADD idowner INT DEFAULT NULL, DROP ownerteam_id, DROP win, DROP lose');
        $this->addSql('ALTER TABLE tournoi DROP FOREIGN KEY FK_18AFD9DFB9E0A5A4');
        $this->addSql('DROP INDEX IDX_18AFD9DFB9E0A5A4 ON tournoi');
        $this->addSql('ALTER TABLE tournoi ADD owner_id INT DEFAULT NULL, DROP ownertournoi_id, DROP nb_participant');
        $this->addSql('ALTER TABLE tournoi ADD CONSTRAINT FK_18AFD9DF7E3C61F9 FOREIGN KEY (owner_id) REFERENCES gamer (id)');
        $this->addSql('CREATE INDEX IDX_18AFD9DF7E3C61F9 ON tournoi (owner_id)');
    }
}
