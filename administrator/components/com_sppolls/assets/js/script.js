/*------------------------------------------------------------------------
# SP Polls - Ajax Poll Component by JoomShaper.com
# ------------------------------------------------------------------------
# author    JoomShaper http://www.joomshaper.com
# Copyright (C) 2010 - 2018 JoomShaper.com. All Rights Reserved.
# License - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://www.joomshaper.com
-------------------------------------------------------------------------*/

jQuery(function ($) {

    // Add New Question
    $('.btn-apply').on('click', function (event) {
        event.preventDefault();
        var $this = $(this);
        var $parent = $this.parent();
        var $input = $this.parent().find('input[type="text"]');

        if ($input.val()) {
            var myClone = $parent.clone();
            myClone.addClass('poll-question').removeClass('poll-question-new').find('.btn-apply').remove();
            myClone.appendTo($('.poll-questions'));
            $input.val('');
        }
    });

    // Press Enter
    $('.poll-question-new').find('input[type="text"]').on('keyup', function (event) {
        event.preventDefault();
        if (event.keyCode == 13) {
            $('.btn-apply').click();
        }
    });

    // Remove Question
    $(document).on('click', '.btn-remove', function (event) {
        event.preventDefault();
        if (confirm("Are you confirm?")) {
            $(this).parent().remove();
        }
    });

    document.adminForm.onsubmit = function (event) {
        jsonObj = [];
        $(".poll-questions").find('input').each(function () {
            item = {};
            item["poll"] = $(this).val();
            item["votes"] = $(this).data('votes');
            jsonObj.push(item);
        });

        $('#jform_polls').val(JSON.stringify(jsonObj));
    }
});