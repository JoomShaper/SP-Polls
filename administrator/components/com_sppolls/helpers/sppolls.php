<?php
/**
* @package     Sppolls
*
* @copyright   Copyright (C) 2010 - 2021 JoomShaper. All rights reserved.
* @license     GNU General Public License version 2 or later; see LICENSE.txt
*/

use Joomla\CMS\Helper\ContentHelper;
use Joomla\CMS\Language\Text;


defined('_JEXEC') or die;

class SppollsHelper extends ContentHelper{
	
	public static function addSubmenu($vName){
		JHtmlSidebar::addEntry(
			Text::_('COM_SPPOLLS_SUBMENU_SPPOLLS'),
			'index.php?option=com_sppolls&view=polls',
			$vName == 'polls'
		);
		/*--EOS EndOfSection: Dont't remove for future submenus generation--*/
	}

	public static function debug($data, $die = true)
	{
		echo "<pre>";
		print_r($data);
		echo "</pre>";
		if ($die) die;
	}
}
