<?php
/*------------------------------------------------------------------------
# SP Polls - Ajax Poll Component by JoomShaper.com
# ------------------------------------------------------------------------
# author    JoomShaper http://www.joomshaper.com
# Copyright (C) 2010 - 2016 JoomShaper.com. All Rights Reserved.
# License - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://www.joomshaper.com
-------------------------------------------------------------------------*/
defined ('_JEXEC') or die('resticted aceess');

class com_sppollsInstallerScript {

    public function uninstall($parent) {
        $db = JFactory::getDbo();         
        $query = $db->getQuery(true);         
        $query->select($db->quoteName(array('extension_id')));
        $query->from($db->quoteName('#__extensions'));
        $query->where($db->quoteName('type') . ' = '. $db->quote('module'));
        $query->where($db->quoteName('element') . ' = '. $db->quote('mod_sp_poll'));
        $db->setQuery($query); 
        $id = $db->loadResult();

        if(isset($id) && $id) {
            $installer = new JInstaller;
            $result = $installer->uninstall('module', $id);
        }
    }

    function postflight($type, $parent) {
        $db = JFactory::getDBO();
        $mod_sp_poll = $parent->getParent()->getPath('source') . '/mod_sp_poll';
        $installer = new JInstaller;
        $installer->install($mod_sp_poll);
    }
}