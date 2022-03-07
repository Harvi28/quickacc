DROP TABLE IF EXISTS `jsvcz_helloworld`;

CREATE TABLE `jsvcz_helloworld` (
	`id`       INT(11)     NOT NULL AUTO_INCREMENT,
	`asset_id` INT(10)     NOT NULL DEFAULT '0',
	`created`  DATETIME    NOT NULL DEFAULT '0000-00-00 00:00:00',
	`created_by`  INT(10) UNSIGNED NOT NULL DEFAULT '0',
	`greeting` VARCHAR(25) NOT NULL,
	`alias`  VARCHAR(40)  NOT NULL DEFAULT '',
	`language`  CHAR(7)  NOT NULL DEFAULT '*',
	`parent_id`	int(10)    NOT NULL DEFAULT '1',
	`level`	int(10)    NOT NULL DEFAULT '0',
	`path`	VARCHAR(400)    NOT NULL DEFAULT '',
	`lft`	int(11)    NOT NULL DEFAULT '0',
	`rgt`	int(11)    NOT NULL DEFAULT '0',	
	`checked_out` INT(10) NOT NULL DEFAULT '0',
	`checked_out_time` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
	`published` tinyint(4) NOT NULL ,
	`catid`	    int(11)    NOT NULL DEFAULT '0',
	`params`   VARCHAR(1024) NOT NULL DEFAULT '',
	`image`   VARCHAR(1024) NOT NULL DEFAULT '',
	`latitude` DECIMAL(9,7) NOT NULL DEFAULT 0.0,
	`longitude` DECIMAL(10,7) NOT NULL DEFAULT 0.0,
	PRIMARY KEY (`id`)
)
	ENGINE =MyISAM
	AUTO_INCREMENT =0
	DEFAULT CHARSET =utf8;

CREATE UNIQUE INDEX `aliasindex` ON `#__helloworld` (`alias`, `catid`);

	
INSERT INTO `#__helloworld` (`greeting`,`alias`,`language`, `parent_id`, `level`, `path`, `lft`, `rgt`, `published`) VALUES
('helloworld root','helloworld-root-alias','en-GB', 0, 0, '', 0, 5, 1),
('Hello World!','hello-world','en-GB', 1, 1, 'hello-world', 1, 2, 0),
('Goodbye World!','goodbye-world','en-GB', 1, 1, 'goodbye-world', 3, 4, 0);