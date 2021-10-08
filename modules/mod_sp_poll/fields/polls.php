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
use Joomla\CMS\Form\FormField;
use Joomla\CMS\HTML\HTMLHelper;

class JFormFieldPolls extends FormField {

    protected $type = 'polls';

    protected function getInput(){
        $db = Factory::getDbo();
        $query = $db->getQuery(true);
        $query->select($db->quoteName(array('id', 'title' )));
        $query->from($db->quoteName('#__sppolls_polls'));
        $query->where($db->quoteName('published') . ' = ' . $db->quote(1));
        $query->order('created DESC');
        $db->setQuery($query);  
        $results = $db->loadObjectList();

        $options = array();

        foreach($results as $poll){
            $options[] = HTMLHelper::_( 'select.option', $poll->id, $poll->title );
        }

        $doc = Factory::getDocument();
        HTMLHelper::_('jquery.framework');

        $js = <<<JS
        jQuery(function($){
        if ($('#jform_params_poll_type').val() == 'single') {
            $('#jformparamspoll_id').parent().parent().show();
        } else {
            $('#jformparamspoll_id').parent().parent().hide();
        }

        $('#jform_params_poll_type').on('change', function(){
        if ($(this).val() == 'single') {
            $('#jformparamspoll_id').parent().parent().show();
        } else {
            $('#jformparamspoll_id').parent().parent().hide();
        }
        });

        });
        JS;

$doc->addScriptDeclaration($js);
        
        return HTMLHelper::_('select.genericlist', $options, $this->name, '', 'value', 'text', $this->value);
    }
}
