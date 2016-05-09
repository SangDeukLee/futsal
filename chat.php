<?php
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <script src="/public/assets/js/jquery.js"></script>
    <title>Chatting</title>

    <link rel="stylesheet" href="/public/assets/css/bootstrap.css" />
    <style type="text/css">body { padding-top: 60px; }</style>
    <link rel="stylesheet" href="/public/assets/css/bootstrap-responsive.css" />
    <script src="/public/assets/node_js/node_modules/socket.io/node_modules/socket.io-client/dist/socket.io.js"></script>
    <script>
        $(document).ready(function(){
            var currentPage = document.location.href;
            //현재 전체 주소를 가져온다. 예) http://www.naver.com
            var passive_check = currentPage.split('/');


            currentPage = currentPage.slice(7);
            //slice를 이용하여 앞에 http:// 빼고 가져올 수 있다. slice는 특정 인덱스부터 잘라낸다.

            arr = currentPage.split("/");
            //URL의 "/" 뒤에 나오는 값을 화용하여 split 이용하여 자를 수 있다.

            currentPage = arr[2];
            //  "/"에서 자른 것들을 배열로 저장되는데 2로 하면 2번째 위치 값이 내가 얻고자하는 값이다.
            //alert(currentPage);
            var remessage = arr[3];

            //document.getElementById('receiver').value = '1';



            $('#receiver').val(currentPage);
            $('#remessage').val(remessage);
            var socket = io.connect( 'http://127.0.0.1:3000' );
            if(passive_check.length > 5) {

                var nameVal = $( "#nameInput" ).val();
                var msg = $( "#messageInput" ).val();
                var receiver = $("#receiver").val();
                var remessage = $( "#remessage" ).val();

               /* alert(remessage);
                alert(nameVal);*/


                socket.emit('join', {name: nameVal, receive : remessage} );
            }

            socket.on( 'join_response', function( data ) {
                if((<?php echo "'$_SESSION[loginID]'"; ?> == data.name))
                {
                    var actualContent = $("#messages").html();

                    var newMsgContent = '<li> <strong>' + data.name + '</strong> : ' + data.message + '</li></div>';
                    var content = newMsgContent + actualContent;

                    $("#messages").html(content);
                }
                else {
                    var actualContent = $("#messages").html();
                    var newMsgContent = '<li style="margin-left: 350px">' + data.message + '<strong> : ' + data.name + '</strong>'+ '</li>';
                    var content = newMsgContent + actualContent;

                    $("#messages").html(content);
                }
            });
        });




    </script>

</head>

<body>
<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">

        </div>
    </div>
</div>

<div class="container">
    <h1></h1>
    <p>

    </p>
</div>
<!-- 세션 받을 자리 -->
<div>


</div>
<form class="form-inline" id="messageForm" name="chatform">
    <input id="passive" type="hidden" value="<?=$_SESSION['loginID'];?>" readonly/>
    <input id="receiver" type="hidden" value="" readonly/>
    <input id="remessage" type="hidden" value="" readonly/>
    <input id="nameInput" type="hidden" class="input-medium"  value="<?=$_SESSION['loginID']?>" readonly/>
    <input id="messageInput" type="text" size="50" class="input-xxlarge" placeHolder="Message" style="height: 50px"/>

    <input class="btn btn-default" type="submit" value="Send" />
</form>

<div>
    <ul id="messages" class="messages" style="list-style:none; padding-left:0px;">


    </ul>
</div>
<!-- End #messages -->

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" ></script>
<script src="/public/assets/node_js/bootstrap.js"></script>
<!--
<script src="/public/assets/node_js/node_modules/socket.io/node_modules/socket.io-client/dist/socket.io.js"></script>
-->
<script src="/public/assets/node_js/node_modules/socket.io/node_modules/socket.io-client/dist/socket.io.js"></script>
<script src="/public/assets/node_js/nodeClient.js"></script>
<script>
    var socket = io.connect( 'http://127.0.0.1:3000' );
    socket.on( 'message', function( data ) {
        if((<?php echo "'$_SESSION[loginID]'"; ?> == data.name))
        {
            var actualContent = $("#messages").html();
            var newMsgContent = '<li> <strong>' + data.name + '</strong> : ' + data.message + '</li>';
            var content = newMsgContent + actualContent;

            $("#messages").html(content);
        }
        else {
            var actualContent = $("#messages").html();
            var newMsgContent = '<li style="margin-left: 350px">' + data.message + '<strong> : ' + data.name + '</strong>'+ '</li>';
            var content = newMsgContent + actualContent;

            $("#messages").html(content);
        }
    });


    //var socket = io.connect( 'http://127.0.0.1:3000' );
    socket.on( 'passive_message', function( data ) {
        if((<?php echo "'$_SESSION[loginID]'"; ?> == data.name))
        {
            var actualContent = $("#messages").html();
            var newMsgContent = '<li> <strong>' + data.name + '</strong> : ' + data.message + '</li>';
            var content = newMsgContent + actualContent;

            $("#messages").html(content);
        }
        else {
            var actualContent = $("#messages").html();
            var newMsgContent = '<li style="margin-left: 350px">' + data.message + '<strong> : ' + data.name + '</strong>'+ '</li>';
            var content = newMsgContent + actualContent;

            $("#messages").html(content);
        }
    });

    socket.on( 'second_message', function( data ) {
        if((<?php echo "'$_SESSION[loginID]'"; ?> == data.name))
        {
            var actualContent = $("#messages").html();
            var newMsgContent = '<li> <strong>' + data.name + '</strong> : ' + data.message + '</li>';
            var content = newMsgContent + actualContent;

            $("#messages").html(content);
        }
        else {
            var actualContent = $("#messages").html();
            var newMsgContent = '<li style="margin-left: 350px">' + data.message + '<strong> : ' + data.name + '</strong>'+ '</li>';
            var content = newMsgContent + actualContent;

            $("#messages").html(content);
        }
    });
    /*socket.on( 'message', function( data ) {
        var actualContent = $( "#messages" ).html();
        var newMsgContent = '<li> <strong>' + data.name  + '</strong> : ' + data.message + '</li>';
        var content = newMsgContent + actualContent;

        $( "#messages" ).html( content );

    });*/

</script>
</body>
</html>