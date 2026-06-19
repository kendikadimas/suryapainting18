#!/bin/bash

# Setup awal untuk server cPanel
# Jalankan sekali saja: ./setup.sh

set -e

echo "🔧 Setting up SuryaPainting18..."

PROJECT_DIR="/home/suryapai/suryapainting18"
PUBLIC_HTML="/home/suryapai/public_html"

# 1. Clone repo kalau belum ada
if [ ! -d "$PROJECT_DIR" ]; then
    echo "📥 Cloning repository..."
    git clone https://github.com/kendikadimas/suryapainting18.git "$PROJECT_DIR"
else
    echo "✅ Project folder sudah ada"
fi

cd "$PROJECT_DIR"

# 2. Backup .env kalau ada di public_html lama
if [ -f "$PUBLIC_HTML/.env" ] && [ ! -f "$PROJECT_DIR/.env" ]; then
    echo "💾 Restoring .env from public_html..."
    cp "$PUBLIC_HTML/.env" "$PROJECT_DIR/.env"
fi

# 3. Generate APP_KEY kalau belum ada
if ! grep -q "APP_KEY=" "$PROJECT_DIR/.env" 2>/dev/null || [ -z "$(grep "APP_KEY=" "$PROJECT_DIR/.env" | cut -d'=' -f2)" ]; then
    echo "🔑 Generating APP_KEY..."
    php artisan key:generate --force
fi

# 4. Setup .env untuk production
echo "⚙️  Setting up .env..."
sed -i 's/APP_ENV=local/APP_ENV=production/' "$PROJECT_DIR/.env"
sed -i 's/APP_DEBUG=true/APP_DEBUG=false/' "$PROJECT_DIR/.env"

# 5. Install dependencies (kalau server support composer)
# composer install --no-dev --optimize-autoloader

# 6. Jalankan migration
echo "🗄️  Running migrations..."
php artisan migrate --force

# 7. Create storage symlink
echo "🔗 Creating storage symlink..."
php artisan storage:link

# 8. Backup public_html lama
if [ -d "$PUBLIC_HTML" ] && [ ! -L "$PUBLIC_HTML" ]; then
    BACKUP_DIR="${PUBLIC_HTML}_backup_$(date +%Y%m%d_%H%M%S)"
    echo "💾 Backing up old public_html to $BACKUP_DIR..."
    mv "$PUBLIC_HTML" "$BACKUP_DIR"
fi

# 9. Buat symlink public_html -> project/public
echo "🔗 Creating symlink public_html..."
ln -s "$PROJECT_DIR/public" "$PUBLIC_HTML"

# 10. Fix index.php path di public_html
echo "📝 Fixing index.php paths..."
cat > "$PROJECT_DIR/public/index.php" << 'EOF'
<?php

use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require __DIR__.'/../vendor/autoload.php';

// Bootstrap Laravel and handle the request...
(require_once __DIR__.'/../bootstrap/app.php')
    ->handleRequest(Request::capture());
EOF

# 11. Copy .htaccess kalau belum ada
if [ ! -f "$PROJECT_DIR/public/.htaccess" ]; then
    echo "📄 Creating .htaccess..."
    cat > "$PROJECT_DIR/public/.htaccess" << 'EOF'
<IfModule mod_rewrite.c>
    <IfModule mod_negotiation.c>
        Options -MultiViews -Indexes
    </IfModule>

    RewriteEngine On

    # Handle Authorization Header
    RewriteCond %{HTTP:Authorization} .
    RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]

    # Redirect Trailing Slashes If Not A Folder...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_URI} (.+)/$
    RewriteRule ^ %1 [L,R=301]

    # Send Requests To Front Controller...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^ index.php [L]
</IfModule>
EOF
fi

# 12. Optimize untuk production
echo "⚡ Optimizing..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 13. Fix permissions
echo "🔐 Fixing permissions..."
chmod -R 775 storage bootstrap/cache
chmod +x deploy.sh

echo ""
echo "✅ Setup completed!"
echo ""
echo "📌 Next steps:"
echo "   1. Edit .env di $PROJECT_DIR/.env untuk setting database, mail, dll"
echo "   2. Pastikan web server bisa akses $PUBLIC_HTML"
echo "   3. Untuk deploy selanjutnya, cukup jalankan: ./deploy.sh"
