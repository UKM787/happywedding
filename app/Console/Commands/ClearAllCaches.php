<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class ClearAllCaches extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cache:clear-all {--optimize : Optimize after clearing}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear all types of cache (Laravel, OPcache, file cache, etc.)';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Starting comprehensive cache clearing...');
        
        // Clear Laravel caches
        $this->clearLaravelCaches();
        
        // Clear file caches manually
        $this->clearFileCaches();
        
        // Clear OPcache
        $this->clearOPCache();
        
        // Clear permission cache
        $this->clearPermissionCache();
        
        // Set proper permissions
        $this->setPermissions();
        
        // Optimize if requested
        if ($this->option('optimize')) {
            $this->optimizeApplication();
        }
        
        $this->info('✅ All caches cleared successfully!');
        $this->newLine();
        $this->warn('Don\'t forget to:');
        $this->line('• Clear browser cache (Ctrl+F5)');
        $this->line('• Clear CDN cache if applicable');
        $this->line('• Clear Hostinger server cache from cPanel');
        
        return 0;
    }
    
    /**
     * Clear Laravel application caches
     */
    private function clearLaravelCaches()
    {
        $this->info('Clearing Laravel caches...');
        
        $commands = [
            'cache:clear' => 'Application cache',
            'config:clear' => 'Configuration cache',
            'route:clear' => 'Route cache',
            'view:clear' => 'View cache',
            'clear-compiled' => 'Compiled classes'
        ];
        
        foreach ($commands as $command => $description) {
            try {
                Artisan::call($command);
                $this->line("✓ {$description} cleared");
            } catch (\Exception $e) {
                $this->error("✗ Failed to clear {$description}: " . $e->getMessage());
            }
        }
    }
    
    /**
     * Clear file caches manually
     */
    private function clearFileCaches()
    {
        $this->info('Clearing file caches manually...');
        
        $cachePaths = [
            storage_path('framework/cache/data'),
            storage_path('framework/views'),
            storage_path('framework/sessions'),
            storage_path('logs'),
            bootstrap_path('cache')
        ];
        
        foreach ($cachePaths as $path) {
            if (File::exists($path)) {
                $files = File::glob($path . '/*');
                foreach ($files as $file) {
                    if (File::isFile($file) && basename($file) !== '.gitignore') {
                        File::delete($file);
                    }
                }
                $this->line("✓ Cleared files in: {$path}");
            }
        }
    }
    
    /**
     * Clear OPcache if available
     */
    private function clearOPCache()
    {
        $this->info('Clearing OPcache...');
        
        if (function_exists('opcache_reset')) {
            opcache_reset();
            $this->line('✓ OPcache cleared');
        } else {
            $this->line('• OPcache not available');
        }
    }
    
    /**
     * Clear permission cache (Spatie)
     */
    private function clearPermissionCache()
    {
        $this->info('Clearing permission cache...');
        
        try {
            if (class_exists('Spatie\Permission\PermissionServiceProvider')) {
                Artisan::call('permission:cache-reset');
                $this->line('✓ Permission cache cleared');
            } else {
                $this->line('• Permission cache not applicable');
            }
        } catch (\Exception $e) {
            $this->error('✗ Failed to clear permission cache: ' . $e->getMessage());
        }
    }
    
    /**
     * Set proper permissions
     */
    private function setPermissions()
    {
        $this->info('Setting proper permissions...');
        
        $paths = [
            storage_path() => '755',
            bootstrap_path('cache') => '755',
            storage_path('logs') => '755'
        ];
        
        foreach ($paths as $path => $permission) {
            if (File::exists($path)) {
                chmod($path, octdec($permission));
                $this->line("✓ Set {$permission} permissions on: {$path}");
            }
        }
    }
    
    /**
     * Optimize application for production
     */
    private function optimizeApplication()
    {
        $this->info('Optimizing application...');
        
        $commands = [
            'config:cache' => 'Configuration',
            'route:cache' => 'Routes',
            'view:cache' => 'Views'
        ];
        
        foreach ($commands as $command => $description) {
            try {
                Artisan::call($command);
                $this->line("✓ {$description} cached");
            } catch (\Exception $e) {
                $this->error("✗ Failed to cache {$description}: " . $e->getMessage());
            }
        }
    }
}
