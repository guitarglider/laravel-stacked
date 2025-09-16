<?php

namespace Acme\\Stacked\\Console;

use Illuminate\\Console\\Command;
use Illuminate\\Filesystem\\Filesystem;
use Illuminate\\Support\\Facades\\Artisan;

class InstallCommand extends Command
{
    protected $signature = 'stacked:install {--force : Overwrite existing files}';
    protected $description = 'Install Breeze auth and the Stacked layout (Blade + Tailwind + DaisyUI)';

    public function handle(): int
    {
        $fs = new Filesystem();
        $this->info('Installing Auth (Breeze) + Stacked layout...');

        // Breeze installieren
        $this->components->task('Scaffolding Breeze (Blade)', function () {
            Artisan::call('breeze:install', ['stack' => 'blade']);
        });

        // Layout Views kopieren
        $this->copyDirectory(
            $fs,
            __DIR__.'/../../stubs/resources/views',
            resource_path('views')
        );

        // Tailwind Config kopieren
        $this->copyFile(
            __DIR__.'/../../stubs/tailwind.config.js',
            base_path('tailwind.config.js')
        );

        // CSS Stub anlegen
        $cssTarget = resource_path('css/app.css');
        if (! $fs->exists($cssTarget)) {
            $this->copyFile(
                __DIR__.'/../../stubs/resources.css.stub',
                $cssTarget
            );
        }

        $this->newLine();
        $this->components->info('Done! Breeze auth + Stacked layout installed.');
        $this->line('Next steps:');
        $this->line('  • composer dump-autoload (falls benötigt)');
        $this->line('  • npm i && npm run dev');
        $this->line('  • php artisan migrate');
        $this->line('  • Öffne /register oder /login');

        return self::SUCCESS;
    }

    protected function copyDirectory(Filesystem $fs, string $from, string $to): void
    {
        if ($this->option('force')) {
            $fs->deleteDirectory($to);
        }
        $fs->ensureDirectoryExists($to);
        $fs->copyDirectory($from, $to);
        $this->components->info("Copied directory: {$from} -> {$to}");
    }

    protected function copyFile(string $from, string $to): void
    {
        $dir = dirname($to);
        if (! is_dir($dir)) {
            mkdir($dir, 0755, true);
        }
        if (file_exists($to) && ! $this->option('force')) {
            $this->components->warn("Skip existing: {$to} (use --force to overwrite)");
            return;
        }
        copy($from, $to);
        $this->components->info("Copied file: {$from} -> {$to}");
    }
}
