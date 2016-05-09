
<section id="main-content">
    <section class="wrapper">

            <div class="col-lg-9 main-chart">

                <div class="recruit_write">
                    <form name="form" action="/Recruit/write" method="POST">
                        <p><input type="text" value="<?= $recruit_team_name->team_name ?>" readonly></p>
                        <p><input type="text" value="<?= $recruit_team_name->team_home ?>" readonly></p>
                        <p><input type="hidden" name="recruit_writer" value="<?= $user_id ?>"></p>
                        <p><textarea name="recruit_content" id="recruit_content" placeholder="내용" rows="10" cols="50"></textarea></p>
                        <p>
                            <button onclick="location.href='/recruit/index'">취소</button>
                            <input type="submit" name="submit_write_recruit" value="작성">
                        </p>
                    </form>
                </div>
            </div><!-- /col-lg-9 END SECTION MIDDLE -->



