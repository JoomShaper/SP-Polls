<?php 
/*------------------------------------------------------------------------
# mod_sp_poll - Ajax poll module by JoomShaper.com
# ------------------------------------------------------------------------
# author    JoomShaper http://www.joomshaper.com
# Copyright (C) 2010 - 2016 JoomShaper.com. All Rights Reserved.
# License - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://www.joomshaper.com
-------------------------------------------------------------------------*/
defined ('_JEXEC') or die('resticted aceess');

?>

<div class="mod-sppoll <?php echo $moduleclass_sfx;?>">
	<?php if(isset($poll)) { ?>
		<strong><?php echo $poll->title; ?></strong>
		<?php $polls = json_decode($poll->polls); ?>
		<form class="form-sppoll" data-id="<?php echo $poll->sppolls_poll_id; ?>" data-module_id="<?php echo $module->id; ?>">
			<?php foreach ($polls as $key=>$value) {?>
			<div class="radio">
				<label>
					<input type="radio" name="question" value="<?php echo $key; ?>" <?php echo ($key==0) ? 'checked': ''; ?>>
					<?php echo $value->poll; ?>
				</label>
			</div>
			<?php } ?>
			<input type="submit" class="btn btn-default" value="<?php echo JText::_('MOD_SP_POLL_BUTTON_SUBMIT'); ?>">
			<input type="button" class="btn btn-success btn-poll-result" data-result_id="<?php echo $poll->sppolls_poll_id; ?>" value="<?php echo JText::_('MOD_SP_POLL_BUTTON_RESULT'); ?>">
		</form>
		<div class="sppoll-results"></div>
	<?php } else { ?>
		<p class="alert alert-warning"><?php echo JText::_('MOD_SP_POLL_NO_RECORDS'); ?></p>
	<?php } ?>
</div>