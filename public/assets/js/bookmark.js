$(document).ready(function() {


    $('#bookmarkU').click(function(){

        // id값 가져옴
        var user_id = $('#userModalLabel').text();

        // 즐겨찾기 추가 된 경우
        if($('#check').attr('class') == "glyphicon glyphicon-star") {

            var check = "delete";

            $.ajax({

                // 회원가입 거쳐서 바로 삭제
                url: '../../../Bookmark',
                type: 'POST',
                data: { "user_id" : user_id, "check" : check },
                success:function(data){

                    location.reload();     // 새로고침
                }
            });
        }

        // 즐겨찾기 추가 안 된 경우
        else if($('#check').attr('class') != "glyphicon glyphicon-star") {

            var check = "insert";

            $.ajax({

                // 회원가입 거쳐서 바로 삭제
                url: '../../../Bookmark',
                type: 'POST',
                data: { "user_id" : user_id, "check" : check },
                success:function(data){
                    location.reload();     // 새로고침
                }
            });
        }
    });


$('#bookmarkT').click(function(){

    // id값 가져옴
    var team_name = $('#teamModalLabel').text();

    // 즐겨찾기 추가 된 경우
    if($('#checkT').attr('class') == "glyphicon glyphicon-star") {

        var check = "delete";

        $.ajax({
            // 회원가입 거쳐서 바로 삭제
            url: '/Bookmark/team_book',
            type: 'POST',
            data: { "team_name" : team_name, "check" : check },
            success:function(data){
                location.reload();     // 새로고침
            }
        });
    }

    // 즐겨찾기 추가 안 된 경우
    else if($('#checkT').attr('class') != "glyphicon glyphicon-star") {

        var check = "insert";

        $.ajax({

            // 회원가입 거쳐서 바로 삭제
            url: '/Bookmark/team_book',
            type: 'POST',
            data: { "team_name" : team_name, "check" : check },
            success:function(data){

                //modal.find('.modal-body').append(data);
                location.reload();     // 새로고침
            }
        });
    }



});


});