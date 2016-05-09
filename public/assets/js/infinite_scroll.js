
var is_loading = false;
var limit = 5;

$(function() {

    var link = document.location.href;
    var category = link.split('/');

    $(window).scroll(function() {

        if(Math.ceil($(window).scrollTop() + $(window).height()) == $(document).height()) {

            $('#loader').show();

            setTimeout(function(){

                // 용병모집 무한스크롤
                if (is_loading == false && category[3] == "Supporter") {

                    is_loading = true;

                    $.ajax({

                        url: '/Supporter/getList',
                        type: 'POST',
                        data: { "last_num":last_num, "limit" : limit, "is_loading" : is_loading },
                        success:function(data){

                            $('#loader').hide();
                            $('#scroll').html(data);
                            is_loading = false;
                        }
                    });
                }

                // 팀원모집 무한스크롤
                if (is_loading == false && category[3] == "Recruit") {

                    is_loading = true;

                    $.ajax({

                        url: '/Recruit/getList',
                        type: 'POST',
                        data: { "last_num":last_num, "limit" : limit, "is_loading" : is_loading },
                        success:function(data){

                            $('#loader').hide();
                            $('#scroll').html(data);
                            is_loading = false;
                        }
                    });
                }


                // 마이페이지 무한스크롤
                else if (is_loading == false && category[3] == "Mypage") {

                    is_loading = true;
                    var user_id = $('#user_id').text();
                    //alert('last_notice_num : ' + last_notice_num);
                    $.ajax({

                        url: '/Mypage',
                        type: 'POST',
                        data: { "last_notice_num":last_notice_num, "limit" : limit, "is_loading" : is_loading, "user_id" : user_id},

                        success:function(data){

                            $('#loader').hide();
                            $('#haha ul').append(data);


                            is_loading = false;
                        }
                    });
                }
            },0);

        }
    });
});


