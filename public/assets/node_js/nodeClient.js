var socket = io.connect( 'http://127.0.0.1:3000' );



$( "#messageForm" ).submit( function() {


    var nameVal = $( "#nameInput" ).val();
    var msg = $( "#messageInput" ).val();
    var receiver = $("#receiver").val();
    var roomname = nameVal + receiver;
    var passive = $( "#passive" ).val();
    var remessage = $( "#remessage" ).val();


    if(passive == receiver) {

        socket.emit('passive_message', {name: nameVal, message: msg, receive : remessage, open_check : open_check} );
    }
    else{
        // 자식 노드 개수
        var number = $("ul.messages > li").size();
        var open_check = true;

        if(number > 0){
            socket.emit('second_message', {name: nameVal, message: msg, receive : receiver, open_check : open_check});
        }
        else{
            //alert('name : ' + nameVal + 'receiver : ' + receiver);
            socket.emit('message', {name: nameVal, message: msg, receive : receiver, open_check : open_check} );
        }
    }


    /*// Ajax call for saving datas
     $.ajax({
     url: "./ajax/insertNewMessage.php",
     type: "POST",
     data: { name: nameVal, message: msg },
     success: function(data) {

     }
     });*/


    //socket.emit('message', {name: nameVal, message: msg, receive : receiver});

    /*socket.emit('receiver_messages', {
        name: nameVal,
        message: msg,
        receiver : receiver
    });*/

    return false;
});




