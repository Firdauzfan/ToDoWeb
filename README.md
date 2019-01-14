# Requirements

- Apache web server and PHP5 or higher
- phpmyadmin or similar software to execute SQL (or just add everything manually)

# How to install

- Download repository by clicking 'Download ZIP' on the right side of this page or clone using Git
- Create new database and define it's name at *Global functions* part in `app/init.php`
- Edit informations in `app/init.php` for connecting database
- In phpmyadmin, go to your database, click 'SQL' from top menu and add SQL from `/app/todo.sql`

# Instructions for init.php

## Edit connection data

In `init.php` change this variables:

- `$dbUsername` to your MySQL username.
- `$dbPassword` to your MySQL password.
