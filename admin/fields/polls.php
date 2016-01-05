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

jimport('joomla.form.formfield');

class JFormFieldPolls extends JFormField {

    protected $type = 'polls';

    protected function getInput(){

        $output = '';
        $values = json_decode($this->value);
        
        $output .= '<div class="poll-questions">';
        if(isset($values) && count($values)) {
            foreach ($values as $value) {
                $output .= '<div class="poll-question">';
                $output .= '<div><input type="text" class="span8" placeholder="Add Question" value="'. $value->poll .'" data-votes="'. $value->votes .'"><span class="votes">'. $value->votes .' ' . JText::_('COM_SPPOLLS_VOTES') . '</span></div><a class="btn btn-danger btn-remove" href="#">'. JText::_('COM_SPPOLLS_REMOVE') .'</a>';
                $output .= '</div>';
            }
        }
        $output .= '</div>'; // .poll-questions

        $output .= '<div class="poll-question-new">';
        $output .= '<div><input type="text" class="span8" data-votes="0" placeholder="Add Question"><span class="votes">0 Vote</span></div><a class="btn btn-success btn-apply" href="#">'. JText::_('COM_SPPOLLS_APPLY') .'</a><a class="btn btn-danger btn-remove" href="#">'. JText::_('COM_SPPOLLS_REMOVE') .'</a>';
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

       return count($values) . ' <small>(' . $votes . ' '. JText::_('COM_SPPOLLS_VOTES') .')</small>';
    }
}
