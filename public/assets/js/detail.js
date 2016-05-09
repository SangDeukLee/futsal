$(document).ready(function() {
    // 사람인 경우
    $('#userModal').on('show.bs.modal', function (event) {


        var button = $(event.relatedTarget);
        var titleTxt = button.data('title');
        var modal = $(this);
        var strArray = titleTxt.split('/');



        // 사람인 경우(people/user_id)
        $.ajax({

            url:'/Detail',
            type : 'post',
            data : {"param": titleTxt},

            success:function(data){

                modal.find('.modal-title').html(strArray[1]);
                modal.find('.modal-body').html(data);

                /*alert($('#star').text());*/

                if($('#star').text() == "YES"){
                    // 검은별
                    /*document.write('yes..');*/
                    $('#check').removeClass('star').addClass('glyphicon glyphicon-star');
                }

                else {
                    // 하얀별
                    /*document.write('no..');*/
                    $('#check').removeClass('star').addClass('glyphicon glyphicon-star-empty');
                }

                $('#star').hide();

            }
        })
    });

    // 팀인 경우
    $('#teamModal').on('show.bs.modal', function (event) {

        var button = $(event.relatedTarget);
        var titleTxt = button.data('title');
        var modal = $(this);
        var strArray = titleTxt.split('/');

        $.ajax({

            url:'/Detail',
            type : 'post',
            data : {"param": titleTxt},

            success:function(data){

                modal.find('.team-modal-title').html(strArray[1]);
                modal.find('#team-modal-body').html(data);

                if($('#starT').text() == "YES"){

                    // 검은별
                    /*document.write('yes..');*/
                    $('#checkT').removeClass('starT').addClass('glyphicon glyphicon-star');
                }

                else {

                    // 하얀별
                    /*document.write('no..');*/
                    $('#checkT').removeClass('starT').addClass('glyphicon glyphicon-star-empty');
                }

                $('#starT').hide();

            }
        })
    });

    // 소속팀인 경우(ownTeam/user_id)
    $('#ownTeamModal').on('show.bs.modal', function (event) {


        var button = $(event.relatedTarget);
        var titleTxt = button.data('title');
        var modal = $(this);
        var strArray = titleTxt.split('/');


        // 소속팀인 경우(people/user_id)
        $.ajax({

            url:'/Detail',
            type : 'post',
            data : {"param": titleTxt},

            success:function(data){

                modal.find('.modal-title').html(strArray[1]);
                modal.find('.modal-body').html(data);

            }
        })
    });

    // 메세지인 경우
    $('#messageModal').on('show.bs.modal', function (event) {

        var button = $(event.relatedTarget);
        var titleTxt = button.data('title');
        var modal = $(this);
        var strArray = titleTxt.split('/');
        // alert(strArray[2]);
        var check = '#' + 'read_check' + strArray[2];

        //alert(check);
        // 소속팀인 경우(people/user_id)
        $.ajax({

            url:'/Detail',
            type : 'post',
            data : {"param": titleTxt,"message_num" : strArray[2]},

            success:function(data){
                // alert(data);

                $(check).html('O');
                modal.find('.modal-title').html(strArray[1]);
                modal.find('.modal-body').html(data);

                $.ajax({
                    url:'/Message/get_list_01',
                    type : 'post',

                    success:function(data) {

                        if(data != 0) {
                            $('#note').html(data);
                        }
                        else {
                            $('#note').empty();
                        }
                    }
                });

            }
        });


    });

});
