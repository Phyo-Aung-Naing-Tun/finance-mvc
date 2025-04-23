<?php

namespace Root\App\Services\Migration;

class MigrationBuilder
{
    private string $migrationName;
    private string $tableName;

    public function setMigrationName(array $data): self
    {
        foreach ($data as $item) {
            if (str_starts_with($item, 'name=')) {
                $name = explode('=', $item)[1] ?? null;
                if ($name) {
                    $timestamp = date("Y_m_d_His");
                    $this->migrationName = "{$timestamp}_{$name}.php";
                }
                break;
            }
        }
        return $this;
    }

    public function setTableName(array $data): self
    {
        foreach ($data as $item) {
            if (str_starts_with($item, 'table=')) {
                $this->tableName = explode('=', $item)[1] ?? '';
                break;
            }
        }
        return $this;
    }

    public function build(): void
    {
        if (empty($this->migrationName)) {
            echo "\n❌ Migration name is required: use name=?\n";
            return;
        }

        if (empty($this->tableName)) {
            echo "\n❌ Table name is required: use table=?\n";
            return;
        }

        $stub = <<<PHP
<?php
use Root\App\Services\Migration\Blueprint;
use Root\App\Services\Migration\Schema;
use Root\App\Services\Migration\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
         Schema::create('$this->tableName', function (Blueprint \$table) {
             \$table->id();
             \$table->timestamps();
         });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         Schema::dropIfExists('$this->tableName');
    }
};
PHP;

        $filePath = __DIR__ . "/../../../../database/{$this->migrationName}";
        file_put_contents($filePath, $stub);

        echo "\n✅ Migration created: {$this->migrationName}\n";
    }
}
