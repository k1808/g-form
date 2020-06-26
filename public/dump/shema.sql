CREATE DATABASE g_forms
  DEFAULT CHARACTER SET utf8
  DEFAULT COLLATE utf8_general_ci;

  USE g_forms;

  CREATE TABLE `g_forms`.`coments` (
    `id` INT NOT NULL AUTO_INCREMENT ,
    `date_create` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ,
    `name` VARCHAR(128) NOT NULL ,
    `comment` TEXT NOT NULL ,
    `avatar`  VARCHAR(128) NULL,
    PRIMARY KEY (`id`)) ENGINE = InnoDB;
