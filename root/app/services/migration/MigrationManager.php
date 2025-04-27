<?php

namespace Root\App\Services\Migration;

use Root\App\Services\Model\Model;

abstract class MigrationManager extends Model
{
    use MigrationExecutor;

    public $fillables = [
        "migration",
        "batch",
    ];

    public $table = "migrations";

    public function builder()
    {
        return new MigrationBuilder();
    }

    public function buildMigration($data)
    {
        return $this->builder()
            ->setMigrationName($data)
            ->setTableName($data)
            ->build();
    }

    public function executeMigration()
    {
        echo "\033[32m[Migration Running]\033[0m \n\n";

        $this->makeMigrationTable();

        $migrationFileNames = $this->getMigrationFileNames();

        $batch = $this->getBatch();

        if (count($migrationFileNames) > 0) {

            foreach ($migrationFileNames as $migrationFileName) {

                $migration = $this->runMigration($migrationFileName);

                if (isset($migration)) {

                    $this->addToMigrationTable($migration, $batch);
                }
            }
        } else {
            echo "\033[32m[Nothing to migrate]\033[0m \n\n";
        }
        return;
    }
}
