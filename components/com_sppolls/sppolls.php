<?php

/**
 * @package     Sppolls
 *
 * @copyright   Copyright (C) 2010 - 2025 JoomShaper. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */


use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Controller\BaseController;

defined('_JEXEC') or die;

$controller = BaseController::getInstance('Sppolls');
$input = Factory::getApplication()->input;
$controller->execute($input->getCmd('task'));
$controller->redirect();
