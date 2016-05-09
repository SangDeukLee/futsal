
function reply_delete(delete_target){

    var target_reply = '.' +'reply' + delete_target;

    $.ajax({
        url: '/Replymore/replydelete/' + delete_target,
        type: 'POST',
        data: { "delete_target":delete_target },
        success:function(data){
            //alert(data);
            $('#space').hide();
            //$('#space_01').hide();
            $(target_reply).remove();

        }
    });
}



