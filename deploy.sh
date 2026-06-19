#!/bin/bash

# Script Deploy SuryaPainting18
# Jalankan via SSH: ./deploy.sh

echo "🚀 Deploying SuryaPainting18..."

# Pindah ke folder project
cd /home/suryapai/suryapainting18

# Pull perubahan dari GitHub
echo "📥 Pulling from GitHub..."
git checkout -- . 2>/dev/null || true
git pull origin main

# Restore .env dari backup kalau hilang
if [ ! -f /home/suryapai/suryapainting18/.env ] || [ ! -s /home/suryapai/suryapainting18/.env ]; then
    if [ -f /home/suryapai/.env.backup ]; then
        echo "💾 Restoring .env from backup..."
        cp /home/suryapai/.env.backup /home/suryapai/suryapainting18/.env
    else
        echo "⚠️  WARNING: .env missing and no backup found!"
    fi
fi

# Refresh APP_KEY kalau kosong
if grep -q "APP_KEY=$" /home/suryapai/suryapainting18/.env 2>/dev/null || ! grep -q "APP_KEY=base64" /home/suryapai/suryapainting18/.env 2>/dev/null; then
    echo "🔑 Generating APP_KEY..."
    php artisan key:generate --force
fi

# Jalankan migration
echo "🗄️  Running migrations..."
php artisan migrate --force

# Clear cache
echo "🧹 Clearing cache..."
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear

# Optimize untuk production
echo "⚡ Optimizing..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Sync public folder ke public_html
echo "📂 Syncing public files to public_html..."
cp -a /home/suryapai/suryapainting18/public/. /home/suryapai/public_html/

# Pastikan storage symlink ada
if [ ! -L /home/suryapai/suryapainting18/public/storage ]; then
    echo "🔗 Creating storage symlink..."
    php artisan storage:link
fi

# Pastikan permission storage benar
echo "🔐 Fixing permissions..."
chmod -R 775 storage bootstrap/cache
chmod -R 775 /home/suryapai/public_html

echo "✅ Deploy completed!"
