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

JHtml::_('formbehavior.chosen', 'select');
$doc = JFactory::getDocument();
$doc->addScript( JURI::base(true) . '/components/com_sppolls/assets/js/script.js' );

echo $this->getRenderedForm();