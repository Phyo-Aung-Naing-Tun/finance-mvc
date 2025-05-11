<?php

namespace Root\App\Services\Migration;

use Exception;
use Root\App\Services\Model\Model;

abstract class MigrationManager extends Model
{
    use MigrationExecutor;

    public $fillables = [
        "migration",
        "batch",
    ];

    public $table = "migrations";

    protected $dir = __DIR__ . "/../../../../database/migrations";

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

    public function executeMigration(string|null $targetFileName = null)
    {
        echo "\033[32m[Migration Running]\033[0m \n\n";

        $this->makeMigrationTable();

        $migrationFileNames = $this->getMigrationFileNames($targetFileName);

        $migrationFileNames = $this->filterDuplicateMigrations($migrationFileNames);

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

    public function freshMigration()
    {
        echo "\033[32mDropping All Tables....\033[0m \n\n";
        Schema::freshMigrationTable();
        $migrationFileNames = $this->getMigrationFileNames();

        foreach ($migrationFileNames as $migrationFileName) {

            $filePath = $this->dir . "/" . $migrationFileName . ".php";

            if (file_exists($filePath)) {
                try {
                    $migration = require $filePath;

                    if (method_exists($migration, "down")) {
                        $migration->down();
                    } else {
                        echo "\033[33m[SKIPPED]\033[0m No 'down' method: {$migrationFileName}" . PHP_EOL . "\n";
                    }
                } catch (Exception $e) {
                    echo "\033[31m[FAILED to Fresh]\033[0m {$migrationFileName}: " . PHP_EOL . "\n";
                    return false;
                }
            } else {
                echo "\033[31m[FAILED]\033[0m migration file {$migrationFileName} doesn't exist: " . PHP_EOL . "\n";
            }
        }

        return true;
    }
}
