<?php

namespace Root\App\Services\Migration;

use Exception;
use Root\App\Services\Migration\MigrationManager;

class Migration extends MigrationManager
{


    public function migrate()
    {
        if (!Schema::hasTable("migrations")) {
            $this->makeMigrationTable();
        }

        echo "\033[32m[Migration Running]\033[0m \n\n";

        $dir = __DIR__ . "/../../../../database/migrations";

        $files = array_values(array_diff(scandir($dir), ['.', '..']));

        $migrationNames = array_map(function ($file) { //get name and cut .php 
            $toArray = explode(".", $file);
            return array_shift($toArray);
        }, $files);

        $filteredMigrationNames = $this->filterDuplicateMigrations($migrationNames);
        $batch = $this->getBatch();

        if (count($filteredMigrationNames) > 0) {

            foreach ($filteredMigrationNames as $key => $file) {

                $filePath = $dir . "/" . $file . ".php";
                $status = 'RUNNING';
                try {

                    $migration = require $filePath;

                    if (method_exists($migration, "up")) {
                        $migration->up();
                        $this->addToMigrationTable($file, $batch);
                        echo "\033[32m[$status]\033[0m Migrated: {$file}" . PHP_EOL . "\n";
                        $status = "SUCCESS";
                    } else {
                        echo "\033[33m[SKIPPED]\033[0m No 'up' method: {$file}" . PHP_EOL . "\n";
                    }
                } catch (Exception $e) {
                    echo "\033[31m[FAILED]\033[0m {$file}: " . PHP_EOL . "\n";
                }
            }
        } else {
            echo "\033[32m[Nothing to migrate]\033[0m \n\n";
        }
    }

    public function migrateFresh()
    {
        echo "freshing the migrations";
    }

    public function createMigrateFile($payload)
    {
        echo "Start creating migration file......";
        try {
            return $this->buildMigration($payload);
        } catch (\Exception $e) {
            echo $e->getMessage();
            echo "❌ Failed to create migration file......";
        }
        echo "create migratein $payload";
    }
}
