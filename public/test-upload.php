<?php
// Enable error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['test_image'])) {
    $file = $_FILES['test_image'];
    
    echo "<h2>Upload Information</h2>";
    echo "<pre>";
    print_r($file);
    echo "</pre>";
    
    // Check for upload errors
    if ($file['error'] !== UPLOAD_ERR_OK) {
        $errors = [
            UPLOAD_ERR_INI_SIZE => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
            UPLOAD_ERR_FORM_SIZE => 'The uploaded file exceeds the MAX_FILE_SIZE directive in the HTML form',
            UPLOAD_ERR_PARTIAL => 'The uploaded file was only partially uploaded',
            UPLOAD_ERR_NO_FILE => 'No file was uploaded',
            UPLOAD_ERR_NO_TMP_DIR => 'Missing a temporary folder',
            UPLOAD_ERR_CANT_WRITE => 'Failed to write file to disk',
            UPLOAD_ERR_EXTENSION => 'A PHP extension stopped the file upload'
        ];
        
        echo "<p>Error: " . ($errors[$file['error']] ?? 'Unknown error') . "</p>";
    } else {
        // Try to upload to the Uploads directory
        $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/Uploads';
        
        // Create directory if it doesn't exist
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }
        
        // Generate a unique filename
        $filename = 'test_' . time() . '.' . pathinfo($file['name'], PATHINFO_EXTENSION);
        $destination = $uploadDir . '/' . $filename;
        
        // Try to move the uploaded file
        $success = move_uploaded_file($file['tmp_name'], $destination);
        
        if ($success) {
            echo "<h2>Upload Successful!</h2>";
            echo "<p>File uploaded to: {$destination}</p>";
            echo "<p>File URL: /Uploads/{$filename}</p>";
            echo "<p>Image preview:</p>";
            echo "<img src='/Uploads/{$filename}' style='max-width:300px;'>";
            
            // Check if the file is accessible via URL
            echo "<h3>URL Access Check</h3>";
            $urls = [
                "/Uploads/{$filename}",
                "/uploads/{$filename}",
                "/storage/Uploads/{$filename}"
            ];
            
            echo "<ul>";
            foreach ($urls as $url) {
                $fullUrl = 'http://' . $_SERVER['HTTP_HOST'] . $url;
                $headers = @get_headers($fullUrl);
                $accessible = $headers && strpos($headers[0], '200') !== false;
                
                echo "<li>{$url}: " . ($accessible ? "✅ Accessible" : "❌ Not accessible") . "</li>";
            }
            echo "</ul>";
        } else {
            echo "<h2>Upload Failed</h2>";
            echo "<p>Failed to move uploaded file to {$destination}</p>";
            
            // Check directory permissions
            echo "<h3>Directory Permissions</h3>";
            echo "<p>Upload directory: {$uploadDir}</p>";
            echo "<p>Permissions: " . substr(sprintf('%o', fileperms($uploadDir)), -4) . "</p>";
            echo "<p>Is writable: " . (is_writable($uploadDir) ? "Yes" : "No") . "</p>";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Image Upload Test</title>
</head>
<body>
    <h1>Image Upload Test</h1>
    
    <form method="POST" enctype="multipart/form-data">
        <div>
            <label for="test_image">Select an image to upload:</label>
            <input type="file" name="test_image" id="test_image" accept="image/*">
        </div>
        <div style="margin-top: 10px;">
            <button type="submit">Upload Test Image</button>
        </div>
    </form>
    
    <h2>Server Information</h2>
    <ul>
        <li>Document Root: <?php echo $_SERVER['DOCUMENT_ROOT']; ?></li>
        <li>PHP Version: <?php echo phpversion(); ?></li>
        <li>upload_max_filesize: <?php echo ini_get('upload_max_filesize'); ?></li>
        <li>post_max_size: <?php echo ini_get('post_max_size'); ?></li>
    </ul>
    
    <h2>Directory Permissions</h2>
    <ul>
        <?php
        $checkDirs = [
            $_SERVER['DOCUMENT_ROOT'] . '/uploads',
            $_SERVER['DOCUMENT_ROOT'] . '/storage',
            $_SERVER['DOCUMENT_ROOT'] . '/storage/uploads',
            dirname($_SERVER['DOCUMENT_ROOT']) . '/storage/app/public',
            dirname($_SERVER['DOCUMENT_ROOT']) . '/storage/app/public/uploads'
        ];
        
        foreach ($checkDirs as $dir) {
            if (file_exists($dir)) {
                $perms = substr(sprintf('%o', fileperms($dir)), -4);
                echo "<li>{$dir}: Exists, Permissions: {$perms}</li>";
            } else {
                echo "<li>{$dir}: Does not exist</li>";
            }
        }
        ?>
    </ul>
</body>
</html>

