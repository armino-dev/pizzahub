[![StyleCI](https://github.styleci.io/repos/274407419/shield?branch=shift-35096)](https://github.styleci.io/repos/274407419?branch=shift-35096)

# Pizza Hub

This is a responsive demo pizza delivery web application written in PHP, using the Laravel Framework.

## Instalation

> To run this project  you must have PHP 7 and MySql installed as prerequisites.

### Step 1

Begin by cloning this repository to your machine and install all Composer dependencies.

```bash
git clone https://github.com/armino-dev/pizzahub.git
cd pizzahub && composer install
composer dump-autoload
php artisan key:generate
```

### Step 2

Next, create a new database and reference its name and credentials within the project's `.env` file.
For example:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=pizzahub
DB_USERNAME=pizzahub
DB_PASSWORD=pizzahub

```

### Step 3

Perform database migration and seed.

```bash
php artisan migrate
php artisan db:seed
```

### Step 4

```bash
php artisan serve
```