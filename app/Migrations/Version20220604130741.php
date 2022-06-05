<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;


final class Version20220604130741 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Roles added';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("ALTER TABLE `role` AUTO_INCREMENT = 1");
        $this->addSql("INSERT INTO `role` (`name`)VALUES ('guest')");
        $this->addSql("INSERT INTO `role` (`name`)VALUES ('user')");
        $this->addSql("INSERT INTO `role` (`name`)VALUES ('admin')");
    }

    public function down(Schema $schema): void
    {
        $this->addSql("DELETE FROM `role`WHERE name = 'guest' ");
        $this->addSql("DELETE FROM `role`WHERE name = 'user' ");
        $this->addSql("DELETE FROM `role`WHERE name = 'admin' ");
    }
}
