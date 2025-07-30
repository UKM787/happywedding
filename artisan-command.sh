#!/bin/bash

# Complete Cache Clearing Script for Hostinger
echo "Starting comprehensive cache clearing..."

# 1. Clear Laravel Application Cache
echo "Clearing Laravel application cache..."
php artisan cache:clear

# 2. Clear Configuration Cache
echo "Clearing configuration cache..."
php artisan config:clear

# 3. Clear Route Cache
echo "Clearing route cache..."
php artisan route:clear

# 4. Clear View Cache
echo "Clearing view cache..."
php artisan view:clear

# 5. Clear Compiled Classes
echo "Clearing compiled classes..."
php artisan clear-compiled

# 6. Clear Permission Cache (Spatie)
echo "Clearing permission cache..."
php artisan permission:cache-reset

# 7. Optimize for Production
echo "Optimizing for production..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 8. Storage Link (if needed)
echo "Creating storage link..."
php artisan storage:link

# 9. Set proper permissions
echo "Setting proper permissions..."
chmod -R 755 bootstrap/cache
chmod -R 755 storage

echo "Cache clearing completed!"
echo "Don't forget to clear browser cache and CDN cache if applicable."