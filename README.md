Course Builder
==============

Just a simple course builder.

## Requirements

- Webserver with Apache or nginx that supports php >= 5.4
- MySQL database
- Composer

## Installation

- Run 'composer install' in this project folder.
- Create a mysql database named 'curse_builder' with default storage engine set as INNODB.
```
CREATE DATABASE `curse_builder`;
```
- Add user 'curse_builder' with password '4o4gqGuj0GMUJZQ420Cr89BjqNyntQN4' to the database created above.
```
CREATE USER 'curse_builder'@'localhost' IDENTIFIED BY PASSWORD '*63A6F63C23470931830340BF2DFAE0FEB7273BC9';
GRANT ALL PRIVILEGES ON `curse_builder`.* TO 'curse_builder'@'localhost';
```
- Run 'php yii migrate' in this project folder, to create the tables.
