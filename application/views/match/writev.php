
<section id="main-content">
    <section class="wrapper">

        <div class="col-lg-9 main-chart">
            <div class="match_write">
                <form name="form" action="/Match/write" method="POST">
                    <input type="hidden" id="match_writer" name="match_writer" value="<?=$_SESSION['loginID']?>">
                    <input type="text" name="team_name" id="team_name" readonly value="<?=$match_taem->team_name?>"><br><br>
                    <select name="match_rule" id="match_rule" required>
                        <option selected disabled>대결 방식</option>
                        <option value="5:5">5:5</option>
                        <option value="6:6">6:6</option>
                    </select>
                    <p><br><select id="first" style="width:70px;" onchange="itemChange(this.form);" ></select>
                        <select id="second" style="width:70px;" ></select></p>
                    <p><input type="text" name="match_address" id="match_address" placeholder="위치를 상세하게 적어주세요" required></p>
                    <p><input type="date" name="match_date" id="match_date" min="<?php echo $min=date("Y-m-d"); ?>" max="<?php echo $max=date("Y-m-d",strtotime("+365 day")); ?>"> </p>
                    <p>경기시간 :&nbsp;
                        <input type="time" name="match_starttime" id="match_starttime" min="00:00" max="24:00" > ~
                        <input type="time" name="match_endtime" id="match_endtime" min="00:00" max="24:00" >
                    </p>
                    <p><input type="text" name="match_content" id="match_content" placeholder="내용"> </p>
                    <p>
                        <button onclick="location.href='/match/index'">취소</button>
                        <input type="submit" name="submit_write_match" value="작성">
                    </p>
                </form>
            </div>
        </div><!-- /col-lg-9 END SECTION MIDDLE -->

