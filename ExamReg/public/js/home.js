$(document).ready(function() {
    $("td > input").change(function() {
        current_input = $(this);
        data = [];
        $('tr:has(td)').each(function() {
            if ($(this).children().find('input:checked').length > 0) {
                data.push({
                    date: $(this).attr("data-date"),
                    ca: $(this).attr("data-ca"),
                    maca: $(this).attr("data-maca"),
                    tenhp: $(this).attr("data-tenhp")
                })
            }
        });
        $.ajax({
            url: 'schedule/checkSameSchedule',
            data: {
                list: data
            },
            type: 'get',
            dataType: 'json',
            success: function(response) {
                $('tr').css('background-color', 'white');
                $('tr > td > input').prop("disabled", false);
                $.each(response.disable, function(index, value) {
                    $('tr[data-maca=' + value + ']').css('background-color', 'lightsalmon');
                    $('tr[data-maca=' + value + '] > td > input').prop('checked', false);
                    $('tr[data-maca=' + value + '] > td > input').prop("disabled", true);
                });
                $('tr:has(td)').each(function() {
                    if ($(this).children().find('input:checked').length > 0) {
                        $(this).css('background-color', 'aqua');
                    }
                });
            }
        });
    })
})