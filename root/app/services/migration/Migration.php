<?php

namespace Root\App\Services\Migration;

use Exception;
use Root\App\Services\Migration\MigrationManager;

class Migration extends MigrationManager
{

    public function migrate($payload)
    {
        $tagetFileName = array_shift($payload);
        return $this->executeMigration($tagetFileName);
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
