-- SP Polls - by JoomShaper.com
-- author    JoomShaper http://www.joomshaper.com
-- Copyright (C) 2010 - 2018 JoomShaper.com. All Rights Reserved.
-- License - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
-- Websites: http://www.joomshaper.com

-- update on version 2.0

--change #__sppolls_polls table's columns
ALTER TABLE `#__sppolls_polls` CHANGE COLUMN `sppolls_poll_id` `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT;
ALTER TABLE `#__sppolls_polls` CHANGE COLUMN `slug` `alias` VARCHAR(255) NOT NULL DEFAULT '';
ALTER TABLE `#__sppolls_polls` CHANGE COLUMN `enabled` `published` TINYINT(3) NOT NULL DEFAULT '1';
ALTER TABLE `#__sppolls_polls` CHANGE COLUMN `created_on` `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00';
ALTER TABLE `#__sppolls_polls` CHANGE COLUMN `modified_on` `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00';
ALTER TABLE `#__sppolls_polls` CHANGE COLUMN `locked_by` `checked_out` bigint(20) NOT NULL DEFAULT '0';
ALTER TABLE `#__sppolls_polls` CHANGE COLUMN `locked_on` `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00';