<?php

namespace Root\App\Services\Migration;

use Exception;
use Root\App\Services\Migration\MigrationManager;

class Migration extends MigrationManager
{


    public function migrate()
    {
        echo "\033[32m[Migration Running]\033[0m \n\n";
        $dir = __DIR__ . "/../../../../database";
        $files = array_diff(scandir($dir), ['.', '..']);

        foreach (array_values($files) as $key => $file) {
            $filePath = $dir . "/" . $file;
            try {
                $migration = require $filePath;

                if (method_exists($migration, "up")) {
                    $migration->up();
                    echo "\033[32m[SUCCESS]\033[0m Migrated: {$file}" . PHP_EOL . "\n";
                } else {
                    echo "\033[33m[SKIPPED]\033[0m No 'up' method: {$file}" . PHP_EOL . "\n";
                }
            } catch (Exception $e) {
                echo "\033[31m[FAILED]\033[0m {$file}: " . PHP_EOL . "\n";
            }
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
