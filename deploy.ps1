# Deploy script untuk Windows
# Jalankan dari PowerShell: .\deploy.ps1

Write-Host "🚀 Deploying SuryaPainting18..." -ForegroundColor Cyan

# 1. Build assets
Write-Host "`n📦 Building assets..." -ForegroundColor Yellow
npm run build
if ($LASTEXITCODE -ne 0) {
    Write-Host "❌ Build failed!" -ForegroundColor Red
    exit 1
}

# 2. Git add, commit, push
Write-Host "`n📤 Pushing to GitHub..." -ForegroundColor Yellow
git add -A
git commit -m "deploy: $(Get-Date -Format 'yyyy-MM-dd HH:mm:ss')"
git push origin main

if ($LASTEXITCODE -ne 0) {
    Write-Host "❌ Push failed!" -ForegroundColor Red
    exit 1
}

# 3. Trigger deploy di server (via SSH)
Write-Host "`n🌐 Deploying to server..." -ForegroundColor Yellow
ssh suryapai@suryapainting18indonesia.com "cd /home/suryapai/suryapainting18 && ./deploy.sh"

Write-Host "`n✅ Deploy completed!" -ForegroundColor Green
