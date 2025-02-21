# 📌 Установка и запуск проекта

This is a Laravel project that fetches data from the API and adds it to the database. 
- Note: When you run the code, it fetches data from 3 days to the present.

## 🛠 Требования
- PHP 8.1+
- Composer
- MySQL
- Laravel 10+
- Git

## 🚀 Установка

### 1. Клонируйте репозиторий:
```sh
git clone https://github.com/icodernet/wb-api.git
cd wb-api
```

### 2. Установите зависимости:
```sh
composer install
```

### 3. Скопируйте файл окружения:
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
- Установите учетные данные API:
```env
API_HOST=http://89.108.115.241:6969
API_KEY=your_api_key
```

### 4. Сгенерируйте ключ приложения:
```sh
php artisan key:generate
```

### 5. Запуск миграций
```sh
php artisan migrate
```

### 6. Запустите сидеры
```sh
php artisan db:seed
```

### 7. Запустите сервер Laravel:
```sh
php artisan serve
```
- С вашим запуском нет ничего, кроме `welcome.blade` Потому что это всего лишь заполнение базы данных данными.

## Я запустил его на своем собственном сервере.
Можете попробовать.

- HOST URL - [wb-api.bot-dev.uz](https://wb-api.bot-dev.uz)
- PHPMyAdmin - [Link](https://45.93.136.149:8888/phpmyadmin/index.php)
#### Пароли входа в базу данных
 - Name: `wb_api_bot_d`
 - Login: `wb_api_bot_d`
 - Password: `BoSMKdvDbdVbA1ro`
