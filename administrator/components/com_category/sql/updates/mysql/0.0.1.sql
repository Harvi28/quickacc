DROP TABLE IF EXISTS `jsvcz_category`;

CREATE TABLE `jsvcz_category` (
	`id`       INT(11)     NOT NULL AUTO_INCREMENT,
	`title` VARCHAR(50) NOT NULL,
	`short_desc` text NOT NULL,
	'desc' text NOT NULL,
	'image' VARCHAR(255),
	PRIMARY KEY (`id`)
);