<section id="main-content" >
    <section class="wrapper">

        <div class="col-lg-9 main-chart">

            <div class="supporter_write">
                <form name="form" action="/Supporter/write" method="POST">
                    <select name="spt_number" id="spt_number" required>
                        <option selected disabled>모집 인원</option>
                        <?php
                        for($i = 1; $i <= 20; $i++)
                        {
                            echo "<option value='$i'>$i</option>";
                        }
                        ?>
                    </select>
                    <p><br><select id="first" style="width:70px;" onchange="itemChange(this.form);" ></select>
                        <select id="second" style="width:70px;" ></select></p>
                    <input type="hidden" name="spt_writer" value="<?=$_SESSION['loginID']?>">
                    <p><input type="text" name="spt_address"  id="spt_address" placeholder="위치를 상세하게 적어주세요" required></p>
                    <p><input type="date" name="spt_date"  id="spt_date" min="<?php echo $min=date("Y-m-d"); ?>" max="<?php echo $max=date("Y-m-d",strtotime("+365 day")); ?>"> </p>
                    <p>경기시간 :&nbsp;
                        <input type="time" name="spt_starttime" id="spt_starttime" min="00:00" max="24:00" > ~
                        <input type="time" name="spt_endtime" id="spt_endtime" min="00:00" max="24:00" >
                    </p>
                    <p><input type="text" name="spt_content" id="spt_content" placeholder="내용"> </p>
                    <p>
                        <button onclick="location.href='/Supporter/index'">취소</button>
                        <input type="submit" name="submit_write_supporter" value="작성">
                    </p>
                </form>
            </div>
        </div><!-- /col-lg-9 END SECTION MIDDLE -->

</>

