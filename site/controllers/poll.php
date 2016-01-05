<?php
/*------------------------------------------------------------------------
# SP Polls - Ajax Poll Component by JoomShaper.com
# ------------------------------------------------------------------------
# author    JoomShaper http://www.joomshaper.com
# Copyright (C) 2010 - 2016 JoomShaper.com. All Rights Reserved.
# License - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://www.joomshaper.com
-------------------------------------------------------------------------*/
defined ('_JEXEC') or die('resticted aceess');

class SppollsControllerPoll extends FOFController
{

	public function getModel($name = 'Poll', $prefix = 'SppollsModel', $config = array()) {
		return parent::getModel($name, $prefix, $config);
	}

	// Get Ajax
	public function ajax(){
		
		jimport('joomla.application.module.helper');
		$model 	 = $this->getModel();
		$input 	 = JFactory::getApplication()->input;
		$cookie  = JFactory::getApplication()->input->cookie;
		$id  	 = $input->post->get('id', NULL, 'INT');
		$subtask = $input->post->get('subtask', NULL, 'STRING');
		$vote  	 = $input->post->get('vote', NULL, 'INT');
		$modid   = $input->post->get('modid', 0, 'INT');
		$module  = $model->getModule($modid);

		$params  = new JRegistry();
		$params->loadString($module->params);

		if($subtask != 'result') {

			if($cookie->get('sp_poll_voted_' . $modid, null)) {
				die('<p></p><p class="alert alert-danger">' . JText::_('COM_SPPOLLS_ALREADY_VOTED') . '</p>');
			}

			$poll = $model->getPoll($id);
			$options = json_decode($poll->polls);

			$new_polls = array();

			foreach ($options as $key => $value) {
				if($key == $vote) {
					$new_polls[] = array( 'poll'=>$value->poll,  'votes'=>$value->votes + 1);
				} else {
					$new_polls[] = array( 'poll'=>$value->poll,  'votes'=>$value->votes);
				}
			}

			// Update
			$poll = $model->updatePoll($new_polls, $id);
		}

		$poll = $model->getPoll($id);
		$options = json_decode($poll->polls);
		
		$output = JLayoutHelper::render('results', array( 'options'=>$options));

		// Set Cookie
		if($subtask != 'result') {
			$cookie->set('sp_poll_voted_' . $modid, 'yes', time()+ $params->get('lag', 12)*60*60);
		}

		die($output);

	}
}