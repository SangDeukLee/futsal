<?php
if ($team_check) { ?>
    <script>
        window.alert('팀 리더는 팀 생성이 불가능 합니다')
        history.go(-1)
    </script>
<?php } else { ?>
    <html xmlns="http://www.w3.org/1999/html">
    <body onload="init(this.form);">
    <section id="main-content">
        <section class="wrapper">
            <div class="row">
                <div class="col-lg-9 main-chart">

                    <div class="team_make">
                        <form name="form" action="/team/make/" method="POST"
                              enctype="multipart/form-data">
                            <input type="hidden" name="main_team_check" id="main_team_check" value="1" required>

                            <p><input type="text" name="team_name" id="team_name" placeholder="팀 이름" required></p>


                            <select name="home[]" id="first" style="width:70px;"
                                    onchange="itemChange(this.form);"></select>
                            <select name="home[]" id="second" style="width:70px;"></select>

                            <p><input type="text" name="team_ability" id="team_ability" placeholder="팀 실력" required></p>

                            <P><textarea name="team_produce" id="team_produce" placeholder="팀 내용" required></textarea>
                            </P>

                            <p><input type="file" name="pfimage"></p>

                            <p>
                                <input type="button" value="뒤로" onclick="history.back()">
                                <input type="submit" name="submit_make_team" value="생성">
                            </p>
                        </form>
                    </div>

                </div><!-- /col-lg-9 END SECTION MIDDLE -->

    </body>
    </html>
<?php } ?>