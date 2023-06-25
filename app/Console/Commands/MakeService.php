<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeService extends Command
{
    protected $signature = 'make:service {name}';

    protected $description = 'Create a new service class';

    public function handle()
    {
        $name = $this->argument('name');

        $servicePath = app_path("Services/{$name}.php");

        if (File::exists($servicePath)) {
            $this->error("{$name} service already exists!");
            return;
        }

        File::put($servicePath, $this->buildClass($name));

        $this->info("{$name} service created successfully.");
    }

    protected function buildClass($name)
    {
        $stub = File::get(base_path('stubs/service.stub'));

        return str_replace('{{ name }}', $name, $stub);
    }
}
