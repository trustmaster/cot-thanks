CREATE TABLE IF NOT EXISTS `cot_thanks` (
	`th_id` INT NOT NULL AUTO_INCREMENT,
	`th_date` DATETIME NOT NULL,
	`th_touser` INT NOT NULL REFERENCES `cot_users` (`user_id`),
	`th_fromuser` INT NOT NULL REFERENCES `cot_users` (`user_id`),
	`th_ext` VARCHAR(100) NOT NULL,
	`th_item` INT NOT NULL,
	PRIMARY KEY  (`th_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
