# Laravel Project Setup Guide

## Requirements
- PHP 8.1+
- Composer
- MySQL
- Laravel 10+
- Git

## Installation Steps

### 1. Clone the Repository
```sh
git clone https://github.com/icodernet/wb-api.git
cd wb-api
```

### 2. Install Dependencies
```sh
composer install
```

### 3. Configure Environment Variables
```sh
cp .env.example .env
```
- Open `.env` file and configure database credentials:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password
```
- Set API credentials:
```env
API_HOST=http://89.108.115.241:6969
API_KEY=your_api_key
```

### 4. Generate Application Key
```sh
php artisan key:generate
```

### 5. Run Migrations
```sh
php artisan migrate
```

### 6. Seed Database
```sh
php artisan db:seed
```

### 7. Run the Application
```sh
php artisan serve
```
- The application will be accessible at `http://127.0.0.1:8000`