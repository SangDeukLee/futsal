<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <script src="/public/assets/js/jquery.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" ></script>

    <title>Message</title>

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

            $('#receiver_message').val(currentPage);


        });




    </script>

</head>

<body>

<div class="container">
    <div class="row">
        <div id="notif"></div>
        <div class="col-md-6 col-md-offset-3">
            <div class="well well-sm">
                <form class="form-horizontal">
                    <fieldset>
                        <legend class="text-center">Contact us</legend>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="name">받는 사람</label>

                            <div class="col-md-9">
                                <!--<input id="name" type="text" placeholder="Your name" class="form-control" autofocus>-->
                                <input type="text" id ="receiver_message" class="form-control" value=""> </input>
                            </div>
                        </div>

                        <!--
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="subject">Subject</label>
                            <div class="col-md-9">
                                <input id="subject" type="text" placeholder="Your subject" class="form-control">
                            </div>
                        </div>
                        -->
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="message">Your message</label>
                            <div class="col-md-9">
                                <textarea class="form-control" id="message" name="message" placeholder="Please enter your message here..." rows="5"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12 text-right">
                                <button type="button" id="submit_message" class="btn btn-primary">전송</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End #messages -->

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" ></script>
<script src="/public/assets/node_js/bootstrap.js"></script>

<script src="/public/assets/node_js/node_modules/socket.io/node_modules/socket.io-client/dist/socket.io.js"></script>
<script src="/public/assets/node_js/bootstrap.js"></script>

<script>

    $(document).ready(function(){

        $("#submit_message").click(function(){

            var name = $("#receiver_message").val();

            var message = $("#message").val();

            $.ajax({
                type: "POST",
                url: "/Send/submit",
                data: { "name" : name, "message" : message },
                datatype : "json",
                cache : false,
                success: function(data){

                    $("#name").val('');
                    $("#message").val('');
                    var data_01 = JSON.parse(data);
                    var message = data.message;
                    // alert(data_01.message);
                    // alert(data_01.receive);
                    //$("#notif").html(data.notif);

                    var socket = io.connect( 'http://127.0.0.1:3000');
                    socket.emit('new_count_message', {message: data_01.message, note_receiver : data_01.receive, send_date : data_01.send_date, read_status : data_01.read_status, message_content : data_01.message_content} );


                },
                error: function(xhr, status, error) {
                    alert(error);
                },

            });

        });

    });
</script>
</body>
</html>