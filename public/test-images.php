<!DOCTYPE html>
<html>
<head>
    <title>Image Test Page</title>
    <style>
        .image-test {
            border: 1px solid #ccc;
            padding: 10px;
            margin: 10px;
            display: inline-block;
        }
        .image-test img {
            max-width: 200px;
            max-height: 200px;
            display: block;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <h1>Image Test Page</h1>
    
    <?php
    try {
        require_once dirname($_SERVER['DOCUMENT_ROOT']) . '/vendor/autoload.php';
        $app = require_once dirname($_SERVER['DOCUMENT_ROOT']) . '/bootstrap/app.php';
        $app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();
        
        // Get a few savedates
        $savedates = DB::table('savedates')->take(5)->get();
        
        foreach ($savedates as $savedate) {
            $path = $savedate->imageOne;
            
            // Normalize path
            if (strpos($path, '\\') === 0) {
                $path = substr($path, 1);
            }
            $path = str_replace('\\', '/', $path);
            
            echo "<div class='image-test'>";
            echo "<h3>ID: {$savedate->id}</h3>";
            echo "<p>Path: {$path}</p>";
            
            // Test with storage prefix
            echo "<h4>With /storage/ prefix:</h4>";
            echo "<img src='/storage/{$path}' onerror=\"this.style.border='1px solid red'; this.alt='Failed to load'\">";
            
            // Test without storage prefix
            echo "<h4>Without /storage/ prefix:</h4>";
            echo "<img src='/{$path}' onerror=\"this.style.border='1px solid red'; this.alt='Failed to load'\">";
            
            echo "</div>";
        }
        
    } catch (Exception $e) {
        echo "<h2>Error</h2>";
        echo "<p>{$e->getMessage()}</p>";
    }
    ?>
</body>
</html>
