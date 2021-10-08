<?php 

/*------------------------------------------------------------------------
# mod_sp_poll - Ajax poll module by JoomShaper.com
# ------------------------------------------------------------------------
# author    JoomShaper http://www.joomshaper.com
# Copyright (C) 2010 - 2021 JoomShaper.com. All Rights Reserved.
# License - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://www.joomshaper.com
-------------------------------------------------------------------------*/
defined ('_JEXEC') or die('restricted access');
use Joomla\CMS\Factory;
use Joomla\CMS\Access\Access;

abstract class modSpPollHelper {

	// Get Poll
	public static function getPoll($id = null)
	{
		$app = Factory::getApplication();
		$authorised = Access::getAuthorisedViewLevels(Factory::getUser()->get('id'));
		$db = Factory::getDbo();
		$query = $db->getQuery(true);
		$query->select($db->quoteName(array('id', 'title', 'alias', 'polls')));
		$query->from($db->quoteName('#__sppolls_polls'));

		if ($app->getLanguageFilter())
		{
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

}