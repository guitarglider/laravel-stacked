<?php

namespace Acme\Stacked\Console;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Artisan;

class InstallCommand extends Command
{
    protected $signature = 'stacked:install {--force : Overwrite existing files}';
    protected $description = 'Install Breeze (Blade) and publish <x-layouts.app> with clean stacked header + auth views + dashboard';

    public function handle(): int
    {
        $fs = new Filesystem();
        $this->info('Installing Breeze + Stacked component layout...');

        // Breeze (Blade)
        $this->components->task('Scaffolding Breeze (Blade)', function () {
            Artisan::call('breeze:install', ['stack' => 'blade']);
        });

        // Copy views (component layout + auth overrides + welcome + dashboard)
        $this->copyDirectory($fs, __DIR__.'/../../stubs/resources/views', resource_path('views'));

        // Public logo
        $this->copyFile(__DIR__.'/../../stubs/public/logo.svg', public_path('logo.svg'));

        $this->newLine();
        $this->components->info('Done! Now run: npm install && npm run dev, then php artisan migrate');
        return self::SUCCESS;
    }

    protected function copyDirectory(Filesystem $fs, string $from, string $to): void
    {
        if ($this->option('force')) {
            $fs->deleteDirectory($to);
        }
        $fs->ensureDirectoryExists($to);
        $fs->copyDirectory($from, $to);
    }

    protected function copyFile(string $from, string $to): void
    {
        $dir = dirname($to);
        if (! is_dir($dir)) {
            mkdir($dir, 0755, true);
        }
        copy($from, $to);
    }
}
