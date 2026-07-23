#!/bin/bash

echo "Menjalankan Migrasi Database..."
php artisan migrate --force

echo "Membersihkan Cache..."
php artisan optimize:clear

echo "Memulai Web Server..."
php artisan serve --host=0.0.0.0 --port=$PORT
