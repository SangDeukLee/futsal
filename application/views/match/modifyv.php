
<section id="main-content">
    <section class="wrapper">

        <div class="col-lg-9 main-chart">
            <div class="match_write">
                <form name="form" action="/Match/modify" method="POST">
                    <input type="hidden" id="match_num" name="match_num" value="<?=$match_modify->match_num?>">
                    <input type="hidden" id="match_writer" name="match_writer" readonly value="<?=$match_modify->match_writer?>">
                    <input type="text" name="team_name" id="team_name" readonly value="<?=$match_teamName->team_name?>"><br><br>
                    <select name="match_rule" id="match_rule" required>
                        <option disabled>대결 방식</option>
                        <option
                            <?php
                            if($match_modify->match_rule == "5:5") echo "selected";
                            ?>
                            value="5:5">5:5</option>
                        <option
                            <?php
                            if($match_modify->match_rule == "6:6") echo "selected";
                            ?>
                            value="6:6">6:6</option>
                    </select>
                    <p><br><select id="first" style="width:70px;" onchange="itemChange(this.form);" ></select>
                        <select id="second" style="width:70px;" ></select></p>
                    <p><input type="text" name="match_address" id="match_address" value="<?=$match_modify->match_address?>" required></p>
                    <p><input type="date" name="match_date" id="match_date" min="<?php echo $min=date("Y-m-d"); ?>" max="<?php echo $max=date("Y-m-d",strtotime("+365 day")); ?>" value="<?=$match_modify->match_date?>"> </p>
                    <p>경기시간 :&nbsp;
                        <input type="time" name="match_starttime" id="match_starttime" min="00:00" max="24:00" value="<?=$match_modify->match_starttime?>"> ~
                        <input type="time" name="match_endtime" id="match_endtime" min="00:00" max="24:00" value="<?=$match_modify->match_endtime?>">
                    </p>
                    <p><input type="text" name="match_content" id="match_content" value="<?=$match_modify->match_content?>"> </p>
                    <p>
                        <button onclick="location.href='/match/view/<?=$match_modify->match_num?>/'">취소</button>
                        <input type="submit" name="submit_modify_match" value="수정">
                    </p>
                </form>
            </div>
        </div><!-- /col-lg-9 END SECTION MIDDLE -->

