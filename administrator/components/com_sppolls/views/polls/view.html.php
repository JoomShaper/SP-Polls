
<?php

/**
* @package     Sppolls
*
* @copyright   Copyright (C) 2010 - 2021 JoomShaper. All rights reserved.
* @license     GNU General Public License version 2 or later; see LICENSE.txt
*/

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Toolbar\Toolbar;
use Joomla\CMS\MVC\View\HtmlView;
use Joomla\CMS\Helper\ContentHelper;
use Joomla\CMS\Toolbar\ToolbarHelper;

defined('_JEXEC') or die;

class SppollsViewPolls extends HtmlView
{
	protected $items;

	protected $state;

	protected $pagination;

	protected $model;

	public $filterForm, $activeFilters;

	public function display($tpl = null)
	{
		$this->items        	= $this->get('Items');
		$this->state       		= $this->get('State');
		$this->pagination   	= $this->get('Pagination');
		$this->model        	= $this->getModel('polls');
		$this->filterForm 		= $this->get('FilterForm');
		$this->activeFilters 	= $this->get('ActiveFilters');

		SppollsHelper::addSubmenu('polls');


		if (count($errors = $this->get('Errors')))
		{
			throw new \Exception(implode('<br>', $errors), 500);
		}

		$this->addToolbar();
		$this->sidebar = JHtmlSidebar::render();

		foreach($this->items as &$item)
		{
			$item->cpolls = $this->model->formatPolls($item->polls);
		}
		
		return parent::display($tpl);
	}

	protected function addToolbar()
	{
		$state = $this->get('State');
		$canDo = ContentHelper::getActions('com_sppolls','component');
		$user 	= Factory::getUser();
		$bar 	= Toolbar::getInstance('toolbar');


		if ($canDo->get('core.create'))
		{
			ToolbarHelper::addNew('poll.add');
		}

		if ($canDo->get('core.edit'))
		{
			ToolbarHelper::editList('poll.edit');
		}

		if ($canDo->get('core.edit.state'))
		{
			ToolbarHelper::publish('polls.publish','JTOOLBAR_PUBLISH',true);
			ToolbarHelper::unpublish('polls.unpublish','JTOOLBAR_UNPUBLISH',true);
			ToolbarHelper::archiveList('polls.archive');
			ToolbarHelper::checkin('polls.checkin');
		}

		if ($state->get('filter.published') == -2 && $canDo->get('core.delete'))
		{
			ToolbarHelper::deleteList('','polls.delete','JTOOLBAR_EMPTY_TRASH');
		}
		elseif ($canDo->get('core.edit.state'))
		{
			ToolbarHelper::trash('polls.trash');
		}

		if ($canDo->get('core.admin'))
		{
			ToolbarHelper::preferences('com_sppolls');
		}

		JHtmlSidebar::setAction('index.php?option=com_sppolls&view=polls');

		ToolbarHelper::title(Text::_('COM_SPPOLLS_TITLE_POLLS'),'');
	}
}
	
