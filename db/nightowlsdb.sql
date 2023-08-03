-- MySQL Script generated by MySQL Workbench
-- Wed Aug  2 14:13:49 2023
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema nightowlsdb
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `nightowlsdb` ;

CREATE SCHEMA `nightowlsdb`;

-- -----------------------------------------------------
-- Schema nightowlsdb
-- -----------------------------------------------------
USE `nightowlsdb` ;

-- -----------------------------------------------------
-- Table `nightowlsdb`.`Categories`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `nightowlsdb`.`Categories` ;

CREATE TABLE IF NOT EXISTS `nightowlsdb`.`Categories` (
  `CategoryID` INT NOT NULL AUTO_INCREMENT,
  `CategoryName` VARCHAR(45) NULL,
  PRIMARY KEY (`CategoryID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `nightowlsdb`.`Products`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `nightowlsdb`.`Products` ;

CREATE TABLE IF NOT EXISTS `nightowlsdb`.`Products` (
  `ProductID` INT NOT NULL AUTO_INCREMENT,
  `Pname` VARCHAR(45) NULL,
  `Price` DECIMAL(10,2) NULL,
  `Quantity` INT NULL,
  `ProductImageUrl` varchar(255) NULL,
  `ProductDescription` text NULL,
  `Categories_CategoryID` INT NOT NULL,
  PRIMARY KEY (`ProductID`),
  INDEX `fk_Products_Categories1_idx` (`Categories_CategoryID` ASC) ,
  CONSTRAINT `fk_Products_Categories1`
    FOREIGN KEY (`Categories_CategoryID`)
    REFERENCES `nightowlsdb`.`Categories` (`CategoryID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `nightowlsdb`.`Address`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `nightowlsdb`.`Address` ;

CREATE TABLE IF NOT EXISTS `nightowlsdb`.`Address` (
  `AddressID` INT NOT NULL AUTO_INCREMENT,
  `houseNumber` VARCHAR(45) NULL,
  `streetName` VARCHAR(45) NULL,
  `City` VARCHAR(45) NULL,
  `Province` VARCHAR(45) NULL,
  `postalCode` VARCHAR(45) NULL,
  PRIMARY KEY (`AddressID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `nightowlsdb`.`Customer`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `nightowlsdb`.`Customer` ;

CREATE TABLE IF NOT EXISTS `nightowlsdb`.`Customer` (
  `CID` INT NOT NULL AUTO_INCREMENT,
  `Name` VARCHAR(45) NULL,
  `Email` VARCHAR(100) NULL,
  `Password_hash` VARCHAR(100) NULL,
  `Address_AddressID` INT NOT NULL,
  PRIMARY KEY (`CID`),
  INDEX `fk_Customer_Address1_idx` (`Address_AddressID` ASC) ,
  CONSTRAINT `fk_Customer_Address1`
    FOREIGN KEY (`Address_AddressID`)
    REFERENCES `nightowlsdb`.`Address` (`AddressID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `nightowlsdb`.`Order`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `nightowlsdb`.`Order` ;

CREATE TABLE IF NOT EXISTS `nightowlsdb`.`Order` (
  `OrderID` INT NOT NULL,
  `TimeStamp` TIMESTAMP NULL,
  `Summary` VARCHAR(45) NULL,
  `BilledAmount` DECIMAL(10,2) NULL,
  `Customer_CID` INT NOT NULL,
  `Products_ProductID` INT NOT NULL,
  PRIMARY KEY (`OrderID`),
  INDEX `fk_Order_Customer1_idx` (`Customer_CID` ASC) ,
  INDEX `fk_Order_Products1_idx` (`Products_ProductID` ASC) ,
  CONSTRAINT `fk_Order_Customer1`
    FOREIGN KEY (`Customer_CID`)
    REFERENCES `nightowlsdb`.`Customer` (`CID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Order_Products1`
    FOREIGN KEY (`Products_ProductID`)
    REFERENCES `nightowlsdb`.`Products` (`ProductID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `nightowlsdb`.`Card`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `nightowlsdb`.`Card` ;

CREATE TABLE IF NOT EXISTS `nightowlsdb`.`Card` (
  `CardNumber` INT NOT NULL AUTO_INCREMENT,
  `CVV` INT NULL,
  `ExpiryDate` VARCHAR(10) NULL,
  `CardType` VARCHAR(45) NULL,
  `Customer_CID` INT NOT NULL,
  PRIMARY KEY (`CardNumber`),
  INDEX `fk_Card_Customer1_idx` (`Customer_CID` ASC) ,
  CONSTRAINT `fk_Card_Customer1`
    FOREIGN KEY (`Customer_CID`)
    REFERENCES `nightowlsdb`.`Customer` (`CID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `nightowlsdb`.`Payment`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `nightowlsdb`.`Payment` ;

CREATE TABLE IF NOT EXISTS `nightowlsdb`.`Payment` (
  `PaymentID` INT NOT NULL AUTO_INCREMENT,
  `Order_OrderID` INT NOT NULL,
  `Card_CardNumber` INT NOT NULL,
  PRIMARY KEY (`PaymentID`),
  INDEX `fk_Payment_Order1_idx` (`Order_OrderID` ASC) ,
  INDEX `fk_Payment_Card1_idx` (`Card_CardNumber` ASC) ,
  CONSTRAINT `fk_Payment_Order1`
    FOREIGN KEY (`Order_OrderID`)
    REFERENCES `nightowlsdb`.`Order` (`OrderID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Payment_Card1`
    FOREIGN KEY (`Card_CardNumber`)
    REFERENCES `nightowlsdb`.`Card` (`CardNumber`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

SET GLOBAL local_infile=ON;

LOAD DATA INFILE '.\\Category.csv'
INTO TABLE categories
FIELDS TERMINATED BY ','
ENCLOSED BY '"'
LINES TERMINATED BY '\n';

LOAD DATA INFILE '.\\product.csv'
INTO TABLE products
FIELDS TERMINATED BY ','
ENCLOSED BY '"'
LINES TERMINATED BY '\n';

insert into Address values (1,"48","Lecester street","waterloo","Ontario","N2A 2V2");
insert into Customer values (1,"Ekpreet","ek@gmail.com","Ss@1234",1);