<?php
// Enable error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Connect to database using Laravel's .env settings
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
$stmt = $db->query("SELECT id, imageOne, invitation_id FROM savedates");
$savedates = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html>
<head>
    <title>Image Path Checker</title>
    <style>
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .success { color: green; }
        .error { color: red; }
        img { max-width: 200px; max-height: 200px; }
    </style>
</head>
<body>
    <h1>Image Path Checker</h1>
    
    <h2>Server Information</h2>
    <ul>
        <li>Document Root: <?php echo $_SERVER['DOCUMENT_ROOT']; ?></li>
        <li>PHP Version: <?php echo phpversion(); ?></li>
    </ul>
    
    <h2>Savedate Images</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Invitation ID</th>
            <th>Original Path</th>
            <th>Normalized Path</th>
            <th>File Exists?</th>
            <th>Storage Path Exists?</th>
            <th>Image Preview</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($savedates as $savedate): ?>
            <?php
            $originalPath = $savedate['imageOne'];
            $normalizedPath = str_replace('\\', '/', $originalPath);
            $normalizedPath = ltrim($normalizedPath, '/');
            
            $fileExists = file_exists(public_path($normalizedPath));
            $storageFileExists = file_exists(public_path('storage/' . $normalizedPath));
            
            function public_path($path) {
                return $_SERVER['DOCUMENT_ROOT'] . '/' . $path;
            }
            ?>
            <tr>
                <td><?php echo $savedate['id']; ?></td>
                <td><?php echo $savedate['invitation_id']; ?></td>
                <td><?php echo $originalPath; ?></td>
                <td><?php echo $normalizedPath; ?></td>
                <td class="<?php echo $fileExists ? 'success' : 'error'; ?>">
                    <?php echo $fileExists ? 'Yes' : 'No'; ?>
                </td>
                <td class="<?php echo $storageFileExists ? 'success' : 'error'; ?>">
                    <?php echo $storageFileExists ? 'Yes' : 'No'; ?>
                </td>
                <td>
                    <!-- Try multiple paths -->
                    <img src="/<?php echo $normalizedPath; ?>" 
                         onerror="this.onerror=null; this.src='/storage/<?php echo $normalizedPath; ?>'"
                         alt="Image not found">
                </td>
                <td>
                    <button onclick="fixPath(<?php echo $savedate['id']; ?>, '<?php echo $normalizedPath; ?>')">Fix Path</button>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    
    <script>
        function fixPath(id, path) {
            // This would need a server-side endpoint to update the path
            alert('This would fix the path for ID ' + id + ' to: ' + path);
        }
    </script>
</body>
</html>
