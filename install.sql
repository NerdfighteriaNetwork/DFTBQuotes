SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `dftbquotes` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci ;
USE `dftbquotes` ;

-- -----------------------------------------------------
-- Table `dftbquotes`.`dftbq_quotes`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `dftbquotes`.`dftbq_quotes` (
  `quoteID` INT NOT NULL AUTO_INCREMENT ,
  `content` TEXT NOT NULL ,
  `created` DATETIME NOT NULL DEFAULT NOW() ,
  PRIMARY KEY (`quoteID`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dftbquotes`.`dftbq_votes`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `dftbquotes`.`dftbq_votes` (
  `voteID` INT NOT NULL AUTO_INCREMENT ,
  `positive` TINYINT(1) NOT NULL ,
  `IP` VARCHAR(39) NOT NULL ,
  `quotes_quoteID` INT NOT NULL ,
  PRIMARY KEY (`voteID`) ,
  INDEX `fk_votes_quotes` (`quotes_quoteID` ASC) ,
  CONSTRAINT `fk_votes_quotes`
    FOREIGN KEY (`quotes_quoteID` )
    REFERENCES `dftbquotes`.`dftbq_quotes` (`quoteID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dftbquotes`.`dftbq_admins`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `dftbquotes`.`dftbq_admins` (
  `adminID` INT NOT NULL AUTO_INCREMENT ,
  `username` VARCHAR(45) NOT NULL ,
  `password` VARCHAR(128) NOT NULL ,
  `salt` VARCHAR(16) NOT NULL ,
  PRIMARY KEY (`adminID`) )
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
