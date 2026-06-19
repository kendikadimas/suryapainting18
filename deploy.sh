#!/bin/bash

# Script Deploy SuryaPainting18
# Jalankan via SSH: ./deploy.sh

set -e

echo "🚀 Deploying SuryaPainting18..."

# Pindah ke folder project
cd /home/suryapai/suryapainting18

# Pull perubahan dari GitHub
echo "📥 Pulling from GitHub..."
git pull origin main

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

# Pastikan permission storage benar
echo "🔐 Fixing permissions..."
chmod -R 775 storage bootstrap/cache

echo "✅ Deploy completed!"
