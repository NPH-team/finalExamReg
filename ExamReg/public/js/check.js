document.addEventListener("DOMContentLoaded", function() {
    var count = document.getElementsByClassName("count");
    var nut = document.getElementsByClassName("nut");
    var total = document.getElementsByClassName("total");
    for (var i = 0; i < count.length; i++) {
        if (count[i].innerHTML === total[i].innerHTML) {
            nut[i].classList.add('an');

        }
    }
});

$(document).ready(function() {
    $(function() {
        $('#tb1 #action').click(function(e) {
            var maca = $(this).closest('.row_sb').find('td:nth-child(1)').text();
            var mamon = $(this).closest('.row_sb').find('td:nth-child(2)').text();
            var tenmon = $(this).closest('.row_sb').find('td:nth-child(3)').text();
            var cathi = $(this).closest('.row_sb').find('td:nth-child(4)').text();
            var phongthi = $(this).closest('.row_sb').find('td:nth-child(5)').text();
            var ngaythi = $(this).closest('.row_sb').find('td:nth-child(6)').text();
            var maki = $(this).closest('.row_sb').find('td:nth-child(11)').text();


            var row = document.getElementsByClassName("row_sb");
            var row_test = document.getElementsByClassName("row_kq");
            var nut = document.getElementsByClassName("nut");

            //khi nhấn checkbox trạng thái checked = true
            if ($(this).is(":checked")) {
                //gán giá trị đăng ký vào bảng ketqua
                var markup = "<tr class='row_kq'><td class = 'maca center' name = 'maca'>" +
                    maca + "</td><td class = 'center' name = 'tenmh'>" +
                    tenmon + "</td><td class = 'center' name = 'mamh'>" +
                    mamon + "</td><td class = 'center' name = 'cathi'>" +
                    cathi + "</td><td class = 'center' name = 'phongthi'>" +
                    maki + "</td><td class = 'center' name = 'maky'>" +
                    phongthi + "</td><td class='center' name = 'ngaythi'>" +
                    ngaythi + "</td><td><span  class='fa fa-times' aria-hidden='true' id='remove' onclick='remove(this)'></span></td>";
                $('.ketqua').append(markup);
                $(this).val('true'); //gán giá trị value[isdangky] = true khi được chọn

                //vô hiệu hóa các checkbox cùng môn đã đăng ký
                // for (var i = 0; i < row.length; i++) {
                //     var mamon_check = $(row[i]).closest('.row_sb').find('td:nth-child(2)').text();

                //     var cathi_check = $(row[i]).closest('.row_sb').find('td:nth-child(4)').text();
                //     var ngaythi_check = $(row[i]).closest('.row_sb').find('td:nth-child(6)').text();
                //     console.log(check);
                //     var check = $(row[i]).closest('.row_sb').find('.chon').prop('value'); //lấy ra giá trị của thuộc tính value trong checkbox
                //     $(this).closest('.row_sb').addClass('onColor');
                //     //nếu cùng môn và cùng trùng lịch thì vô hiệu hóa checkbox
                //     if (mamon_check == mamon && check == "false" || cathi_check == cathi && ngaythi_check == ngaythi && check == "false") {
                //         console.log("true")
                //         $(row[i]).closest('.row_sb').find('.chon').prop('disabled', true);
                //         $(row[i]).closest('.row_sb').addClass('onColor');
                //     }
                // }
            }

            //khi nhấn checkbox trạng thái checked = false
            else if ($(this).is(":not(:checked)")) {
                //xóa môn dưới bảng kết quả
                for (var i = 0; i < row_test.length; i++) {
                    var test = $(row_test[i]).closest('.row_kq').find('td:nth-child(1)').text();
                    if (test == maca) {
                        $(row_test[i]).closest('.row_kq').remove();
                    }
                }
                //hiển thị lại các checkbox bị vô hiệu hóa
                for (var i = 0; i < row.length; i++) {
                    var mamon_check = $(row[i]).closest('.row_sb').find('td:nth-child(3)').text();
                    var cathi_check = $(row[i]).closest('.row_sb').find('td:nth-child(4)').text();
                    var ngaythi_check = $(row[i]).closest('.row_sb').find('td:nth-child(6)').text();
                    var check = $(row[i]).closest('.row_sb').find('.chon').prop('value');
                    $(this).closest('.row_sb').removeClass('onColor');
                    //nếu cùng môn và cùng trùng lịch thì mở checkbox
                    if (mamon_check == mamon && check == "false" || cathi_check == cathi && ngaythi_check == ngaythi && check == "false") {
                        $(row[i]).closest('.row_sb').find('.chon').attr('disabled', false);
                        $(row[i]).closest('.row_sb').removeClass('onColor');
                        $(this).val('false'); //set lại giá trị cho isdangki = false khi không đc chọn
                    }
                }
            }
        });

    });
})