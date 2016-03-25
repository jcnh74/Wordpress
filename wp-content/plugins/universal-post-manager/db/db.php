<?php 
global 	$wpdb;

##########################################################################################################################
$sql[ 'pppm_html' ] = "CREATE TABLE IF NOT EXISTS `" . PPPM_PREFIX . "pppm_html` (
					  `id` int(11) NOT NULL auto_increment,
					  `tag` varchar(255) NOT NULL,
					  `description` tinytext NOT NULL,
					  `example` tinytext NOT NULL,
					  `status_post` tinyint(4) NOT NULL default '1',
					  `status_page` tinyint(4) NOT NULL default '1',
					  `status_comment` tinyint(4) NOT NULL default '1',
					  PRIMARY KEY  (`id`),
					  UNIQUE KEY `tag` (`tag`)
					) ENGINE=InnoDB  DEFAULT CHARSET=utf8; ";
				

$insert[ 'pppm_html' ] = "INSERT INTO `" . PPPM_PREFIX . "pppm_html` (`id`, `tag`, `description`, `example`, `status_post`, `status_page`, `status_comment`) VALUES " . file_get_contents( PPPM_FOLDER . 'db/db.sql');

###########################################################################################################################
$sql[ 'pppm_protocol' ] = "CREATE TABLE IF NOT EXISTS `" . PPPM_PREFIX . "pppm_protocol` (
					  `id` int(11) NOT NULL auto_increment,
					  `protocol` varchar(255) NOT NULL,
					  `status_post` tinyint(4) NOT NULL default '1',
					  `status_page` tinyint(4) NOT NULL default '1',
					  `status_comment` tinyint(4) NOT NULL default '1',
					  PRIMARY KEY  (`id`),
					  UNIQUE KEY `protocol` (`protocol`)
					) ENGINE=InnoDB  DEFAULT CHARSET=utf8;";

$insert[ 'pppm_protocol' ] = "INSERT INTO `" . PPPM_PREFIX . "pppm_protocol` (`id`, `protocol`, `status_post`, `status_page`, `status_comment`) VALUES
(1, 'http', 1, 1, 1),
(2, 'https', 1, 1, 1),
(3, 'ftp', 1, 1, 1),
(4, 'mailto', 1, 1, 1),
(5, 'news', 1, 1, 1),
(6, 'irc', 1, 1, 1),
(7, 'gopher', 1, 1, 1),
(8, 'nntp', 1, 1, 1),
(9, 'feed', 1, 1, 1),
(10, 'telnet', 1, 1, 1),
(11, 'javascript', 1, 1, 1);";

##########################################################################################################################
$sql[ 'pppm_shortcut' ] = "CREATE TABLE IF NOT EXISTS `" . PPPM_PREFIX . "pppm_shortcut` (
						  `id` int(11) NOT NULL auto_increment,
						  `shortcut` tinytext NOT NULL,
						  `link_text` tinytext NOT NULL,
						  `link_url` varchar(255) NOT NULL,
						  `link_target` varchar(255) NOT NULL,
						  `img_w` int(11) NOT NULL,
						  `img_h` int(11) NOT NULL,
						  `img_align` varchar(10) NOT NULL,
						  `img_url` varchar(255) NOT NULL,
						  PRIMARY KEY  (`id`),
						  UNIQUE KEY `id` (`id`)
						) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;";
						
$insert[ 'pppm_shortcut' ] = "INSERT INTO `" . PPPM_PREFIX . "pppm_shortcut` (`id`, `shortcut`, `link_text`, `link_url`, `link_target`, `img_w`, `img_h`, `img_align`, `img_url`) VALUES
(1, ':wp:', 'WordPress', 'http://wordpress.com', '_blank', 0, 0, '', ''),
(2, ':profprojects.com:', 'ProfProjects', 'http://profprojects.com', '_blank', 0, 0, '', ''),
(3, ':upm:', 'Universal Post Manager', 'http://www.profprojects.com/?page=upm', '_blank', 0, 0, '', '');";

##########################################################################################################################
$sql[ 'pppm_filter' ] = "CREATE TABLE IF NOT EXISTS `" . PPPM_PREFIX . "pppm_filter` (
  `id` int(11) NOT NULL auto_increment,
  `phrase` tinytext NOT NULL,
  `replace` tinytext NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

##########################################################################################################################
$sql[ 'pppm_polls' ] = "CREATE TABLE IF NOT EXISTS `" . PPPM_PREFIX . "pppm_polls` (
`id` INT NOT NULL AUTO_INCREMENT ,
`question` VARCHAR( 255 ) NOT NULL ,
`start` INT NOT NULL ,
`end` INT NOT NULL ,
`post` INT NOT NULL ,
`meta` LONGTEXT NOT NULL ,
PRIMARY KEY ( `id` )
) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;";

##########################################################################################################################
$sql[ 'pppm_polls_items' ] = "CREATE TABLE IF NOT EXISTS `" . PPPM_PREFIX . "pppm_polls_items` (
`id` INT NOT NULL AUTO_INCREMENT ,
`qid` INT NOT NULL ,
`answer` MEDIUMTEXT NOT NULL ,
`meta` LONGTEXT NOT NULL ,
PRIMARY KEY ( `id` )
) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;";

##########################################################################################################################
$sql[ 'pppm_polls_votes' ] = "CREATE TABLE IF NOT EXISTS `" . PPPM_PREFIX . "pppm_polls_votes` (
`id` INT NOT NULL AUTO_INCREMENT ,
`qid` INT NOT NULL ,
`item_id` INT NOT NULL ,
`user_id` INT NOT NULL ,
`ip` VARCHAR( 255 ) NOT NULL ,
`time` INT NOT NULL ,
`meta` LONGTEXT NOT NULL ,
PRIMARY KEY ( `id` )
) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;";

##########################################################################################################################

$sql_un[ 'pppm_html' ] = "DROP TABLE `" . PPPM_PREFIX . "pppm_html`;";
$sql_un[ 'pppm_protocol' ] = "DROP TABLE `" . PPPM_PREFIX . "pppm_protocol`;";
$sql_un[ 'pppm_filter' ] = "DROP TABLE `" . PPPM_PREFIX . "pppm_filter`;";
$sql_un[ 'pppm_shortcut' ] = "DROP TABLE `" . PPPM_PREFIX . "pppm_shortcut`;";
$sql_un[ 'pppm_polls' ] = "DROP TABLE `" . PPPM_PREFIX . "pppm_polls`;";
$sql_un[ 'pppm_polls_items' ] = "DROP TABLE `" . PPPM_PREFIX . "pppm_polls_items`;";
$sql_un[ 'pppm_polls_votes' ] = "DROP TABLE `" . PPPM_PREFIX . "pppm_polls_votes`;";

			
?>