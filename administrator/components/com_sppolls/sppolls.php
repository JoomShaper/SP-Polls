<?php
/*------------------------------------------------------------------------
# SP Polls - Ajax Poll Component by JoomShaper.com
# ------------------------------------------------------------------------
# author    JoomShaper http://www.joomshaper.com
# Copyright (C) 2010 - 2021 JoomShaper.com. All Rights Reserved.
# License - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://www.joomshaper.com
-------------------------------------------------------------------------*/
defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\Controller\BaseController;

if (file_exists(JPATH_COMPONENT.'/vendor/autoload.php'))
{
  include JPATH_COMPONENT.'/vendor/autoload.php';
}

if (!Factory::getUser()->authorise('core.manage','com_sppolls'))
{
  throw new \Exception(Text::_('JERROR_ALERTNOAUTHOR'), 404);
}
if (file_exists(JPATH_COMPONENT.'/helpers/sppolls.php'))
{
  JLoader::register('SppollsHelper', JPATH_COMPONENT . '/helpers/sppolls.php');
}

// Execute the task.
$controller=BaseController::getInstance('Sppolls');
$controller->execute(Factory::getApplication()->input->get('task'));
$controller->redirect();
