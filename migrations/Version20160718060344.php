<?php

namespace migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

class Version20160718060344 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $table = $schema->createTable("urls");
        $table->addColumn("id", "integer");
        $table->addColumn("shortened_url", "text", ["notnull" => true]);
        $table->addColumn("original_url", "text", ["notnull" => true]);
        $table->addColumn("created", "date", ["notnull" => true]);
        $table->addColumn("updated", "date", ["notnull" => true]);

        $table->setPrimaryKey(["id"]);
    }

    public function down(Schema $schema)
    {
        $schema->dropTable('urls');
    }
}
