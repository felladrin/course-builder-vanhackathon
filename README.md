Course Builder
==============

Course Builder made during the VanHackathon (Oct 2016).

## Requirements

- Web Server with Apache or Nginx that supports php >= 5.4
- MySQL database
- Composer

## Installation

- Clone this repository.
- Run 'composer install' in the project folder.
- Create a mysql database named `curse_builder`.
- Add user `curse_builder` with password `4o4gqGuj0GMUJZQ420Cr89BjqNyntQN4` to the database created above.
- Run 'php yii migrate' to create the tables on the database.
- Access `<host>/<project_folder>/web` in your browser.
