--vytvořte v PHPMyAdmin databázi hledani_pokladu

--do SQL vložte následující kód:
CREATE TABLE `hledani_pokladu`.`users` (`id` INT NOT NULL AUTO_INCREMENT , `email` VARCHAR(100) NOT NULL , `password` VARCHAR(35) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

CREATE TABLE `hledani_pokladu`.`leaderboard` (`id` INT NOT NULL AUTO_INCREMENT , `id_user` INT NOT NULL , `poleX` TINYINT NOT NULL , `poleY` TINYINT NOT NULL , `clicks` SMALLINT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;