
/*$(document).ready(function() {
    $('#chat').click(function(){
        document.write('sdfsd');
    })
});*/

function start(loginId){
    // var id = '#' + loginId;
    // alert(loginId);
    // document.write(loginId);
    // socket.emit('loignId', loginId);
    // window.open('http://127.0.0.1:3000/chat.html','win','width=500,height=700,toolbar=0,scrollbars=0,resizable=0')
}
$(document).ready(function(){
    $('#chat').click(function(){
        var receive = $('#userModalLabel').text();

        /*$.ajax({

            // 회원가입 거쳐서 바로 삭제
            url: '/chat.php',
            type: 'POST',
            data: {},
            success:function(data){
                $('#receiver').val(receive);
                window.open('/chat.php','win','width=500,height=700,toolbar=0,scrollbars=0,resizable=0');
            }
        });*/



        window.open('/chat.php/' + receive,'first','width=500,height=700,toolbar=0,scrollbars=0,resizable=0');



    })
});

