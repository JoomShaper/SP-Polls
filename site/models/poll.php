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

class SppollsModelPoll extends FOFModel
{
	// Get Poll
	public function getPoll($id = null) {
		$app = JFactory::getApplication();
		$authorised = JAccess::getAuthorisedViewLevels(JFactory::getUser()->get('id'));
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select($db->quoteName(array('sppolls_poll_id', 'title', 'slug', 'polls')));
		$query->from($db->quoteName('#__sppolls_polls'));

		if ($app->getLanguageFilter()) {
			$query->where('language IN (' . $db->Quote(JFactory::getLanguage()->getTag()) . ',' . $db->Quote('*') . ')');
		}

		$query->where($db->quoteName('access')." IN (" . implode( ',', $authorised ) . ")");
		$query->where($db->quoteName('enabled'). ' = ' . $db->quote(1));
		
		if($id) {
			$query->where($db->quoteName('sppolls_poll_id') . " = " . $db->quote($id));
		}

		$query->order('created_on DESC');
		$db->setQuery($query);

		return $db->loadObject();
	}

	// Update Poll
	public function updatePoll($poll_data, $id) {
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$fields = array($db->quoteName('polls') . ' = ' . $db->quote(json_encode($poll_data)));
		$conditions = array($db->quoteName('sppolls_poll_id') . ' = ' . $db->quote($id)); 
		$query->update($db->quoteName('#__sppolls_polls'))->set($fields)->where($conditions);
		$db->setQuery($query);
		$db->execute();
	}

	// Get Module
	public function getModule($id) {
		$db = JFactory::getDbo(); 
		$query = $db->getQuery(true); 
		$query->select($db->quoteName(array('title', 'module', 'params')));
		$query->from($db->quoteName('#__modules'));
		$query->where($db->quoteName('id') . ' = '. $db->quote($id));
		$query->where($db->quoteName('published') . ' = '. $db->quote(1));
		$db->setQuery($query);
		 
		return $db->loadObject();
	}
}