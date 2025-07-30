<?php

namespace App\Helpers;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ImageHelper
{
    /**
     * Normalize image path for storage
     *
     * @param string $path
     * @return string
     */
    public static function normalizePath($path)
    {
        if (!$path) {
            return '';
        }
        
        // Remove leading backslash
        if (strpos($path, '\\') === 0) {
            $path = substr($path, 1);
        }
        
        // Convert backslashes to forward slashes
        $path = str_replace('\\', '/', $path);
        
        // Remove leading slash
        $path = ltrim($path, '/');
        
        return $path;
    }
    
    /**
     * Get public URL for an image
     *
     * @param string $path
     * @param string $defaultImage
     * @return string
     */
    public static function getPublicUrl($path, $defaultImage = null)
    {
        if (!$path) {
            return $defaultImage ? asset($defaultImage) : '';
        }
        
        $path = self::normalizePath($path);
        
        // Check if path is already a full URL
        if (strpos($path, 'http://') === 0 || strpos($path, 'https://') === 0) {
            return $path;
        }
        
        // Check if the path is for a local file
        if (file_exists(public_path($path))) {
            return asset($path);
        }
        
        // Check if the path is in storage
        if (file_exists(public_path('storage/' . $path))) {
            return asset('storage/' . $path);
        }
        
        // If we can't find the image, return the default
        return $defaultImage ? asset($defaultImage) : asset($path);
    }
    
    /**
     * Upload an image and return the path
     *
     * @param UploadedFile $file
     * @param string $directory
     * @param string $prefix
     * @param string $defaultImage
     * @return string
     */
    public static function uploadImage($file, $directory, $prefix = '', $defaultImage = null)
    {
        if (!$file) {
            return $defaultImage;
        }
        
        try {
            // Ensure directory exists
            $fullPath = public_path($directory);
            if (!file_exists($fullPath)) {
                mkdir($fullPath, 0755, true);
            }
            
            // Generate a unique filename
            $filename = ($prefix ? $prefix . '-' : '') . Str::random(10) . '-' . time() . '.' . $file->getClientOriginalExtension();
            
            // Move the file
            $file->move($fullPath, $filename);
            
            // Log the upload
            Log::info('Image uploaded', [
                'original_name' => $file->getClientOriginalName(),
                'path' => $directory . '/' . $filename,
                'exists' => file_exists($fullPath . '/' . $filename)
            ]);
            
            // Return the path with forward slashes
            return str_replace('\\', '/', $directory . '/' . $filename);
            
        } catch (\Exception $e) {
            Log::error('Image upload failed', [
                'error' => $e->getMessage(),
                'file' => $file->getClientOriginalName()
            ]);
            
            return $defaultImage;
        }
    }
}

