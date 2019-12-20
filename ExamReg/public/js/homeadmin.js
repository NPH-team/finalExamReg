$('#exams').click(function() {
    var className = $('#exam').attr('class');
    if (className == 'display') {
        $('#exam').removeClass('display');
        $('#exam').addClass('none');
    } else {
        $('#exam').removeClass('none');
        $('#exam').addClass('display');
    }
});