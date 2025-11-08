@echo off
echo ========================================
echo Reset Rencana Studi Database
echo ========================================
echo.
echo Menjalankan seeder untuk membuat ulang data rencana studi...
echo Data akan dimulai dari ID 1 dengan urutan NIM mahasiswa
echo.

php spark db:seed RencanaStudiSeeder

echo.
echo ========================================
echo Selesai!
echo ========================================
pause
