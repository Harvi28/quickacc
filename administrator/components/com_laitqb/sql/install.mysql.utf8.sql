DROP TABLE IF EXISTS `#__laitqb_quickbook`;
CREATE TABLE `#__laitqb_quickbook` (
    `id` INT(11) NOT NULL AUTO_INCREMENT ,
    `access_token` VARCHAR(512) NOT NULL ,
    `refresh_token` VARCHAR(512) NOT NULL ,
    `refresh_token_expires_in` DATETIME NOT NULL ,
    `access_token_expires_in` DATETIME NOT NULL ,
    `realm_id` VARCHAR(512) NOT NULL ,
    `modified_on` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
    `created_on` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
    `user_id` INT(11) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;
