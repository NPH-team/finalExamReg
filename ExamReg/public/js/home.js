$(document).ready(function() {
    $("td > input").change(function() {
        current_input = $(this);
        data = [];
        $('tr:has(td)').each(function() {
            if ($(this).children().find('input:checked').length > 0) {
                data.push({
                    date: $(this).attr("data-date"),
                    ca: $(this).attr("data-ca"),
                    maca: $(this).attr("data-maca")
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
    var r = document.getElementById("loadata").rows;
    for (i = 1; i < r.length; i++) {
        a = r[i].cells[1].getElementsByClassName('ngay');
        // console.log(a);
        for (let j = 1; j < r[i].cells.length; j++) {

            // console.log(r[i].cells[3].firstChild.nodeValue);
            let check = r[i].cells[0].getElementsByClassName('choose');
            // console.log(check[0].checked);
            r[i].cells[j].onclick = function() {
                // if (check[0] == true) check[0] = false;
                // else check[0] = true;
                check[0].click();
                if (check[0].checked) {

                }
            };
        }
    }
    // var refTab = document.getElementById("loadata")
    // var ttl;
    // for (var i = 1; row = refTab.rows[i]; i++) {
    //     row = refTab.rows[i];
    //     for (var j = 1; col = row.cells[j]; j++) {
    //         console.log(col.firstChild.nodeValue);
    //     }
    // }
});