# WordPress installation guide

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
Edit `config.json` to add properly the connection string to the database.

## Re Git the repository

- Start command prompt ""Win+R -> cmd" and go to the folder where you cloned the repository - `cd init-composer`.
- Remove current git origin, so to create new repository - `git remote remove origin`.
- Return to the parent folder - `cd ..` and rename the folder - `ren init-composer {writeNewFolderName}`.
- Go to the new folder - `cd {writeNewFolderName}` and initialize a new git repository - `git init`.

## Using Composer

### How to create a new database name

writeNewDatabaseName = "client name" + "_" + "start with 4 for local development, 5 for staging and 7 for production and count of project with zeros in front so the final number has 4 digits" + "_". The final name, for local development, should looks like: `Client_4001_`.

### Install Project

- Initialize wordpress installation - `composer update`.
- Create a new table in database - `composer run-script add-database -- {writeNewDatabaseName}`.
- Install wordpress - `composer run-script dev`.

### I prefer to use install
- `composer install --no-scripts`