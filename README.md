# Laravel Posts App

## Requirements

Before starting, ensure you have the following installed:

-   PHP `^8.x`
-   Composer
-   MySQL

## Installation

### 1️⃣ Clone the Repository

```
git clone https://github.com/adnan-ha/laravel-posts-app.git
```

```
cd laravel-posts-app
```

### 2️⃣ Install Dependencies

```
composer install
```

### 3️⃣ Set Up Environment File

```
copy .env.example .env
```

```
php artisan key:generate
```

Then, open .env and update the database settings.

### 4️⃣ Run Database Migrations

```
php artisan migrate --seed
```

### 5️⃣ Start the Server

```
php artisan serve
```

Then, open http://127.0.0.1:8000 in your browser.
