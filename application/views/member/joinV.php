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
    <script src="/public/assets/js/join.js"></script>
    <script src="/public/assets/js/homeground.js"></script>
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
<body onload = "init(this.form);">
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
<div class="align_center">
<div class="container2">
    <div class="row">
        <div class="panel panel-primary">
            <div class="panel-body">
                <form name="form" method="POST" action="/Member/join/" role="form" enctype="multipart/form-data">
                    <div class="form-group">
                        <h2>Create account</h2>
                    </div>
                    <div class="form-group">
                        <label class="control-label">ID</label>
                        <input id="notHangul" type="text" name="id" maxlength="50" class="form-control" placeholder="only English and Number">
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="signupPassword">Password</label>
                        <input id="signupPassword" name="pass" type="password" maxlength="25" class="form-control" placeholder="at least 6 characters" length="40">
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="signupEmail">Email</label>
                        <input id="signupEmail" name="email" type="email" maxlength="50" class="form-control">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Phone</label>
                        <input type="tel" name="phone" maxlength="50" class="form-control">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Ability</label>
                        <input type="text" name="ability" maxlength="50" class="form-control">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Home Ground</label><br>
                        <select name="home[]" id="first" class="form-control" style="width:110px;" onchange="itemChange(this.form);" ></select>
                        <select name="home[]" id="second" class="form-control" style="width:110px;" ></select>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Select File</label>
                        <input name="pfimage" type="file" class="file">
                    </div>
                    <div class="form-group">
                        <button type="reset" class="btn btn-warning btn-block">Reset</button>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="submit_join" value="Create your account" class="btn btn-info btn-block">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
    </ul>
</body>
</html>
