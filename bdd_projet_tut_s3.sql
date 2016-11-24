SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci ;
USE `mydb`;

-- -----------------------------------------------------
-- Table `mydb`.`User`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`User` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `uid` VARCHAR(55) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Abscence`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`Abscence` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `debut_abs` TIMESTAMP NOT NULL DEFAULT  CURRENT_TIMESTAMP ,
  `fich_justificatif` VARCHAR(255) NOT NULL ,
  `user_id` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  CONSTRAINT `fk_Abscence_User`
    FOREIGN KEY (`user_id` )
    REFERENCES `mydb`.`User` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_Abscence_User` ON `mydb`.`Abscence` (`user_id` ASC) ;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
