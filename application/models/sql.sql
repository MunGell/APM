SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `PMSystem` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `PMSystem` ;

-- -----------------------------------------------------
-- Table `PMSystem`.`Users`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `PMSystem`.`Users` (
  `user_id` INT NOT NULL AUTO_INCREMENT ,
  `user_name` VARCHAR(100) NOT NULL ,
  `user_pass` VARCHAR(100) NOT NULL ,
  `user_type` INT NOT NULL ,
  PRIMARY KEY (`user_id`) ,
  UNIQUE INDEX `user_id_UNIQUE` (`user_id` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `PMSystem`.`User_types`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `PMSystem`.`User_types` (
  `utype_id` INT NOT NULL AUTO_INCREMENT ,
  `utype_title` VARCHAR(100) NOT NULL ,
  PRIMARY KEY (`utype_id`) ,
  UNIQUE INDEX `utype_id_UNIQUE` (`utype_id` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `PMSystem`.`Privileges`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `PMSystem`.`Privileges` (
  `privilege_id` INT NOT NULL AUTO_INCREMENT ,
  `privilege_title` VARCHAR(100) NOT NULL ,
  PRIMARY KEY (`privilege_id`) ,
  UNIQUE INDEX `privelege_id_UNIQUE` (`privilege_id` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `PMSystem`.`Link_user_types_priveleges`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `PMSystem`.`Link_user_types_priveleges` (
  `link_ut_p_id` INT NOT NULL AUTO_INCREMENT ,
  `utype_id` INT NOT NULL ,
  `privilege_id` INT NOT NULL ,
  PRIMARY KEY (`link_ut_p_id`) ,
  UNIQUE INDEX `link_ut_p_id_UNIQUE` (`link_ut_p_id` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `PMSystem`.`Projects`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `PMSystem`.`Projects` (
  `project_id` INT NOT NULL AUTO_INCREMENT ,
  `project_title` VARCHAR(100) NOT NULL ,
  `project_description` TEXT NULL ,
  `project_start` DATETIME NULL DEFAULT NOW() ,
  `project_deadline` DATETIME NULL ,
  `project_budget` DOUBLE NULL ,
  `project_finish` TINYINT NULL DEFAULT 0 ,
  PRIMARY KEY (`project_id`) ,
  UNIQUE INDEX `project_id_UNIQUE` (`project_id` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `PMSystem`.`Project_managers`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `PMSystem`.`Project_managers` (
  `pmanager_id` INT NOT NULL AUTO_INCREMENT ,
  `user_id` INT NOT NULL ,
  `project_id` INT NOT NULL ,
  `pmanager_leader` TINYINT NOT NULL DEFAULT 0 ,
  PRIMARY KEY (`pmanager_id`) ,
  UNIQUE INDEX `pmanager_id_UNIQUE` (`pmanager_id` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `PMSystem`.`Task_lists`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `PMSystem`.`Task_lists` (
  `tlists_id` INT NOT NULL AUTO_INCREMENT ,
  `tlist_title` VARCHAR(100) NOT NULL ,
  `tlist_description` TEXT NULL ,
  `project_id` INT NOT NULL ,
  `mstone_id` INT NULL DEFAULT NULL ,
  PRIMARY KEY (`tlists_id`) ,
  UNIQUE INDEX `tlists_id_UNIQUE` (`tlists_id` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `PMSystem`.`Milestones`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `PMSystem`.`Milestones` (
  `mstone_id` INT NOT NULL AUTO_INCREMENT ,
  `mstone_title` VARCHAR(100) NOT NULL ,
  `mstone_description` TEXT NULL ,
  `project_id` INT NOT NULL ,
  `mstone_start` DATETIME NULL DEFAULT NOW() ,
  `mstone_deadline` DATETIME NULL ,
  `mstone_finish` TINYINT NULL DEFAULT 0 ,
  PRIMARY KEY (`mstone_id`) ,
  UNIQUE INDEX `mstone_id_UNIQUE` (`mstone_id` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `PMSystem`.`Link_milestones`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `PMSystem`.`Link_milestones` (
  `link_mstone_id` INT NOT NULL AUTO_INCREMENT ,
  `mstone_source` INT NOT NULL ,
  `mstone_target` INT NOT NULL ,
  PRIMARY KEY (`link_mstone_id`) ,
  UNIQUE INDEX `Link_milestones_UNIQUE` (`link_mstone_id` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `PMSystem`.`Tasks`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `PMSystem`.`Tasks` (
  `task_id` INT NOT NULL AUTO_INCREMENT ,
  `task_title` VARCHAR(100) NOT NULL ,
  `task_description` TEXT NULL ,
  `tlist_id` INT NOT NULL ,
  `task_user_source` INT NULL ,
  `task_user_target` INT NULL ,
  `task_start` DATETIME NULL DEFAULT NOW() ,
  `task_deadline` DATETIME NULL ,
  `task_finish` TINYINT NULL DEFAULT 0 ,
  PRIMARY KEY (`task_id`) ,
  UNIQUE INDEX `task_id_UNIQUE` (`task_id` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `PMSystem`.`Link_tasks`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `PMSystem`.`Link_tasks` (
  `link_task_id` INT NOT NULL AUTO_INCREMENT ,
  `task_source` INT NOT NULL ,
  `task_target` INT NOT NULL ,
  PRIMARY KEY (`link_task_id`) ,
  UNIQUE INDEX `link_task_id_UNIQUE` (`link_task_id` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `PMSystem`.`Todos`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `PMSystem`.`Todos` (
  `todo_id` INT NOT NULL AUTO_INCREMENT ,
  `todo_title` VARCHAR(100) NOT NULL ,
  `todo_description` TEXT NULL ,
  `user_id` INT NOT NULL ,
  `project_id` INT NULL DEFAULT NULL ,
  `todo_start` DATETIME NULL ,
  `todo_deadline` DATETIME NULL ,
  `todo_alert` TINYINT NULL DEFAULT 0 ,
  PRIMARY KEY (`todo_id`) ,
  UNIQUE INDEX `todo_id_UNIQUE` (`todo_id` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `PMSystem`.`Profiles`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `PMSystem`.`Profiles` (
  `profile_id` INT NOT NULL AUTO_INCREMENT ,
  `user_id` INT NOT NULL ,
  PRIMARY KEY (`profile_id`) ,
  UNIQUE INDEX `profile_id_UNIQUE` (`profile_id` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `PMSystem`.`Trackers`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `PMSystem`.`Trackers` (
  `track_id` INT NOT NULL AUTO_INCREMENT ,
  `track_description` TEXT NULL ,
  `track_start` DATETIME NOT NULL ,
  `track_end` DATETIME NOT NULL ,
  `user_id` INT NULL ,
  `task_id` INT NULL ,
  PRIMARY KEY (`track_id`) ,
  UNIQUE INDEX `track_id_UNIQUE` (`track_id` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `PMSystem`.`Files`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `PMSystem`.`Files` (
  `idFiles` INT NOT NULL ,
  PRIMARY KEY (`idFiles`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `PMSystem`.`Companies`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `PMSystem`.`Companies` (
  `idCompanies` INT NOT NULL ,
  PRIMARY KEY (`idCompanies`) )
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
