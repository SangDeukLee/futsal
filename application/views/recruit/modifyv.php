
<section id="main-content">
    <section class="wrapper">
        <div class="col-lg-9 main-chart">
            <div class="recruit_modify">
                <form name="form" action="/Recruit/modify" method="POST">
                    <input type="hidden" name="recruit_num" value="<?= $recruit_board->recruit_num ?>">
                    <input type="text" value="<?= $recruit_team_name->team_name ?>" readonly>
                    <input type="text" value="<?= $recruit_team_name->team_home ?>" readonly>
                    <p><br><textarea name="recruit_content" id="recruit_content" rows="10" cols="50"><?= $recruit_board->recruit_content ?></textarea></p>
                    <p>
                        <button onclick="location.href='/recruit/view/<?= $recruit_board->recruit_num ?>'">취소</button>
                        <input type="submit" name="submit_modify_recruit" value="작성">
                    </p>
                </form>
            </div>
        </div><!-- /col-lg-9 END SECTION MIDDLE -->


