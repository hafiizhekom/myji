# MyJI Laravel Project

A web application built with [Laravel](https://laravel.com/) for e-commerce solutions.

## Features

- User authentication and authorization
- Data management with Eloquent ORM
- Database migrations and seeders
- Excel import/export functionality
- Email notifications and alerts
- AdminLTE-based responsive admin dashboard with frontend plugins
- RESTful API endpoints for integration
- Product catalog and inventory management
- Shopping cart and order processing
- Role-based access control
- Localization support

## Installation

Clone the repository and install dependencies:

```sh
git clone <repo-url>
cd myji
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
npm run dev
php artisan serve
```

## Usage

- Access the application at `http://localhost:8000` after running the server.
- Login or register as a new user to start using the platform.
- Admin users can manage products, orders, and users from the dashboard.