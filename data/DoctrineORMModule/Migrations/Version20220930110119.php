<?php declare(strict_types=1);

namespace DoctrineORMModule\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220930110119 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        //create kelas
        $createTable = <<<SQL
        CREATE TABLE `coba-rest-zf3`.`kelas` (
        `uuid` VARCHAR(36) NOT NULL,
        `kelas` VARCHAR(100) NULL DEFAULT NULL,
        `created_at` DATETIME NOT NULL,
        `updated_at` DATETIME NULL DEFAULT NULL,
        `deleted_at` DATETIME NULL DEFAULT NULL,
        PRIMARY KEY (`uuid`));
SQL;
        $this->addSql($createTable);

        //create siswa
        $createTable = <<<SQL
        CREATE TABLE `coba-rest-zf3`.`siswa` (
        `uuid` VARCHAR(36) NOT NULL,
        `nama` VARCHAR(200) NULL,
        `nim` VARCHAR(100) NULL,
        `photo` VARCHAR(200) NULL DEFAULT NULL,
        `kelas_uuid` VARCHAR(36) NULL,
        `created_at` DATETIME NULL,
        `updated_at` DATETIME NULL,
        `deleted_at` DATETIME NULL,
        PRIMARY KEY (`uuid`),
        INDEX `siswa_kelas_idx` (`kelas_uuid` ASC),
        CONSTRAINT `fk_siswa_kelas`
        FOREIGN KEY (kelas_uuid)
        REFERENCES `coba-rest-zf3`.`kelas` (`uuid`)
        ON DELETE SET NULL
        ON UPDATE NO ACTION);
        ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
SQL;
        $this->addSql($createTable);
    }


    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
