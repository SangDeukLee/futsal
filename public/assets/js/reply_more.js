
$(document).ready(function() {


});

function reply_go(reply_last_num, limit, parent_board){

    var reply = '#' + reply;
    var button_num = '#' + reply_last_num;
    var div_num = '#'+'div' + reply_last_num;
    $.ajax({
        url: '/Replymore',
        type: 'POST',
        data: { "reply_last_num":reply_last_num, "limit" : limit, "parent_board" : parent_board},
        success:function(data){
            $(button_num).remove();
            $(div_num).append(data);

        }
    });
}




