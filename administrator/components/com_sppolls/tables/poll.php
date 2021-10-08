<?php
/**
* @package     Sppolls
*
* @copyright   Copyright (C) 2010 - 2021 JoomShaper. All rights reserved.
* @license     GNU General Public License version 2 or later; see LICENSE.txt
*/

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Date\Date;
use Joomla\CMS\Table\Table;
use Joomla\CMS\Language\Text;
use Joomla\Utilities\ArrayHelper;
use Joomla\CMS\Application\ApplicationHelper;


class SppollsTablePoll extends Table
{
	public function __construct(&$db)
	{
		parent::__construct('#__sppolls_polls', 'id', $db);
	}

	public function bind($src, $ignore = array())
	{
		return parent::bind($src, $ignore);
	}

	public function store($updateNulls = false)
	{
		$user = Factory::getUser();
		$app  = Factory::getApplication();
		$date = new Date('now', $app->get('offset'));

		if ($this->id)
		{
			$this->modified = (string)$date;
			$this->modified_by = $user->get('id');
		}

		if (empty($this->created))
		{
			$this->created = (string)$date;
		}

		if (empty($this->created_by))
		{
			$this->created_by = $user->get('id');
		}

		$table = Table::getInstance('Poll','SppollsTable');

		if ($table->load(['alias' => $this->alias]) && ($table->id != $this->id || $this->id == 0) )
		{
			$this->setError(Text::_('COM_SPPOLLS_ERROR_UNIQUE_ALIAS'));
			return false;
		}
		return parent::store($updateNulls);
	}

	public function check()
	{
		if (trim($this->title) == '')
		{
			throw new UnexpectedValueException(sprintf('The title is empty'));
		}

        $this->handleAlias();

		return true;
    }
    
    private function handleAlias()
    {
        if (empty($this->alias))
		{
			$this->alias = $this->title;
		}

		$this->alias = ApplicationHelper::stringURLSafe($this->alias, $this->language);

		if (trim(str_replace('-','',$this->alias)) == '')
		{
			$this->alias = JFactory::getDate()->format('Y-m-d-H-i-s');
		}
    }

	public function publish($pks = null, $published = 1, $userId = 0)
	{
		$k = $this->_tbl_key;

		ArrayHelper::toInteger($pks);
		$publilshed = (int) $published;

		if (empty($pks)) {
			if ($this->$k) {
				$pks = array($this->$k);
			} else {
				$this->setError(Text::_('JLIB_DATABASE_ERROR_NO_ROWS_SELECTED'));
				return false;
			}
        }
        
		$where = $k . '=' . implode(' OR '. $k . ' = ', $pks);

		$query = $this->_db->getQuery(true)
			->update($this->_db->quoteName($this->_tbl))
			->set($this->_db->quoteName('published') . ' = '. $published)
			->where($where);

		$this->_db->setQuery($query);

		try {
			$this->_db->execute();
		}catch(RuntimeException $e){
			$this->setError($e->getMessage());
			return false;
		}

		if (in_array($this->$k, $pks)) {
			$this->published = $published;
		}

		$this->setError('');
		return true;

	}
}
	
