<?php

namespace Root\App\Services\Migration;

use Root\App\Services\Model\Model;

abstract class MigrationManager extends Model
{
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

    protected function makeMigrationTable()
    {
        Schema::create('migrations', function (Blueprint $table) {
            $table->id();
            $table->string("migration");
            $table->int("batch");
            $table->timestamps();
        });
    }

    protected function filterDuplicateMigrations($migrationNames)
    {
        $finishedMigrations = self::all();
        $finishedMigrationNames = array_map(fn($migration) => $migration["migration"], $finishedMigrations);
        return array_diff($migrationNames, $finishedMigrationNames);
    }

    public function addToMigrationTable($migrationName, $batch)
    {
        $toArray = explode(".", $migrationName);

        $name = array_shift($toArray);


        return self::create([
            "migration" => $name,
            "batch" => $batch,
        ]);
    }

    public function getBatch()
    {
        $latestMigration = self::latest()->first();
        return $latestMigration ? $latestMigration["batch"] + 1 : 1;
    }
}
