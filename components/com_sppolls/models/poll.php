<?php

use Joomla\CMS\Factory;
use Joomla\CMS\Access\Access;
use Joomla\CMS\MVC\Model\ItemModel;

defined('_JEXEC') or die;

class SppollsModelPoll extends ItemModel
{
	public function getItem($pk = null)
	{
		
	}
    // Get Poll
	public function getPoll($id = null) {
		$app = Factory::getApplication();
		$authorised = Access::getAuthorisedViewLevels(Factory::getUser()->get('id'));
		$db = Factory::getDbo();
		$query = $db->getQuery(true);
		$query->select($db->quoteName(array('id', 'title', 'alias', 'polls')));
		$query->from($db->quoteName('#__sppolls_polls'));

		if ($app->getLanguageFilter()) {
			$query->where('language IN (' . $db->Quote(Factory::getLanguage()->getTag()) . ',' . $db->Quote('*') . ')');
		}

		$query->where($db->quoteName('access')." IN (" . implode( ',', $authorised ) . ")");
		$query->where($db->quoteName('published'). ' = ' . $db->quote(1));
		
		if($id) {
			$query->where($db->quoteName('id') . " = " . $db->quote($id));
		}

		$query->order('created DESC');
		$db->setQuery($query);

		return $db->loadObject();
	}

	// Update Poll
	public function updatePoll($poll_data, $id) {
		$db = Factory::getDbo();
		$query = $db->getQuery(true);
		$fields = array($db->quoteName('polls') . ' = ' . $db->quote(json_encode($poll_data)));
		$conditions = array($db->quoteName('id') . ' = ' . $db->quote($id)); 
		$query->update($db->quoteName('#__sppolls_polls'))->set($fields)->where($conditions);
		$db->setQuery($query);
		$db->execute();
	}

	// Get Module
	public function getModule($id) {
		$db = Factory::getDbo(); 
		$query = $db->getQuery(true); 
		$query->select($db->quoteName(array('title', 'module', 'params')));
		$query->from($db->quoteName('#__modules'));
		$query->where($db->quoteName('id') . ' = '. $db->quote($id));
		$query->where($db->quoteName('published') . ' = '. $db->quote(1));
		$db->setQuery($query);
		 
		return $db->loadObject();
	}
}