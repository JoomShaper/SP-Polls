<?php
/**
 * @package     Sppolls
 *
 * @copyright   Copyright (C) 2010 - 2021 JoomShaper. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Uri\Uri;
use Joomla\CMS\Router\Route;
use Joomla\CMS\HTML\HTMLHelper;

$doc = Factory::getDocument();
HTMLHelper::_('behavior.formvalidator');
HTMLHelper::_('behavior.keepalive');
HTMLHelper::_('jquery.framework', false);
if (JVERSION < 4)
{
	HTMLHelper::_('formbehavior.chosen','select',null,array('disable_search_threshold' => 0));
}
$doc->addScript(Uri::base(true) . '/components/com_sppolls/assets/js/script.js')
;
$doc->addStyleSheet(Uri::base(true) . '/components/com_sppolls/assets/css/style.css');
?>

<form action="<?php echo Route::_('index.php?option=com_sppolls&view=poll&layout=edit&id=' . (int) $this->item->id); ?>" name="adminForm" id="adminForm" method="post" class="form-validate">
	<?php if (JVERSION < 4 && !empty($this->sidebar)) : ?>
    <div id="j-sidebar-container" class="span2">
		<?php echo $this->sidebar; ?>
    </div>
    <div id="j-main-container" class="span10" >
		<?php else: ?>
            <div id="j-main-container"></div>
		<?php endif; ?>
	<div class="form-horizontal">
		<div class="row-fluid">
			<div class="span12">
				<?php echo $this->form->renderFieldset('basic'); ?>
			</div>
		</div>
	</div>

	<input type="hidden" name="task" value="poll.edit" />
	<?php echo HTMLHelper::_('form.token'); ?>
	</div>
</form>

	
