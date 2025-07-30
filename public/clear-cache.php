<?php
/**
 * Emergency Cache Clearing Script for Hostinger
 * Access via: yourdomain.com/clear-cache.php
 * 
 * SECURITY WARNING: Remove this file after use or add authentication
 */

// Uncomment the line below to add basic authentication
// if (!isset($_GET['secret']) || $_GET['secret'] !== 'your-secret-key-here') die('Unauthorized');

echo "<h1>Cache Clearing Script for Hostinger</h1>";
echo "<pre>";

// Change to Laravel root directory
$laravelRoot = dirname(__DIR__);
chdir($laravelRoot);

echo "Current directory: " . getcwd() . "\n";
echo "Starting cache clearing process...\n\n";

// Function to execute artisan commands
function runArtisanCommand($command) {
    $fullCommand = "php artisan $command 2>&1";
    echo "Running: $fullCommand\n";
    $output = shell_exec($fullCommand);
    echo $output . "\n";
    return $output;
}

// Function to clear file cache manually
function clearFileCache() {
    echo "Manually clearing file cache...\n";
    
    $cachePaths = [
        'storage/framework/cache/data',
        'storage/framework/views',
        'storage/framework/sessions',
        'bootstrap/cache'
    ];
    
    foreach ($cachePaths as $path) {
        if (is_dir($path)) {
            $files = glob($path . '/*');
            foreach ($files as $file) {
                if (is_file($file) && basename($file) !== '.gitignore') {
                    unlink($file);
                    echo "Deleted: $file\n";
                }
            }
        }
    }
}

// 1. Clear Laravel Application Cache
echo "=== CLEARING LARAVEL CACHES ===\n";
runArtisanCommand('cache:clear');
runArtisanCommand('config:clear');
runArtisanCommand('route:clear');
runArtisanCommand('view:clear');
runArtisanCommand('clear-compiled');

// 2. Clear Permission Cache (Spatie)
echo "\n=== CLEARING PERMISSION CACHE ===\n";
runArtisanCommand('permission:cache-reset');

// 3. Manual file cache clearing
echo "\n=== MANUAL FILE CACHE CLEARING ===\n";
clearFileCache();

// 4. Clear OPcache if available
echo "\n=== CLEARING OPCACHE ===\n";
if (function_exists('opcache_reset')) {
    opcache_reset();
    echo "OPcache cleared successfully\n";
} else {
    echo "OPcache not available\n";
}

// 5. Set proper permissions
echo "\n=== SETTING PERMISSIONS ===\n";
$permissionCommands = [
    'chmod -R 755 bootstrap/cache',
    'chmod -R 755 storage',
    'chmod -R 644 storage/logs'
];

foreach ($permissionCommands as $cmd) {
    echo "Running: $cmd\n";
    shell_exec($cmd . ' 2>&1');
}

// 6. Optimize for production (optional)
if (isset($_GET['optimize']) && $_GET['optimize'] === 'true') {
    echo "\n=== OPTIMIZING FOR PRODUCTION ===\n";
    runArtisanCommand('config:cache');
    runArtisanCommand('route:cache');
    runArtisanCommand('view:cache');
}

echo "\n=== CACHE CLEARING COMPLETED ===\n";
echo "All caches have been cleared!\n";
echo "Remember to:\n";
echo "1. Clear your browser cache (Ctrl+F5)\n";
echo "2. Clear CDN cache if you're using one\n";
echo "3. Clear Hostinger's server cache from cPanel\n";
echo "4. Remove this file for security\n";

echo "</pre>";

// Display additional information
echo "<h2>Additional Cache Clearing Options</h2>";
echo "<ul>";
echo "<li><a href='?optimize=true'>Run with Production Optimization</a></li>";
echo "<li><a href='javascript:location.reload()'>Refresh Page</a></li>";
echo "</ul>";

echo "<h2>Browser Cache Clearing Instructions</h2>";
echo "<ul>";
echo "<li><strong>Chrome/Firefox:</strong> Ctrl+Shift+R or Ctrl+F5</li>";
echo "<li><strong>Safari:</strong> Cmd+Shift+R</li>";
echo "<li><strong>Mobile:</strong> Clear browser data in settings</li>";
echo "</ul>";

echo "<h2>Hostinger Specific Cache Clearing</h2>";
echo "<ol>";
echo "<li>Login to Hostinger cPanel</li>";
echo "<li>Go to 'Advanced' → 'Optimize Website'</li>";
echo "<li>Clear 'Cache Manager' if available</li>";
echo "<li>Check 'LiteSpeed Cache' settings</li>";
echo "</ol>";
?>
