<section id="main-content">
    <section class="wrapper">
        <div class="row">
                <div class="col-lg-9 main-chart">
                    <!-- 글쓰기 공간 -->
                    <?php if($_SESSION['loginID'] == $timeline_user) {?>
                    <div class="container">
                        <div class="span7 bottom15">
                            <div class="roundinside bottom15 center">
                                <label class="lightblue bold leftalign" for="textarea">Compose New Message</label>
                                <form action="/Mypage/mypageWrite" method="post">
                                    <textarea name="content" rows="5" cols="50" style="resize: none; font-size: 20px;"></textarea>
                                    <br/><br/>
                                    <input type="submit" value="Create">
                                    &nbsp;&nbsp;&nbsp;
                                    <input type="reset" value="Reset">
                                    <!--<a class="btn btn-primary" id="writeBtn"> Write </a>&nbsp;
                                    <a class="btn btn-info between" id="reloadBtn"> Refresh </a>-->
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                    <!--<div class="thumb">

                        <img class="img-circle" src="../../../public/img/member_s/<?/*=$row -> user_psimage*/?>" align="left">

                    </div>-->
                    <!-- 타임라인 공간 -->
                    <div>
                        <div class="container">
                            <div id="haha">
                            <ul id ="scroll_mypage_01" class="timeline">

                                <?php $last_notice_num = 0; ?>
                                <?php foreach($timelineList as $row){
                                    $last_notice_num = $row -> time_num;

                                ?>

                                <li><!---Time Line Element--->

                                    <div class="timeline-badge up"  ><i class="fa fa-thumbs-up"></i></div>

                                    <div class="timeline-panel" style="background-color:white; min-height: 30em;">

                                        <div class="timeline-heading" >
                                            <div class="desc" data-toggle="modal" data-target="#userModal" data-title="people/<?php echo $row -> user_id?>">
                                                <div class="thumb">
                                                    <img class="img-circle" src="/public/img/member_s/<?=$row -> user_psimage?>" align="left">
                                                </div>
                                            </div>
                                            <h4 class="timeline-title"><?php echo $row -> user_id; ?></h4>
                                            <h5><?php echo $row -> time_date; ?></h5>
                                        </div>
                                        <div class="timeline-body"><!---Time Line Body&Content--->
                                            <br/>
                                            <p style="font-size: large"><?php echo $row -> time_content; ?></p>
                                        </div>
                                    </div>


                                    <div class="timeline-panel_reply" style="background-color:white; min-height: 5em;">

                                        <!-- 댓글 쓰는공간 -->
                                        <table>
                                            <tr>
                                                <td>
                                                    <img class="img-circle"src="/public/img/member_s/<?=$myInfoList[0]->user_psimage?>">
                                                </td>
                                                <td>
                                                    &nbsp;
                                                </td>

                                                <td>
                                                    <?php echo $user_id ?>
                                                </td>
                                                <td>
                                                    &nbsp;
                                                </td>
                                                <td>
                                                    <?php
                                                        $write_button = 'write'.$last_notice_num;
                                                        $num = $row -> time_num;
                                                        $new_writed = 'writed'.$num;
                                                        $new_write_location = "new_write_location".$num;
                                                        $formInfo = 'ReadingInfoSelectForm'.$num;
                                                        //echo "$formInfo";
                                                        echo "<script>var num = $num</script>";
                                                    ?>

                                                    <form id="<?php echo $formInfo; ?>" name="<?php echo $formInfo ?>" action="" method="post">
                                                        <input type="hidden" name="user_id" value="<?php echo $timeline_user ?>">
                                                        <input type="hidden" name="reply_user" value="<?php echo $user_id?>">
                                                        <!--<input type="hidden" name="time_numnum" value="<?php /*echo $num*/?>">
                                                        <input type="hidden" name="new_writed" value="<?php /*echo $new_writed*/?>">-->

                                                        <input type="text" name="reply_content" placeholder="댓글을 입력하세요." style="min-height: 3em; min-width: 50em; border : 1px solid black">

                                                        <input type="button" id="<?php echo $write_button?>" name="<?php echo $write_button?>" onclick="clicked(<?php echo $num ?>);" value="쓰기">

                                                    </form>

                                                </td>
                                            </tr>
                                        </table>

                                        <div id="<?php echo $new_write_location ?>"></div>
                                        <br>


                                        <!-- 댓글이 달리는 공간-->
                                        <?php
                                            $check = 0;
                                            for($cnt_01 = 0 ; $cnt_01 < count($timeline_reply) ; $cnt_01++) {
                                                for ($cnt = 0; $cnt < count($timeline_reply); $cnt++) {
                                                    if (($row -> time_num) == (@($timeline_reply[$cnt_01][$cnt] -> time_num))) {
                                                            $check++;
                                                            $table_id = "table".$timeline_reply[$cnt_01][$cnt] -> reply_num;
                                                            $reply_id = "reply".$timeline_reply[$cnt_01][$cnt] -> reply_num;

                                                        ?>
                                                        <table id="<?php echo $table_id ?>" class="<?php echo $reply_id ?>"'>
                                                            <tr>

                                                                        <td>

                                                                            <div class="desc" data-toggle="modal" data-target="#userModal" data-title="people/<?php echo $timeline_reply[$cnt_01][$cnt]->user_id;?>">
                                                                                <img class="img-circle" src="/public/img/member_s/<?= $timeline_reply[$cnt_01][$cnt]->user_psimage ?>">
                                                                            </div>

                                                                        </td>
                                                                        <td>
                                                                            &nbsp;
                                                                        </td>
                                                                        <td>
                                                                            <div class="desc" data-toggle="modal" data-target="#userModal" data-title="people/<?php echo $timeline_reply[$cnt_01][$cnt]->user_id;?>">
                                                                                <?php echo $timeline_reply[$cnt_01][$cnt]->user_id; ?>
                                                                            </div>

                                                                        </td>

                                                                        <td>
                                                                            &nbsp;
                                                                        </td>
                                                                        <?php
                                                                            $update_reply = 'update'.$timeline_reply[$cnt_01][$cnt] -> reply_num;
                                                                            //var_dump($update_reply);
                                                                        ?>
                                                                        <td id="<?php echo $update_reply ?>">


                                                                            <div
                                                                                 style="min-height: 3em; min-width: 50em; border : 1px solid black">
                                                                                <?php echo $timeline_reply[$cnt_01][$cnt]->reply_content; ?>
                                                                            </div>
                                                                        </td>
                                                                        <?php
                                                                        if($_SESSION['loginID'] == $timeline_reply[$cnt_01][$cnt] -> user_id) {
                                                                            $delete_reply = $timeline_reply[$cnt_01][$cnt] -> reply_num;
                                                                            $update_reply = $timeline_reply[$cnt_01][$cnt] -> reply_num;

                                                                        ?>
                                                                        <td>
                                                                            <div
                                                                                style="min-height: 3em; min-width: 50em; border : 0px solid black">
                                                                                <span id="reply_update_ready" onclick="reply_update_ready(<?php echo $update_reply ?>)">수정</span>&nbsp;
                                                                                <span id="reply_delete" onclick="reply_delete(<?php echo $delete_reply ?>)">삭제</span>
                                                                            </div>
                                                                        </td>
                                                                        <?php
                                                                        }
                                                                        ?>

                                                            </tr>

                                                        </table>
                                                        <p id="space_01"></p>

                                                        <?php
                                                    }
                                                    if($check >= 5) {

                                                        $parent_board = $timeline_reply[$cnt_01][$cnt] -> time_num;
                                                        $reply_last_num =  $timeline_reply[$cnt_01][$cnt] -> reply_num;
                                                        $limit = 5;
                                                        echo "	<script>var reply_last_num = $reply_last_num;</script>";
                                                        echo "	<script>var parent_board = $parent_board;</script>";


                                                        break;

                                                    }
                                                }
                                                if($check >= 5) {

                                                    $button_id = $reply_last_num;
                                                    $div_id = 'div'.$reply_last_num;
                                                    echo "<button id='$button_id' onclick='reply_go($reply_last_num, $limit, $parent_board);'>댓글 더 보기</button>";

                                                    echo "<div id='$div_id'>";

                                                    echo "</div>";
                                                    break;
                                                }

                                            }

                                        ?>
                                        <!--------------------->



                                        <!----------------->
                                    </div>


                                <?php }?>
                                </li>

                            </ul>
                            </div>
                        </div>

                    </div>
                    <script type="text/javascript">var last_notice_num = <?=$last_notice_num?></script>
                    <p id="loader" style="text-align: center; display: none">
                        <img src="/public/assets/img/loader.gif">
                    </p>

                </div><!-- /col-lg-9 END SECTION MIDDLE -->


