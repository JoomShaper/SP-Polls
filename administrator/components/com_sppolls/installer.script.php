<?php
/*------------------------------------------------------------------------
# SP Polls - Ajax Poll Component by JoomShaper.com
# ------------------------------------------------------------------------
# author    JoomShaper http://www.joomshaper.com
# Copyright (C) 2010 - 2021 JoomShaper.com. All Rights Reserved.
# License - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://www.joomshaper.com
-------------------------------------------------------------------------*/
defined ('_JEXEC') or die('restricted access');

use Joomla\CMS\Factory;
use Joomla\CMS\Installer\Installer;

class com_sppollsInstallerScript {

    public function uninstall($parent) {
        $db = Factory::getDbo();         
        $query = $db->getQuery(true);         
        $query->select($db->quoteName(array('extension_id')));
        $query->from($db->quoteName('#__extensions'));
        $query->where($db->quoteName('type') . ' = '. $db->quote('module'));
        $query->where($db->quoteName('element') . ' = '. $db->quote('mod_sp_poll'));
        $db->setQuery($query); 
        $id = $db->loadResult();

        if(isset($id) && $id) {
            $installer = new Installer;
            $result = $installer->uninstall('module', $id);
        }
    }

    function postflight($type, $parent) {
        $db = Factory::getDBO();
        $mod_sp_poll = $parent->getParent()->getPath('source') . '/modules/mod_sp_poll';
        $installer = new Installer;
        $installer->install($mod_sp_poll);
    }
}