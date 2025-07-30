<?php
// This script fixes image paths in the database

// Enable error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Connect to database
$db_host = getenv('DB_HOST') ?: 'localhost';
$db_database = getenv('DB_DATABASE') ?: 'your_database';
$db_username = getenv('DB_USERNAME') ?: 'root';
$db_password = getenv('DB_PASSWORD') ?: '';

try {
    $db = new PDO("mysql:host=$db_host;dbname=$db_database", $db_username, $db_password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Get all savedates
$stmt = $db->query("SELECT id, imageOne FROM savedates");
$savedates = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo "<h1>Fixing Image Paths</h1>";
echo "<table border='1' style='border-collapse: collapse;'>";
echo "<tr><th>ID</th><th>Original Path</th><th>Fixed Path</th><th>Status</th></tr>";

$updateCount = 0;
$errorCount = 0;

foreach ($savedates as $savedate) {
    $id = $savedate['id'];
    $originalPath = $savedate['imageOne'];
    
    // Skip if path is empty
    if (empty($originalPath)) {
        echo "<tr>";
        echo "<td>{$id}</td>";
        echo "<td><em>Empty</em></td>";
        echo "<td><em>Empty</em></td>";
        echo "<td>Skipped</td>";
        echo "</tr>";
        continue;
    }
    
    // Fix path
    $fixedPath = $originalPath;
    
    // 1. Remove leading backslash
    if (strpos($fixedPath, '\\') === 0) {
        $fixedPath = substr($fixedPath, 1);
    }
    
    // 2. Convert backslashes to forward slashes
    $fixedPath = str_replace('\\', '/', $fixedPath);
    
    // 3. Remove leading slash
    $fixedPath = ltrim($fixedPath, '/');
    
    // 4. Check if path starts with 'Uploads' (case sensitive)
    if (strpos($fixedPath, 'Uploads/') === 0) {
        // Path is already correct
    } 
    // 5. Check if path starts with 'uploads' (lowercase)
    else if (strpos(strtolower($fixedPath), 'uploads/') === 0) {
        // Fix case sensitivity
        $fixedPath = 'Uploads/' . substr($fixedPath, 8);
    }
    
    // 6. Update in database if changed
    if ($fixedPath !== $originalPath) {
        try {
            $updateStmt = $db->prepare("UPDATE savedates SET imageOne = ? WHERE id = ?");
            $updateStmt->execute([$fixedPath, $id]);
            $status = "Updated";
            $updateCount++;
        } catch (Exception $e) {
            $status = "Error: " . $e->getMessage();
            $errorCount++;
        }
    } else {
        $status = "No change needed";
    }
    
    echo "<tr>";
    echo "<td>{$id}</td>";
    echo "<td>{$originalPath}</td>";
    echo "<td>{$fixedPath}</td>";
    echo "<td>{$status}</td>";
    echo "</tr>";
}

echo "</table>";
echo "<p>Summary: {$updateCount} paths updated, {$errorCount} errors</p>";

// Create Uploads directory if it doesn't exist
$uploadsDir = $_SERVER['DOCUMENT_ROOT'] . '/Uploads';
if (!file_exists($uploadsDir)) {
    $created = @mkdir($uploadsDir, 0755, true);
    echo "<p>Uploads directory: " . ($created ? "Created successfully" : "Failed to create") . "</p>";
}

// Create storage link if it doesn't exist
$storageLink = $_SERVER['DOCUMENT_ROOT'] . '/storage';
$storageTarget = dirname($_SERVER['DOCUMENT_ROOT']) . '/storage/app/public';

if (!file_exists($storageLink)) {
    // Try to create symlink
    $success = @symlink($storageTarget, $storageLink);
}
?>


