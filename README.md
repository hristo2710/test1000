# WordPress installation guide test

## Introduction
Clone this repository to your local machine and follow the steps below.

## Pre-requisites

### PHP

Install php in `c:\php` and add it to the `PATH`.
Open `php.ini` and edit or uncomment the following lines:
- extension_dir = "C:\php\ext"
- extension=mysqli
- extension=zip
- extension=fileinfo
- extension=curl
- extension=gd
- extension=mbstring
- extension=pdo_mysql
- extension=openssl

### Composer

Install composer globally.
- for windows: [https://getcomposer.org/doc/00-intro.md#installation-windows](https://getcomposer.org/doc/00-intro.md#installation-windows)

### MySQL Connection string
Edit `.env` to add properly the connection string to the database.

## Re Git the repository

- Start command prompt ""Win+R -> cmd" and go to the D:/Projects Folder where you cloned the repository - `git clone https://github.com/GenCloud-Ltd/init-composer.git example.com`. 
- Remove current git origin, so to create new repository - `git remote remove origin`.
- Go to the new folder - `cd example.com` and initialize a new git repository - `git init`.
- Add a new repository manual in github and copy url to add new url `git remote add origin <new_repository_url>` 
- Push to the new remote: `git push -u origin main`

## Using Composer

### How to create a new database name

DB_NAME = "client name" + "_" + "start with 4 for local development, 5 for staging and 7 for production and count of project with zeros in front so the final number has 4 digits" + "_". The final name, for local development, should looks like: `Client_4001_`.

### Install Project
- Initialize wordpress installation - `composer update`.
- Rename .env.example to .env - ` mv .\.env.emample .env `
- Edit .Env for existing or new project ` code -r .\.env `
- Create a new table in database - `php create_database.php`.
- Manual Start the PHP built-in server - `php -S 127.0.0.1:80 -t web`.

### I prefer to use install
- `composer install --no-scripts`