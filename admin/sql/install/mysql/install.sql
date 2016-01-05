CREATE TABLE IF NOT EXISTS `#__sppolls_polls` (
  `sppolls_poll_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(55) NOT NULL DEFAULT '',
  `polls` text NOT NULL,
  `enabled` tinyint(3) NOT NULL DEFAULT '1',
  `language` varchar(255) NOT NULL DEFAULT '*',
  `access` int(5) NOT NULL DEFAULT '1',
  `ordering` int(10) NOT NULL DEFAULT '0',
  `created_by` bigint(20) NOT NULL DEFAULT '0',
  `created_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` bigint(20) NOT NULL DEFAULT '0',
  `modified_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `locked_by` bigint(20) NOT NULL DEFAULT '0',
  `locked_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`sppolls_poll_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;