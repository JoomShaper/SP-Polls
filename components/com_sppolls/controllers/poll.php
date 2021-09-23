<?php

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\Registry\Registry;
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\MVC\Controller\FormController;

defined('_JEXEC') or die;

class SppollsControllerPoll extends FormController
{
    public function getModel($name = 'Poll', $prefix = 'SppollsModel', $config = array()) {
		return parent::getModel($name, $prefix, $config);
    }
    
    // Get Ajax
	public function ajax()
	{
		$model 	 = $this->getModel();
		$input 	 = Factory::getApplication()->input;
		$cookie  = Factory::getApplication()->input->cookie;
		$id 	 = $input->post->get('id', NULL, 'INT');
		$subtask = $input->post->get('subtask', NULL, 'STRING');
		$vote  	 = $input->post->get('vote', NULL, 'INT');
		$modid   = $input->post->get('modid', 0, 'INT');
		$module  = $model->getModule($modid);
		$type = $input->post->get('type', NULL, 'STRING');
		
		$params  = new Registry();
		$params->loadString($module->params);
		
		$user_vote = 'yes';

		if($subtask != 'result') {
			
			if (is_null($cookie->get('sp_poll_voted_' . $modid, null))) 
			{
				$poll = $model->getPoll($id);
				$options = json_decode($poll->polls);

				$new_polls = array();

				foreach ($options as $key => $value) {
					if($key == $vote) {
						$new_polls[] = array( 'poll'=>$value->poll,  'votes'=>$value->votes + 1);
						$user_vote = base64_encode($value->poll);
					} else {
						$new_polls[] = array( 'poll'=>$value->poll,  'votes'=>$value->votes);
					}
				}

				// Update
				$poll = $model->updatePoll($new_polls, $id);
			}
			else 
			{
				die('<p></p><p class="alert alert-danger">' . Text::_('COM_SPPOLLS_ALREADY_VOTED') . '</p>');
			}
		}

		

		$poll = $model->getPoll($id);
		$options = json_decode($poll->polls);
		
		$output = LayoutHelper::render('results', array( 'options'=>$options));
		
		// Set Cookie
		if($subtask != 'result') {
			$cookie->set('sp_poll_voted_' . $modid, $user_vote, time()+ $params->get('lag', 12)*60*60);
		}

		die($output);

	}
}