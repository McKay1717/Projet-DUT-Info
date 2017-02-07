(function ($) {

    //error symfony
    var $li = $('form fieldset ul li');
    $li.parent().css({
        'list-style': 'none',
        'margin-left': '-40px',
    });
    $li.addClass('alert alert-danger');

    //upload
    $(":file").filestyle({
        buttonName: "btn-info"
    });

    //datepicker
    $('.datetime').datetimepicker({
        todayBtn:"true",
        dateformat:"dd/mm/yyyy (hh:ii)",
        autoclose:"true",
        pickerPosition:"bottom-left",
        startView:"year",
        minView:"hour",
        language:"fr"
    });

})(jQuery);
