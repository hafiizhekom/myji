# MyJI Laravel Project

Aplikasi web berbasis [Laravel](https://laravel.com/) untuk e-commerce.

## Fitur

- Autentikasi user
- Pengelolaan data dengan Eloquent ORM
- Migrasi database
- Ekspor/Impor Excel
- Email & notifikasi
- UI AdminLTE + plugin frontend

## Instalasi

```sh
git clone <repo-url>
cd myji
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate
npm run dev
php artisan serve
```

## Testing

```sh
php artisan test
```

---

Lisensi: [MIT](https://opensource.org/licenses/MIT)
