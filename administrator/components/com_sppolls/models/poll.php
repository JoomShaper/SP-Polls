
<?php

/**
* @package     Sppolls
*
* @copyright   Copyright (C) 2010 - 2021 JoomShaper. All rights reserved.
* @license     GNU General Public License version 2 or later; see LICENSE.txt
*/

use Joomla\CMS\Factory;
use Joomla\CMS\Table\Table;
use Joomla\CMS\MVC\Model\AdminModel;

defined('_JEXEC') or die;

class SppollsModelPoll extends AdminModel
{
	protected $text_prefix = 'COM_SPPOLLS';

	public function getTable($name = 'Poll', $prefix = 'SppollsTable', $config = array())
	{
		return Table::getInstance($name, $prefix, $config);
	}

	public function getForm($data = array(), $loadData = true)
	{
		$app = Factory::getApplication();
		$form = $this->loadForm('com_sppolls.poll','poll',array('control' => 'jform', 'load_data' => $loadData));

		if (empty($form))
		{
			return false;
		}

		return $form;
	}

	public function loadFormData()
	{
		$data = Factory::getApplication()
			->getUserState('com_sppolls.edit.poll.data',array());

		if (empty($data))
		{
			$data = $this->getItem();
		}

		return $data;
	}

	protected function canDelete($record)
	{
		if (!empty($record->id))
		{
			if ($record->published != -2) {
				return ;
			}

			$user = Factory::getUser();

			return parent::canDelete($record);
		}

	}

	protected function canEditState($record)
	{
		return parent::canEditState($record);
	}

	public function getItem($pk = null)
	{
		return parent::getItem($pk);
	}

	public function formatPolls($polls)
	{
		$polls = json_decode($polls, true);
		$nop = count($polls);
		$votes = 0;
		foreach($polls as $poll)
			$votes += (int) $poll['votes'];
		$data = [];
		$data['count'] = $nop;
		$data['votes'] = $votes;
		return $data;
	}
}
	
