<?php
/**
* @package     Sppolls
*
* @copyright   Copyright (C) 2010 - 2025 JoomShaper. All rights reserved.
* @license     GNU General Public License version 2 or later; see LICENSE.txt
*/

use Joomla\CMS\Helper\ContentHelper;

defined('_JEXEC') or die;

class SppollsHelper extends ContentHelper
{
	public static function debug($data, $die = true)
	{
		echo "<pre>";
		print_r($data);
		echo "</pre>";
		if ($die) die;
	}
}
