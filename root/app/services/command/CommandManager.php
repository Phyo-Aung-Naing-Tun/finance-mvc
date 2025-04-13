<?php

namespace  Root\App\Services\Command;

use Root\App\Services\Migration\Migration;

class CommandManager
{
    private $command;
    private $payload;
    private $migration;
    public function __construct($data)
    {
        $this->command = $data[1];
        array_splice($data, 0, 2);
        $this->payload = $data;
        $this->migration = new Migration();
    }

    public function execute()
    {
        switch ($this->command) {
            case 'serve':
                echo "Starting development server at http://localhost:8000\n";
                exec('php -S localhost:8000');

                break;

            case 'tailwind:serve':
                echo "Starting tailwind css \n";
                exec('npx @tailwindcss/cli -i ./resource/css/input.css -o ./resource/css/output.css --watch');
                break;

            case "migrate":

                $this->migration->migrate();
                break;

            case "migrate:fresh":
                $this->migration->migrateFresh();
                break;

            case "make:migration":
                $this->migration->createMigrateFile($this->payload);
                break;

            default:
                echo "Unknown command: $this->command\n";
                exit(1);
        }
    }
}
