$('#LoginName').keyup(function() {
    var username = $('#LoginName').val();
    if (username == '') {
        $('#checkLoginName').html("Bạn chưa nhập tên truy cập");
    } else {
        $('#checkLoginName').html("");
    }
})

$('#Password').keyup(function() {
    var password = $('#Password').val();
    if (password == '') {
        $('#checkPassword').html("Bạn chưa nhập mật khẩu");
    } else {
        $('#checkPassword').html("");
    }
})

function checkLoginData() {
    var check = true;
    var username = $('#LoginName').val();
    if (username == '') {
        $('#checkLoginName').html("Bạn chưa nhập tên truy cập");
        check = false;
    } else {
        $('#checkLoginName').html("");
    }
    var password = $('#Password').val();
    if (password == '') {
        $('#checkPassword').html("Bạn chưa nhập mật khẩu");
        check = false;
    } else {
        $('#checkPassword').html("");
    }
    return check;
}