<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\DBALException;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191113194350 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Install Longman Telegram Bot structure with table prefixes';
    }

    public function up(Schema $schema) : void
    {

        $query = file_get_contents(__DIR__ . '/tg_db/structure.sql');

        try {
            $this->connection->beginTransaction();
            $this->connection->executeQuery($query);
            $this->connection->commit();
        } catch (DBALException $e) {
            $this->connection->rollBack();
        }

    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
