-- SP Polls - by JoomShaper.com
-- author    JoomShaper http://www.joomshaper.com
-- Copyright (C) 2010 - 2018 JoomShaper.com. All Rights Reserved.
-- License - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
-- Websites: http://www.joomshaper.com

-- update on version 2.0

--change #__sppolls_polls table's columns
ALTER TABLE `#__sppolls_polls` CHANGE `sppolls_poll_id` `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;
ALTER TABLE `#__sppolls_polls` CHANGE `slug` `alias` varchar(55) NOT NULL DEFAULT '';
ALTER TABLE `#__sppolls_polls` CHANGE `enabled` `published` tinyint NOT NULL DEFAULT '1';
ALTER TABLE `#__sppolls_polls` CHANGE `created_on` `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00';
ALTER TABLE `#__sppolls_polls` CHANGE `modified_on` `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00';
ALTER TABLE `#__sppolls_polls` CHANGE `locked_by` `checked_out` bigint NOT NULL DEFAULT '0';
ALTER TABLE `#__sppolls_polls` CHANGE `locked_on` `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00';