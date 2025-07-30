#!/bin/bash

# Hostinger Deployment and Cache Clearing Script
# Run this script after uploading files to Hostinger

echo "🚀 Starting Hostinger deployment process..."

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# Function to print colored output
print_status() {
    echo -e "${GREEN}✓${NC} $1"
}

print_warning() {
    echo -e "${YELLOW}⚠${NC} $1"
}

print_error() {
    echo -e "${RED}✗${NC} $1"
}

# Check if we're in the right directory
if [ ! -f "artisan" ]; then
    print_error "artisan file not found. Make sure you're in the Laravel root directory."
    exit 1
fi

print_status "Found Laravel installation"

# 1. Set proper permissions
echo "📁 Setting proper permissions..."
chmod -R 755 bootstrap/cache
chmod -R 755 storage
chmod -R 644 storage/logs
chmod 644 .env
print_status "Permissions set"

# 2. Install/Update Composer dependencies
echo "📦 Installing Composer dependencies..."
if command -v composer &> /dev/null; then
    composer install --optimize-autoloader --no-dev
    print_status "Composer dependencies installed"
else
    print_warning "Composer not found. Please install dependencies manually."
fi

# 3. Clear all caches
echo "🧹 Clearing all caches..."

# Laravel caches
php artisan cache:clear
print_status "Application cache cleared"

php artisan config:clear
print_status "Configuration cache cleared"

php artisan route:clear
print_status "Route cache cleared"

php artisan view:clear
print_status "View cache cleared"

php artisan clear-compiled
print_status "Compiled classes cleared"

# Permission cache (if Spatie package is installed)
php artisan permission:cache-reset 2>/dev/null && print_status "Permission cache cleared" || print_warning "Permission cache not applicable"

# 4. Manual file cache clearing
echo "🗂️ Clearing file caches manually..."
find storage/framework/cache/data -name "*.php" -type f -delete 2>/dev/null
find storage/framework/views -name "*.php" -type f -delete 2>/dev/null
find storage/framework/sessions -name "*" -type f ! -name ".gitignore" -delete 2>/dev/null
find bootstrap/cache -name "*.php" -type f -delete 2>/dev/null
print_status "File caches cleared"

# 5. Optimize for production
echo "⚡ Optimizing for production..."
php artisan config:cache
print_status "Configuration cached"

php artisan route:cache
print_status "Routes cached"

php artisan view:cache
print_status "Views cached"

# 6. Create storage link if needed
if [ ! -L "public/storage" ]; then
    php artisan storage:link
    print_status "Storage link created"
else
    print_status "Storage link already exists"
fi

# 7. Run migrations (optional - uncomment if needed)
# echo "🗄️ Running migrations..."
# php artisan migrate --force
# print_status "Migrations completed"

# 8. Clear OPcache (if available)
echo "🔄 Attempting to clear OPcache..."
php -r "if (function_exists('opcache_reset')) { opcache_reset(); echo 'OPcache cleared\n'; } else { echo 'OPcache not available\n'; }"

echo ""
echo "🎉 Deployment completed successfully!"
echo ""
print_warning "Additional steps for Hostinger:"
echo "1. Clear browser cache (Ctrl+F5)"
echo "2. Login to Hostinger cPanel"
echo "3. Go to 'Advanced' → 'Optimize Website'"
echo "4. Clear 'Cache Manager' if available"
echo "5. Check 'LiteSpeed Cache' settings"
echo "6. If using Cloudflare, purge CDN cache"
echo ""
print_warning "Security reminder:"
echo "• Remove public/clear-cache.php after use"
echo "• Change secret keys in cache clearing routes"
echo "• Consider adding .htaccess protection for sensitive files"
echo ""
echo "🔗 Test your application:"
echo "• Visit your website to ensure it's working"
echo "• Check for any 500 errors in error logs"
echo "• Verify all functionality is working correctly"
