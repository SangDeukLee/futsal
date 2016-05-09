<?php
    //var_dump($get_message_list);
?>
<script src="/public/assets/node_js/node_modules/socket.io/node_modules/socket.io-client/dist/socket.io.js"></script>
<script src="/public/assets/node_js/nodeClient.js"></script>
<script>
    var socket = io.connect( 'http://127.0.0.1:3000');
    socket.on( 'new_message', function( data ) {

        //console.log('도착했다눙');
        if((<?php echo "'$_SESSION[loginID]'"; ?> == data.note_receiver))
        {
            //$( "#message-tbody" ).append('<tr><td>'+data.message_content+'</td><td>'+data.message_content+'</td><td>'+data.message_content+'</td>);
            // 이미지, 이름, 내용, 시간, 체크, 읽기
            /*$( "#message-tbody" ).append('<tr><td>'
             +data.message_content+
             '</td><td>'
             + data.message_content +
             '</td><td>'
             + data.message_content +
             '</td><td>'
             + data.send_date +
             '</td><td>'
             +  data.read_status +
             '</td><td>' + );*/
            //$( "#no-message-notif" ).html('');
            //$( "#new-message-notif" ).html('<div class="alert alert-success" role="alert"> <i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>New message ...</div>');
            location.reload();
        }
    });
</script>
<section id="main-content">
    <section class="wrapper">
        <div class="col-lg-9 main-chart">

            <div class="container">
                <div id="new-message-notif"></div>
                <div class="row">
                    <div class="table-responsive">
                        <table id="mytable" class="table table-bordred table-striped">
                            <thead>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Subject</th>
                                <th>Time</th>
                                <th>Check</th>
                                <th>Read</th>
                            </thead>

                            <tbody id="message-tbody">

                            <?php

                            if(!empty($get_message_list)){

                                for($i = 0 ; $i < count($get_message_list) ; $i++) {

                                    ?>

                                    <tr>
                                        <!-- 이미지 -->
                                        <td><img class="img-circle" src="/public/img/member_s/<?=$get_message_list[$i] -> user_psimage?>" align="left"></td>

                                        <!-- 보낸사람 -->
                                        <td><?=$get_message_list[$i] -> user_send?></td>

                                        <!-- 내용 -->
                                        <td><?=$get_message_list[$i] -> message_content?></td>
                                        <!-- 보낸날짜 -->
                                        <td><?=$get_message_list[$i] -> send_date?></td>
                                        <!-- 읽음 상태-->

                                        <?php $check = "read_check".$get_message_list[$i] -> message_num; ?>
                                        <td id="<?=$check?>">

                                            <?php
                                                $check = $get_message_list[$i] -> read_status;
                                                if($check == 1) {
                                                    echo "O";
                                                }
                                                else {
                                                    echo "X";
                                                }
                                            ?>
                                        </td>
                                        <td>
                                            <a style="cursor:pointer" data-toggle="modal" data-target="#messageModal" class="detail-message" data-title="message/<?php echo $get_message_list[$i] -> user_send?>/<?php echo $get_message_list[$i] -> message_num ?>"">
                                                <span class="glyphicon glyphicon-search"></span>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php

                                }


                            } else {

                                ?>

                                <tr id="no-message-notif">
                                    <td colspan="5" align="center"><div class="alert alert-danger" role="alert">
                                            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                            <span class="sr-only"></span> No message</div>
                                    </td>
                                </tr>

                                <?php
                            }
                            ?>

                            </tbody>
                        </table>

                    </div>

                </div>
            </div>



        </div>
<!--<script src="/public/assets/node_js/node_modules/socket.io/node_modules/socket.io-client/dist/socket.io.js"></script>-->
<script>
    /*var socket = io.connect( 'http://127.0.0.1:3000');
    socket.on( 'new_message', function( data ) {
        //alert(data);
        console.log('도착ㅋ');
        //$( "#message-tbody" ).append('<tr><td>'+data.message_content+'</td><td>'+data.message_content+'</td><td>'+data.message_content+'</td>);
        if((<?php echo "'$_SESSION[loginID]'"; ?> == data.note_receiver))
        {
            //$( "#message-tbody" ).append('<tr><td>'+data.message_content+'</td><td>'+data.message_content+'</td><td>'+data.message_content+'</td>);
            //$( "#message-tbody" ).append('<tr><td>'+data.message_content+'</td>);
            //$( "#no-message-notif" ).html('');
            //$( "#new-message-notif" ).html('<div class="alert alert-success" role="alert"> <i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>New message ...</div>');

        }
    });*/
</script>