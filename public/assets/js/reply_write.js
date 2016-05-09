/**
 * Created by SDLee on 2016-02-16.
 */

//var writeButton ='#' + writeButton;
function clicked(time_num){
    var ReadingInfoSelectForm = '#' + 'ReadingInfoSelectForm' + time_num;
    var ReadingInfoSelectForm_text = ReadingInfoSelectForm + ' input[type=text]';


    // var writeId = $("#ReadingInfoSelectForm input[type=button]").attr('id');
    var formData = $(ReadingInfoSelectForm).serialize();
    var new_write_location = '#' + 'new_write_location' + time_num;

    //alert('time_num : ' + time_num);
    $.ajax({
        url: '/Replymore/replywrite/' + time_num,
        type: 'POST',
        cache : false,
        data : formData,
        success:function(data){
            // alert(ReadingInfoSelectForm_text);

            $(ReadingInfoSelectForm_text).val('');
            $(new_write_location).prepend(data);

        }
    });
}