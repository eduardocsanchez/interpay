DROP DATABASE IF EXISTS `bookstore`;
CREATE DATABASE `bookstore`;
USE `bookstore`;

DROP TABLE IF EXISTS `tbl_author`;
DROP TABLE IF EXISTS `tbl_book`;


CREATE TABLE `tbl_author`
(
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
    `name` VARCHAR( 100 ) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `created_date` datetime DEFAULT CURRENT_TIMESTAMP,
    `modified_date` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE = InnoDB;

CREATE TABLE `tbl_book`
(
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
    `author_id` INT NOT NULL,
    `name` VARCHAR( 200 ) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `created_date` datetime DEFAULT CURRENT_TIMESTAMP,
    `modified_date` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE = InnoDB;

--
-- Constraints for table `tbl_book`
--
ALTER TABLE `tbl_book`
  ADD CONSTRAINT `fk_author_id` FOREIGN KEY (`author_id`) REFERENCES `tbl_author` (`id`);
