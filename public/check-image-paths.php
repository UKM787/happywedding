<?php
// Enable error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Function to check if file exists in multiple locations
function checkFilePaths($relativePath) {
    $paths = [
        // Direct path
        $_SERVER['DOCUMENT_ROOT'] . '/' . $relativePath,
        
        // Storage path
        $_SERVER['DOCUMENT_ROOT'] . '/storage/' . $relativePath,
        
        // Public storage path
        $_SERVER['DOCUMENT_ROOT'] . '/public/storage/' . $relativePath,
        
        // Laravel storage path
        dirname($_SERVER['DOCUMENT_ROOT']) . '/storage/app/public/' . $relativePath,
        
        // Uploads directory
        $_SERVER['DOCUMENT_ROOT'] . '/uploads/' . ltrim(strstr($relativePath, '/'), '/'),
        
        // Lowercase path (for case-sensitive systems)
        $_SERVER['DOCUMENT_ROOT'] . '/' . strtolower($relativePath),
    ];
    
    $results = [];
    foreach ($paths as $path) {
        $exists = file_exists($path);
        $results[] = [
            'path' => $path,
            'exists' => $exists,
            'readable' => $exists ? is_readable($path) : false,
            'size' => $exists ? filesize($path) : 0
        ];
    }
    
    return $results;
}

// Connect to database
try {
    require_once dirname($_SERVER['DOCUMENT_ROOT']) . '/vendor/autoload.php';
    $app = require_once dirname($_SERVER['DOCUMENT_ROOT']) . '/bootstrap/app.php';
    $app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();
    
    $savedates = DB::table('savedates')->get();
    
    echo "<h1>Image Path Diagnostic</h1>";
    
    // Check storage link
    $storageLink = $_SERVER['DOCUMENT_ROOT'] . '/storage';
    echo "<h2>Storage Link Check</h2>";
    if (is_link($storageLink)) {
        echo "<p>Storage link exists and points to: " . readlink($storageLink) . "</p>";
    } elseif (is_dir($storageLink)) {
        echo "<p>Storage directory exists but is not a symbolic link</p>";
    } else {
        echo "<p>Storage link does not exist</p>";
    }
    
    // Check directory permissions
    echo "<h2>Directory Permissions</h2>";
    $directories = [
        $_SERVER['DOCUMENT_ROOT'],
        $_SERVER['DOCUMENT_ROOT'] . '/storage',
        dirname($_SERVER['DOCUMENT_ROOT']) . '/storage/app/public',
        $_SERVER['DOCUMENT_ROOT'] . '/uploads'
    ];
    
    echo "<ul>";
    foreach ($directories as $dir) {
        if (file_exists($dir)) {
            $perms = substr(sprintf('%o', fileperms($dir)), -4);
            echo "<li>{$dir}: Exists, Permissions: {$perms}</li>";
        } else {
            echo "<li>{$dir}: Does not exist</li>";
        }
    }
    echo "</ul>";
    
    // Check savedate images
    echo "<h2>Savedate Images</h2>";
    echo "<table border='1' style='border-collapse: collapse;'>";
    echo "<tr><th>ID</th><th>Image Path</th><th>Path Check Results</th></tr>";
    
    foreach ($savedates as $savedate) {
        echo "<tr>";
        echo "<td>{$savedate->id}</td>";
        echo "<td>{$savedate->imageOne}</td>";
        echo "<td>";
        
        // Normalize path
        $path = $savedate->imageOne;
        if (strpos($path, '\\') === 0) {
            $path = substr($path, 1);
        }
        $path = str_replace('\\', '/', $path);
        
        $results = checkFilePaths($path);
        echo "<ul>";
        foreach ($results as $result) {
            $status = $result['exists'] ? "✅ EXISTS" : "❌ NOT FOUND";
            echo "<li>{$result['path']}: {$status}</li>";
        }
        echo "</ul>";
        
        echo "</td>";
        echo "</tr>";
    }
    
    echo "</table>";
    
} catch (Exception $e) {
    echo "<h1>Error</h1>";
    echo "<p>{$e->getMessage()}</p>";
}
?>
