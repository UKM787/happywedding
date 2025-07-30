<?php
// This script helps diagnose file path issues on Hostinger

// Enable error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Connect to database
$db = new mysqli(
    $_ENV['DB_HOST'] ?? 'localhost',
    $_ENV['DB_USERNAME'] ?? 'your_db_username',
    $_ENV['DB_PASSWORD'] ?? 'your_db_password',
    $_ENV['DB_DATABASE'] ?? 'your_db_name'
);

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

// Get all savedates
$result = $db->query("SELECT id, imageOne, invitation_id FROM savedates");

echo "<h1>Checking Savedate Image Paths</h1>";
echo "<table border='1'>";
echo "<tr><th>ID</th><th>Image Path</th><th>Normalized Path</th><th>File Exists?</th><th>Image</th></tr>";

while ($row = $result->fetch_assoc()) {
    $id = $row['id'];
    $path = $row['imageOne'];
    
    // Normalize path
    $normalizedPath = $path;
    if (strpos($normalizedPath, '\\') === 0) {
        $normalizedPath = substr($normalizedPath, 1);
    }
    $normalizedPath = str_replace('\\', '/', $normalizedPath);
    
    // Check if file exists
    $fullPath = $_SERVER['DOCUMENT_ROOT'] . '/storage/' . $normalizedPath;
    $exists = file_exists($fullPath);
    
    // Check alternative paths
    $altPaths = [
        $_SERVER['DOCUMENT_ROOT'] . '/' . $normalizedPath,
        $_SERVER['DOCUMENT_ROOT'] . '/public/storage/' . $normalizedPath,
        $_SERVER['DOCUMENT_ROOT'] . '/storage/app/public/' . $normalizedPath
    ];
    
    foreach ($altPaths as $altPath) {
        if (file_exists($altPath)) {
            $fullPath = $altPath;
            $exists = true;
            break;
        }
    }
    
    echo "<tr>";
    echo "<td>{$id}</td>";
    echo "<td>{$path}</td>";
    echo "<td>{$normalizedPath}</td>";
    echo "<td>" . ($exists ? "Yes" : "No") . "</td>";
    echo "<td><img src='/storage/{$normalizedPath}' style='max-width:100px;' onerror=\"this.src='/assets/savedate/savedateupload.png'; this.style.border='1px solid red';\"></td>";
    echo "</tr>";
}

echo "</table>";

// Check storage symlink
echo "<h2>Storage Symlink Check</h2>";
$publicStorage = $_SERVER['DOCUMENT_ROOT'] . '/storage';
if (is_link($publicStorage)) {
    echo "Storage symlink exists and points to: " . readlink($publicStorage);
} else if (is_dir($publicStorage)) {
    echo "Storage directory exists but is not a symlink";
} else {
    echo "Storage symlink does not exist";
}

// Check directory structure
echo "<h2>Directory Structure</h2>";
$directories = [
    '/storage',
    '/storage/app',
    '/storage/app/public',
    '/storage/app/public/Uploads',
    '/storage/app/public/uploads',
    '/Uploads',
    '/uploads'
];

echo "<ul>";
foreach ($directories as $dir) {
    $fullDir = $_SERVER['DOCUMENT_ROOT'] . $dir;
    echo "<li>{$dir}: " . (is_dir($fullDir) ? "Exists" : "Does not exist") . "</li>";
}
echo "</ul>";

$db->close();
?>
