
<?php

/**
* @package     Sppolls
*
* @copyright   Copyright (C) 2010 - 2021 JoomShaper. All rights reserved.
* @license     GNU General Public License version 2 or later; see LICENSE.txt
*/

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\View\HtmlView;
use Joomla\CMS\Helper\ContentHelper;
use Joomla\CMS\Toolbar\ToolbarHelper;

defined('_JEXEC') or die;

class SppollsViewPoll extends HtmlView
{
	protected $item;

	protected $form;

	public function display($tpl = null)
	{
		$this->item = $this->get('Item');
		$this->form = $this->get('Form');

		if (count($errors = $this->get('Errors')))
		{
			throw new \Exception(implode('<br>',$errors), 500);
		}

		$this->addToolbar();

		return parent::display($tpl);
	}

	protected function addToolbar()
	{
		$input = Factory::getApplication()->input;
		$input->set('hidemainmenu',true);

		$user = Factory::getUser();
		$userId = $user->get('id');
		$isNew = $this->item->id == 0;
		$canDo = ContentHelper::getActions('com_sppolls','component');

		ToolbarHelper::title(Text::_('COM_SPPOLLS_TITLE_POLLS_EDIT'), '');

		if ($canDo->get('core.edit'))
		{
			ToolbarHelper::apply('poll.apply','JTOOLBAR_APPLY');
			ToolbarHelper::save('poll.save','JTOOLBAR_SAVE');
			ToolbarHelper::save2new('poll.save2new');
		}

		ToolbarHelper::cancel('poll.cancel','JTOOLBAR_CLOSE');

	}
}
	
