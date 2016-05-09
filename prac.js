$(document).ready(function(){

    var socket = io.connect( 'http://127.0.0.1:3000' );

    $( "#messageForm" ).submit( function() {
        var nameVal = $( "#nameInput" ).val();
        var msg = $( "#messageInput" ).val();
        var receiver = $("#receiver").val();
        //var reciever = 'sdklfjsdklfjsdl';
        var roomname = nameVal + receiver;


        $.ajax({
            type: "POST",
            url: "/Chat",
            data: dataString,
            dataType: "json",
            cache : false,
            success: function(data){

                var socket = io.connect( 'http://127.0.0.1:3000' );

                socket.emit('message', {
                    name: nameVal,
                    message: msg,
                    receive : receiver
                });

                socket.emit('receiver_messages', {
                    name: nameVal,
                    message: msg,
                    receiver : receiver
                });



            } ,error: function(xhr, status, error) {
                alert(error);
            },

        });
        /*
         socket.join(roomname);
         socket.set('room', roomname);
         socket.set('nickname', nameVal);
         */
        //socket.emit('message', {name: nameVal, message: msg, receive : receiver} );

        /*// Ajax call for saving datas
         $.ajax({
         url: "./ajax/insertNewMessage.php",
         type: "POST",
         data: { name: nameVal, message: msg },
         success: function(data) {

         }
         });*/

        return false;


    });
    var socket = io.connect( 'http://127.0.0.1:3000' );
    socket.on( 'message', function( data ) {
        var actualContent = $( "#messages" ).html();
        var newMsgContent = '<li> <strong>' + data.name  + '</strong> : ' + data.message + '</li>';
        var content = newMsgContent + actualContent;

        $( "#messages" ).html( content );

    });
});



socket.on( 'receiver_messages', function( data ) {
    console.log('xxx');

});
