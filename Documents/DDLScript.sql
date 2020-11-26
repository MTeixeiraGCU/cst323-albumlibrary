SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema cst323_clcproject
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `cst323_clcproject` DEFAULT CHARACTER SET utf8 ;
USE `cst323_clcproject` ;

-- -----------------------------------------------------
-- Table `albums`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `albums` ;

CREATE TABLE IF NOT EXISTS `albums` (
  `ID` INT(11) NOT NULL,
  `ALBUMN_TITLE` VARCHAR(45) NULL DEFAULT NULL,
  `POST_TIME` VARCHAR(45) NULL DEFAULT NULL,
  `DESCRIPTION` TEXT NULL DEFAULT NULL,
  `RATING` INT(11) NULL DEFAULT NULL,
  `ARTIST` VARCHAR(45) NULL DEFAULT NULL,
  `IMG_LINK` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`ID`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `users` ;

CREATE TABLE IF NOT EXISTS `users` (
  `EMAIL` VARCHAR(45) NOT NULL,
  `USERNAME` VARCHAR(45) NOT NULL,
  `PASSWORD` VARCHAR(45) NOT NULL,
  `DOB` VARCHAR(45) NULL DEFAULT NULL,
  `ROLE` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`EMAIL`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `userrs_has_albums`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `users_has_albums` ;

CREATE TABLE IF NOT EXISTS `users_has_albums` (
  `USERS_EMAIL` VARCHAR(45) NOT NULL,
  `ALBUMS_ID` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`USERS_EMAIL`),
  INDEX `ALBUMS_ID_idx` (`ALBUMS_ID` ASC),
  CONSTRAINT `ALBUMS_ID`
    FOREIGN KEY (`ALBUMS_ID`)
    REFERENCES `albums` (`ID`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `USERS_EMAIL`
    FOREIGN KEY (`USERS_EMAIL`)
    REFERENCES `users` (`EMAIL`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

INSERT INTO `users` (`EMAIL`, `USERNAME`, `PASSWORD`, `DOB`, `ROLE`) VALUES ("marc@gcu.edu", "marc", 1234, "", "Admin");
INSERT INTO `users` (`EMAIL`, `USERNAME`, `PASSWORD`, `DOB`, `ROLE`) VALUES ("katon@gcu.edu", "katon", 1234, "", "Admin");
INSERT INTO `users` (`EMAIL`, `USERNAME`, `PASSWORD`, `DOB`, `ROLE`) VALUES ("will@gcu.edu", "will", 1234, "", "Admin");
