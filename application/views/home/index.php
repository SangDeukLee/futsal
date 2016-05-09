<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>풋살</title>

    <link href="/public/assets/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="/public/assets/css/login.css" />

    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

    <script src="/public/assets/js/bootstrap.min.js"></script>
    <script src="/public/assets/js/login.js"></script>
    <script type="text/javascript" src=" http://code.jquery.com/jquery-latest.min.js"></script>
    <script type="text/javascript" src="/public/assets/js/jquery.fadewidebgimg/js/jquery.FadeWideBgImg.js"></script>
    <script type="text/javascript">
        (function($){
            jQuery(document).ready(function(){
                $('.slideshow').FadeWideBgImg({interval:1000,height:947});
            });
        }(window.jQuery,window));
    </script>
</head>
<body>
<?php
if(isset($alertCode)) {
    if($alertCode == -1){ ?>
        <script>
            window.alert('비밀번호가 다릅니다.')
            history.go(-1)
        </script>

<?php exit; } else { ?>
        <script>
            window.alert('등록되지 않은 아이디입니다..')
            history.go(-1)
        </script>
<?php }} ?>
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

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="wrap">

                <p class="form-title">my futsal</p>
                <form class="login" action="/Member/loginCheck/" method="POST">
                    <input type="text" class="form-control" name="id" placeholder="Username" required="" autofocus="" />
                    <input type="password" class="form-control" name="pass" placeholder="Password" required=""/>
                    <input type="submit" name="submit_login" value="Sign In" class="btn btn-default btn-sm" />
                    <div class="remember-forgot">
                        <div class="row">
                            <div class="col-xs-6">
                                <a href="/Member/findIdV">Forgot ID?</a>

                            </div>
                            <div class="col-xs-6">
                                <a href="Member/findPwV">Forgot Password?</a>
                            </div>
                        </div>
                        <div class="form-group divider">
                            <hr class="left"><small><font color="white">New to site?</font></small><hr class="right">
                        </div>
                        <p class="form-group btn btn-info btn-block"><a href="/Member/joinV/">Create an account</a></p>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
</ul>
</body>
</html>
