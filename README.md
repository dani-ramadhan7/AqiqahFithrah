# Aqiqah Fithrah Website

Website profil dan daftar paket Aqiqah Fithrah berbasis PHP + Bootstrap.

## Sumber data poster terbaru

Semua data utama poster disimpan di:

- `poster_data.php`

File berikut membaca data dari sumber yang sama:

- `index.php` untuk tampilan website
- `packages.php` untuk endpoint JSON
- `without_phpmyadmin_index.php` dan `without_phpmyadmin_packages.php` sebagai alias kompatibilitas

## Admin Dashboard (Login, Logout, CRUD Paket)

- URL login: `admin/login.php`
- URL dashboard: `admin/dashboard.php`
- URL logout: `admin/logout.php`

Kredensial default:

- Username: `admin`
- Password: `admin123`

Simpan paket hasil CRUD ada di:

- `data/packages.json`

Konfigurasi login ada di:

- `config/admin.php` (ubah password hash untuk produksi)
