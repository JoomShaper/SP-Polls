<?php 
	/*------------------------------------------------------------------------
	# mod_sp_poll - Ajax poll module by JoomShaper.com
	# ------------------------------------------------------------------------
	# author    JoomShaper http://www.joomshaper.com
	# Copyright (C) 2010 - 2016 JoomShaper.com. All Rights Reserved.
	# License - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
	# Websites: http://www.joomshaper.com
    -------------------------------------------------------------------------*/
	defined ('_JEXEC') or die('resticted aceess');
	
	// Include the helper.
	require_once __DIR__ . '/helper.php';
	$moduleclass_sfx = $params->get('moduleclass_sfx');
	$poll_type 		= $params->get('poll_type');
	$poll_id 		= $params->get('poll_id');
	$lag 			= $params->get('lag');
	$mod_id			= $module->id;

	// Select Poll Type
	if($poll_type == 'single') {
		$poll = modSpPollHelper::getPoll($poll_id);
	} else {
		$poll = modSpPollHelper::getPoll();
	}

	JHtml::_('jquery.framework');
	$doc = JFactory::getDocument();
	$doc->addStylesheet( JURI::base(true) . '/modules/mod_sp_poll/assets/css/style.css' );
	$doc->addScript( JURI::base(true) . '/modules/mod_sp_poll/assets/js/script.js' );

	require JModuleHelper::getLayoutPath('mod_sp_poll');