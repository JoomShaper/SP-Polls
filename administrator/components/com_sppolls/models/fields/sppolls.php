<?php
/*------------------------------------------------------------------------
# SP Polls - Ajax Poll Component by JoomShaper.com
# ------------------------------------------------------------------------
# author    JoomShaper http://www.joomshaper.com
# Copyright (C) 2010 - 2021 JoomShaper.com. All Rights Reserved.
# License - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://www.joomshaper.com
-------------------------------------------------------------------------*/
defined ('_JEXEC') or die('resticted aceess');

use Joomla\CMS\Language\Text;
use Joomla\CMS\Form\FormField;


class JFormFieldSppolls extends FormField {

    protected $type = 'sppolls';

    protected function getInput(){

        $output = '';
        $values = json_decode($this->value);
        
        $output .= '<div class="poll-questions">';
        if(isset($values) && count($values)) {
            foreach ($values as $value) {
                $output .= '<div class="poll-question input-group">';
                $output .= '<div><input type="text" class="form-control" placeholder="Add Question" value="'. $value->poll .'" data-votes="'. $value->votes .'"><span class="votes">'. $value->votes .' ' . Text::_('COM_SPPOLLS_VOTES') . '</span></div><a class="btn btn-danger btn-remove" href="javascript:">'. Text::_('COM_SPPOLLS_REMOVE') .'</a>';
                $output .= '</div>';
            }
        }
        $output .= '</div>'; // .poll-questions

        $output .= '<div class="poll-question-new input-group">';
        $output .= '<div><input type="text" class="form-control" data-votes="0" placeholder="Add Question"><span class="votes">0 Vote</span></div><a class="btn btn-success btn-apply" href="javascript:">'. Text::_('COM_SPPOLLS_APPLY') .'</a><a class="btn btn-danger btn-remove" href="#">'. Text::_('COM_SPPOLLS_REMOVE') .'</a>';
        $output .= '</div>';

        $output .= '<input name="'. $this->name .'" id="'. $this->id .'" type="hidden" value="'. $this->value .'">';

        return $output;
        
    }

    public function getRepeatable() {

        $votes  = 0;
        $values = json_decode($this->value);
        
        if(isset($values) && count($values)) {
            foreach ($values as $value) {
                $votes = $votes + $value->votes;
            }
        }

       return count($values) . ' <small>(' . $votes . ' '. Text::_('COM_SPPOLLS_VOTES') .')</small>';
    }
}
