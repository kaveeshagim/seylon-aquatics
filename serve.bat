@echo off
rem Start npm run dev in a new window
start "NPM" cmd /c "npm run dev"

rem Start php artisan serve in another new window
start "PHP Artisan" cmd /c "php artisan serve"
