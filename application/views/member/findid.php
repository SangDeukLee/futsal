<?php
if($user_id==null) { ?>
    <script>
        window.alert('아이디가 없습니다')
        history.go(-1)
    </script>

<?php }else{
    echo "아이디 :".$user_id;

}?>
<head>
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script type="text/javascript" src="../common/js/jquery-1.8.3.min.js" charset="euc-kr"></script>
    <script type="text/javascript" src=" http://code.jquery.com/jquery-latest.min.js"></script>
<script type="text/javascript" src="/public/assets/js/jquery.fadewidebgimg/js/jquery.FadeWideBgImg.js"></script>
<script type="text/javascript">
    (function ($) {
        jQuery(document).ready(function () {
            $('.slideshow').FadeWideBgImg({interval: 1000, height: 899});
        });
    }(window.jQuery, window));
</script>



</head>
<body>
<ul class="slideshow">

    <li><img src="http://cfile6.uf.tistory.com/image/1337843D509667C3264DDA"></li>
    <li><img src='http://image.fmkorea.com/files/attach/images/3658281/866/244/010/9cda4d3ad19656d3917d0b6461a59e01.jpg' ></li>
    <li><img src="http://www.matcl.com/files/2013/03/02/53612a23fcb63c21f7c48bfd48d688af222928.jpg"></li>
    <li><img src="http://www.matcl.com/files/2013/02/15/6cb5d5e6223f597ec2fd388a346f0f76195910.jpg"></li>
    <li><img src="http://data.shootgoal.com/userfiles/bbs/201111/02/5562059393.jpg"></li>
    <li><img src="http://file.instiz.net/data/file/20121116/2/3/4/2345feaa5246b8fd0fe27646f6c018e4"></li>
    <li><img src="http://data.shootgoal.com/userfiles/bbs/201111/02/1155041768.jpg"></li>
    <li><img src="http://file.instiz.net/data/file/20121116/f/2/d/f2dd48a8673d43fb94964536d90c0e8a"></li>
    <li><img src="http://file2.instiz.net/data/file2/2015/10/30/6/0/e/60e479f9fc68a350ceea6a834742ddfc.jpg"></li>
    <li><img src="http://image.fmkorea.com/files/attach/images/3658281/354/196/010/f7283c05724accdabe28637244be3f7c.jpg"></li>
<br/>
<button onclick="location.href='/home/index'">로그인 화면으로</button>
<button onclick="location.href='/member/findPw'">비밀번호 찾기</button>
    </body>
