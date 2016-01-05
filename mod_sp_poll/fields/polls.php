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

    jimport('joomla.form.formfield');
    class JFormFieldPolls extends JFormField {

        protected $type = 'polls';

        protected function getInput(){
            $db = JFactory::getDbo();
            $query = $db->getQuery(true);
            $query->select($db->quoteName(array('sppolls_poll_id', 'title' )));
            $query->from($db->quoteName('#__sppolls_polls'));
            $query->where($db->quoteName('enabled') . ' = ' . $db->quote(1));
            $query->order('created_on DESC');
            $db->setQuery($query);  
            $results = $db->loadObjectList();

            $options = array();

            foreach($results as $poll){
                $options[] = JHTML::_( 'select.option', $poll->sppolls_poll_id, $poll->title );
            }

            $doc = JFactory::getDocument();
            JHtml::_('jquery.framework');

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
            
            return JHTML::_('select.genericlist', $options, $this->name, '', 'value', 'text', $this->value);
        }
    }
