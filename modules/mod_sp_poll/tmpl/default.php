<?php 
/*------------------------------------------------------------------------
# mod_sp_poll - Ajax poll module by JoomShaper.com
# ------------------------------------------------------------------------
# author    JoomShaper http://www.joomshaper.com
# Copyright (C) 2010 - 2021 JoomShaper.com. All Rights Reserved.
# License - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://www.joomshaper.com
-------------------------------------------------------------------------*/
defined ('_JEXEC') or die('resticted aceess');

use Joomla\CMS\Factory;
use Joomla\CMS\Uri\Uri;
use Joomla\CMS\Language\Text;

$doc = Factory::getDocument();
$doc->addScriptDeclaration("var base_url = '" . Uri::base() . "index.php?option=com_sppolls'");

$cookie = Factory::getApplication()->input->cookie;
$vote = $cookie->get('sp_poll_voted_' . $module->id, null);
if(!is_null($vote))	
	$vote = base64_decode($vote);
?>

<div class="mod-sppoll <?php echo $moduleclass_sfx;?>">
	<?php if(isset($poll)) { ?>
		<strong><?php echo $poll->title; ?></strong>
		<?php $polls = json_decode($poll->polls); ?>
		<form class="form-sppoll" data-id="<?php echo $poll->id; ?>" data-module_id="<?php echo $module->id; ?>">
			<?php foreach ($polls as $key=>$value) {?>
			<div class="radio">
				<label>
					
					<input type="radio" name="question" value="<?php echo $key; ?>" <?php echo !is_null($vote) && ($value->poll == $vote) ? 'checked': ($key==0 ? 'checked': ''); ?>>
					<?php echo $value->poll; ?>
				</label>
			</div>
			<?php } ?>
			<input type="submit" class="btn btn-primary" value="<?php echo Text::_('MOD_SP_POLL_BUTTON_SUBMIT'); ?>">
			<?php if (!is_null($vote)){ ?>
			<input type="button" class="btn btn-success btn-poll-result" data-result_id="<?php echo $poll->id; ?>" value="<?php echo Text::_('MOD_SP_POLL_BUTTON_RESULT'); ?>">
			<?php } ?>
		</form>
		<div class="sppoll-results"></div>
	<?php } else { ?>
		<p class="alert alert-warning"><?php echo Text::_('MOD_SP_POLL_NO_RECORDS'); ?></p>
	<?php } ?>
</div>