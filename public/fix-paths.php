<?php
// This script fixes image paths in the database for Hostinger

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
$result = $db->query("SELECT id, imageOne FROM savedates");

echo "<h1>Fixing Savedate Image Paths</h1>";
echo "<table border='1'>";
echo "<tr><th>ID</th><th>Original Path</th><th>Fixed Path</th><th>Status</th></tr>";

while ($row = $result->fetch_assoc()) {
    $id = $row['id'];
    $originalPath = $row['imageOne'];
    
    // Fix path
    $fixedPath = $originalPath;
    
    // 1. Remove leading backslash
    if (strpos($fixedPath, '\\') === 0) {
        $fixedPath = substr($fixedPath, 1);
    }
    
    // 2. Convert backslashes to forward slashes
    $fixedPath = str_replace('\\', '/', $fixedPath);
    
    // 3. Update in database if changed
    if ($fixedPath !== $originalPath) {
        $stmt = $db->prepare("UPDATE savedates SET imageOne = ? WHERE id = ?");
        $stmt->bind_param("si", $fixedPath, $id);
        $result = $stmt->execute();
        $status = $result ? "Updated" : "Failed: " . $stmt->error;
        $stmt->close();
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

$db->close();
?>
