<?php

namespace Root\App\Services\Migration;

abstract class MigrationManager
{

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
}
