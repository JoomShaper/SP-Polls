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

$doc = JFactory::getDocument();
$doc->addStylesheet( JURI::base(true) . '/components/com_sppolls/assets/css/style.css' );

// Load FOF
include_once JPATH_LIBRARIES.'/fof/include.php';
if(!defined('FOF_INCLUDED')) {
	JFactory::getApplication()->enqueueMessage('FOF is not installed', '500');
}

FOFDispatcher::getTmpInstance('com_sppolls')->dispatch();