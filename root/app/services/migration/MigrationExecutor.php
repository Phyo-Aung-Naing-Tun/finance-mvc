<?php

namespace Root\App\Services\Migration;

use Exception;

trait MigrationExecutor
{
    protected $dir = __DIR__ . "/../../../../database/migrations";

    protected function makeMigrationTable()
    {

        if (!Schema::hasTable("migrations")) {
            Schema::create(
                'migrations',
                function (Blueprint $table) {
                    $table->id();
                    $table->string("migration");
                    $table->int("batch");
                    $table->timestamps();
                }
            );
        }
    }

    protected function getMigrationFileNames()
    {

        $files = array_values(array_diff(scandir($this->dir), ['.', '..']));

        $migrationNames = array_map(function ($file) { //get name and cut .php 
            $toArray = explode(".", $file);
            return array_shift($toArray);
        }, $files);

        return $this->filterDuplicateMigrations($migrationNames);
    }

    protected function filterDuplicateMigrations($migrationNames)
    {
        $finishedMigrations = self::all();
        $finishedMigrationNames = array_map(fn($migration) => $migration["migration"], $finishedMigrations);
        return array_diff($migrationNames, $finishedMigrationNames);
    }

    protected function runMigration($fileName)
    {
        $filePath = $this->dir . "/" . $fileName . ".php";
        try {
            $migration = require $filePath;

            if (method_exists($migration, "up")) {
                $migration->up();
                echo "\033[32m[SUCCESS]\033[0m Migrated: {$fileName}" . PHP_EOL . "\n";
                return $fileName;
            } else {
                echo "\033[33m[SKIPPED]\033[0m No 'up' method: {$fileName}" . PHP_EOL . "\n";
                return null;
            }
        } catch (Exception $e) {
            echo "\033[31m[FAILED]\033[0m {$fileName}: " . PHP_EOL . "\n";
            return null;
        }
    }

    protected function addToMigrationTable($migrationName, $batch)
    {
        return self::create([
            "migration" => $migrationName,
            "batch" => $batch,
        ]);
    }

    protected function getBatch()
    {
        $latestMigration = self::latest()->first();
        return $latestMigration ? $latestMigration["batch"] + 1 : 1;
    }
}
