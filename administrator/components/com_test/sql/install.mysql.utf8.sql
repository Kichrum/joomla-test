DROP TABLE IF EXISTS `#__test`;
CREATE TABLE IF NOT EXISTS `#__test` (
	`id` int(11) NOT NULL auto_increment, 
	`title` varchar(200) NOT NULL , 
	`alias` varchar(200) NOT NULL , 
	`asset_id` INTEGER UNSIGNED NOT NULL DEFAULT 0 COMMENT 'FK to the #__assets table.', 
	`introtext` text  NOT NULL , 
	`fulltext` text  NOT NULL , 
	`created` datetime  NOT NULL , 
	`ordering` int(11) NOT NULL , 
	`metakey` text  NOT NULL , 
	`metadesc` text  NOT NULL , 
	`hits` int(11) NOT NULL , 
	`created_by` int(11) NOT NULL , 
	`published` int(11) NOT NULL , 
	UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0;
