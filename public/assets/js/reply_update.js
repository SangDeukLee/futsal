$(document).ready(function() {

});


function reply_update_ready(update_reply){


    var update_reply_num ='#' + 'update' + update_reply;
    //alert(update_reply_num);
    $(update_reply_num).empty();
    $('#reply_update_ready').hide();
    $('#reply_delete').hide();

    reply_update_url("/Reply_more", update_reply, "post");
}



// 동적으로 form생성
function reply_update_url(path,  update_reply, method) {

    var update_reply_num ='#' + 'update' + update_reply;
    var form_title = 'update_form' + update_reply;

    method = method || "post";  //method 부분은 입력안하면 자동으로 post가 된다.
    var form = document.createElement("form");
    form.setAttribute("method", method);
    form.setAttribute("id", form_title);
    form.setAttribute("name", form_title);
    form.setAttribute("action", path);

    var hiddenField_01 = document.createElement("input");
    hiddenField_01.setAttribute("type", "text");
    hiddenField_01.setAttribute("name", "update_reply_content");
    hiddenField_01.setAttribute("placeholder", "수정할 내용을 입력하세요.");
    /*hiddenField_01.setAttribute("placeholder", "수정할 내용을 입력하세요.");*/
    hiddenField_01.setAttribute("style", "min-height: 3em; min-width: 30em; border : 1px solid black");


    var hiddenField_02 = document.createElement("input");
    hiddenField_02.setAttribute("type", "hidden");
    hiddenField_02.setAttribute("name", update_reply);

    var hiddenField_03 = document.createElement("input");
    hiddenField_03.setAttribute("type", "button");
    hiddenField_03.setAttribute("onclick", "go_update(" + update_reply +"," + '\'' + form_title + '\''+ ")");
    hiddenField_03.setAttribute("value", "수정");

    form.appendChild(hiddenField_01);
    form.appendChild(hiddenField_02);
    form.appendChild(hiddenField_03);

    $(update_reply_num).append(form);
}

// 수정 버튼 누를 시 처리
function go_update(update_reply, form_title){

    var frm = '#' + form_title;
    var formData = $(frm).serialize();
    //alert(formData);
    var removeForm = '#' + 'update' + update_reply;
    var update_reply_num ='#' + 'update' + update_reply;

    $.ajax({
        url: '/Replymore/replyupdate/' + update_reply,
        type: 'POST',
        cache : false,
        data : formData,
        success:function(data){
            //alert(data);
            $(removeForm).empty();
            $(update_reply_num).append(data);
            $('#reply_update_ready').show();
            $('#reply_delete').show();

            //alert(data);
        }
    });

}
