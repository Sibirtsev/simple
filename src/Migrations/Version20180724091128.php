<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180724091128 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ref_car_part_damage_items DROP FOREIGN KEY fk_ref_car_part_damage_items_damage_type_id');
        $this->addSql('ALTER TABLE car_evaluation_damages DROP FOREIGN KEY fk_car_evaluation_damages_damage_type_in_list_id');
        $this->addSql('ALTER TABLE ref_car_part_damage_items DROP FOREIGN KEY fk_ref_car_part_damage_items_damage_list_id');
        $this->addSql('ALTER TABLE ref_car_parts DROP FOREIGN KEY fk_ref_car_parts_damage_type_list_id');
        $this->addSql('ALTER TABLE car_evaluation_damages DROP FOREIGN KEY fk_car_evaluation_damages_ref_car_part_id');
        $this->addSql('CREATE TABLE simple (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, created_on DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('DROP TABLE car_evaluation_damages');
        $this->addSql('DROP TABLE changelog');
        $this->addSql('DROP TABLE ref_car_part_damage_description');
        $this->addSql('DROP TABLE ref_car_part_damage_items');
        $this->addSql('DROP TABLE ref_car_part_damage_list');
        $this->addSql('DROP TABLE ref_car_parts');
        $this->addSql('DROP TABLE ref_car_types');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE car_evaluation_damages (id INT UNSIGNED AUTO_INCREMENT NOT NULL, ref_car_part_id INT UNSIGNED NOT NULL, damage_type_in_list_id INT UNSIGNED NOT NULL, car_id INT UNSIGNED NOT NULL, damage_value INT UNSIGNED DEFAULT NULL, damage_severity TINYINT(1) DEFAULT NULL, photo_id INT UNSIGNED DEFAULT NULL, status TINYINT(1) DEFAULT \'1\' NOT NULL, created_by INT UNSIGNED DEFAULT NULL, created_on DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, modified_by INT UNSIGNED DEFAULT NULL, modified_on DATETIME DEFAULT NULL, INDEX car_evaluation_damages_car_id (car_id), INDEX car_evaluation_damages_ref_car_part_id (ref_car_part_id), INDEX car_evaluation_damages_damage_type_in_list_id (damage_type_in_list_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE changelog (id BIGINT UNSIGNED AUTO_INCREMENT NOT NULL, object_type VARCHAR(45) DEFAULT \'\' NOT NULL COLLATE utf8_unicode_ci, object_id INT UNSIGNED DEFAULT 0 NOT NULL, parent_type VARCHAR(45) DEFAULT \'\' NOT NULL COLLATE utf8_unicode_ci, parent_id INT UNSIGNED DEFAULT 0 NOT NULL, action VARCHAR(45) NOT NULL COLLATE utf8_unicode_ci COMMENT \'insert, update, delete\', field VARCHAR(45) DEFAULT NULL COLLATE utf8_unicode_ci COMMENT \'update only\', old_value TEXT DEFAULT NULL COLLATE utf8_unicode_ci COMMENT \'update and delete only\', new_value TEXT DEFAULT NULL COLLATE utf8_unicode_ci COMMENT \'update and insert only\', comment_id INT UNSIGNED DEFAULT NULL COMMENT \'changelog_comments.id\', created_on DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, created_by INT UNSIGNED DEFAULT NULL COMMENT \'users.id\', INDEX parent_type (parent_type, parent_id), INDEX created_by (created_by), INDEX ind_object_type_object_id (object_type, object_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ref_car_part_damage_description (id INT UNSIGNED AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ref_car_part_damage_items (id INT UNSIGNED AUTO_INCREMENT NOT NULL, damage_list_id INT UNSIGNED NOT NULL, damage_type_id INT UNSIGNED NOT NULL, is_photo TINYINT(1) DEFAULT \'1\', weight INT UNSIGNED DEFAULT NULL, INDEX ref_car_part_damage_items_damage_list_id (damage_list_id), INDEX ref_car_part_damage_items_damage_type_id (damage_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ref_car_part_damage_list (id INT UNSIGNED AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ref_car_parts (id INT UNSIGNED AUTO_INCREMENT NOT NULL, damage_type_list_id INT UNSIGNED DEFAULT NULL, name VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, vehicle_type INT UNSIGNED DEFAULT 1 NOT NULL, section VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, sub_section VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, category VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, is_important_bool TINYINT(1) DEFAULT NULL, damage_check INT UNSIGNED NOT NULL, polygon_name VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, status TINYINT(1) DEFAULT \'1\' NOT NULL, created_by INT UNSIGNED DEFAULT NULL, created_on DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, modified_by INT UNSIGNED DEFAULT NULL, modified_on DATETIME DEFAULT NULL, ord INT DEFAULT 0, INDEX ref_car_parts_damage_type_list_id (damage_type_list_id), INDEX section (section), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ref_car_types (id INT UNSIGNED AUTO_INCREMENT NOT NULL, manufacturer VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, maintype VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, mtype_detail VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, subtype_annex VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, body_type VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, door_count INT DEFAULT NULL, cylcapacity INT DEFAULT NULL, kw INT DEFAULT NULL, horsepower INT DEFAULT NULL, hsn VARCHAR(10) DEFAULT NULL COLLATE utf8_unicode_ci, tsn VARCHAR(10) DEFAULT NULL COLLATE utf8_unicode_ci, built_date INT DEFAULT NULL, dat_hst_value VARCHAR(10) DEFAULT NULL COLLATE utf8_unicode_ci, dat_ht_value VARCHAR(10) DEFAULT NULL COLLATE utf8_unicode_ci, dat_ut_value VARCHAR(10) DEFAULT NULL COLLATE utf8_unicode_ci, dat_fza_value INT DEFAULT NULL, maintype_id INT UNSIGNED DEFAULT NULL, mobile_model_id VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, INDEX standard_select (dat_hst_value, maintype, built_date, body_type, mtype_detail), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE car_evaluation_damages ADD CONSTRAINT fk_car_evaluation_damages_damage_type_in_list_id FOREIGN KEY (damage_type_in_list_id) REFERENCES ref_car_part_damage_items (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE car_evaluation_damages ADD CONSTRAINT fk_car_evaluation_damages_ref_car_part_id FOREIGN KEY (ref_car_part_id) REFERENCES ref_car_parts (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE ref_car_part_damage_items ADD CONSTRAINT fk_ref_car_part_damage_items_damage_list_id FOREIGN KEY (damage_list_id) REFERENCES ref_car_part_damage_list (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE ref_car_part_damage_items ADD CONSTRAINT fk_ref_car_part_damage_items_damage_type_id FOREIGN KEY (damage_type_id) REFERENCES ref_car_part_damage_description (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE ref_car_parts ADD CONSTRAINT fk_ref_car_parts_damage_type_list_id FOREIGN KEY (damage_type_list_id) REFERENCES ref_car_part_damage_list (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('DROP TABLE simple');
    }
}
