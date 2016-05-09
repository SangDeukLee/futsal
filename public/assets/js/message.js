/**
 * Created by SDLee on 2016-03-02.
 */
$(document).ready(function (){
    $('#message').click(function() {
        var receive = $('#userModalLabel').text();
        window.open('/message.php/' + receive, 'sender', 'width=250, height=400, scrollbars=0, resizable=0');
    })
});