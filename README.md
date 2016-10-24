Course Builder
==============

Course Builder made during the VanHackathon (Oct 2016).

Live demo: <http://felladrin.com/experiments/course-builder-vanhackathon>

## Requirements

- Web Server with Apache or Nginx that supports PHP >= 5.4
- Any PDO compatible database (Only MySQL has been tested)
- Composer

## Quick Start

- Clone this repository.
- Run `composer global require "fxp/composer-asset-plugin:~1.2.0"`. (This is required by Yii2)
- Run `composer install` in the project folder.
- Create a mysql database named `curse_builder` and add the user `curse_builder` with password `4o4gqGuj0GMUJZQ420Cr89BjqNyntQN4`. (Or customize it on `config/db.php`)
- Run `php yii migrate` to initialize the tables.
- Access `<host>/<project_folder>/web` in your browser.
- Register an account and start playing!