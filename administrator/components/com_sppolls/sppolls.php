<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_sppolls
 *
 * @license     MIT
 */
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
