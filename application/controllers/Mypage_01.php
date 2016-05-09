<?php
for($iCount = 0 ; $iCount < count($timelineList) ; $iCount++ ) {
?>
<li>
    <div class='timeline-badge up'><i class='fa fa-thumbs-up'></i></div>

        <div class='timeline-panel' style='background-color:white; min-height: 30em;'>

            <div class='timeline-heading'>

                <?php $param = $timelineList[$iCount]->user_id; ?>
                <div class='desc' data-toggle='modal' data-target='#userModal' data-title='people/<?=$param?>'>
                    <div class='thumb'>
                        <?php $img = $timelineList[$iCount]->user_psimage; ?>
                        <img class='img-circle' src='/public/img/member_s/<?=$img?>' align='left'>
                    </div>
               </div>

                <h4 class='timelind-tilte'><?php  echo $timelineList[$iCount]->user_id; ?></h4>

                <h5> <?php  echo $timelineList[$iCount]->time_date; ?> </h5>

            </div>


            <div class='timeline-body'><br>
                <?php $content = $timelineList[$iCount]->time_content; ?>
                <p style=' font-size: large'><?=$content?></p>
            </div>
        </div>


    <div class='timeline-panel_reply' style='background-color:white; min-height:5em;'>
        <table>
            <tr>
                <td>

                    <?php $img = $this -> data['myInfoList'][0] -> user_psimage; ?>
                    <img class='img-circle' src='/public/img/member_s/<?=$img?>'>
                </td>

                <td>
                    &nbsp;
                </td>

                <td>
                    <?php $user_id = $this -> data['user_id']; ?>
                    <?php echo "$user_id"; ?>
                </td>

                <td>
                    &nbsp;
                </td>
                <?php
                    $time_num = $timelineList[$iCount] -> time_num;
                    $timeline_user = $this -> data['timeline_user'];
                    $new_write_location = "new_write_location".$time_num;

                    $formInfo = 'ReadingInfoSelectForm'.$time_num;
                    $write_button = 'write'.$time_num;
                ?>
                <script type='text/javascript' src='/public/assets/js/jquery-1.8.3.min.js'></script>
                <script src='/public/assets/js/reply_write.js'></script>
                <td>
                    <form id=<?=$formInfo?> name=<?=$formInfo?> method='post'>
                        <input type='hidden' name='user_id' value='<?=$timeline_user?>'>
                        <input type='hidden' name='reply_user' value='<?=$user_id?>'>
                        <input type='text' name='reply_content' placeholder='댓글을 입력하세요.' style='min-height: 3em; min-width: 50em; border : 1px solid black'>
                        <input type='button' id=<?=$write_button?> name=<?=$write_button?> onclick='clicked(<?=$time_num?>);' value='쓰기'>
                        </form>
                    </td>
                </tr>
            </table><div id='<?=$new_write_location?>'></div><br>
        <?php
        $check = 0;
        // 댓글이 달리는 공간
        for($jCount = 0 ; $jCount < count($timeline_reply) ; $jCount++) {
            //for ($jCount_01 = 0; $jCount_01 < count($timeline_reply); $jCount_01++) {
                if (($timelineList[$iCount]->time_num) == (@($timeline_reply[$iCount][$jCount]->time_num))) {
                    $one = $timelineList[$iCount]->time_num;
                    $two = $timeline_reply[$iCount][$jCount]->time_num;

                    //echo "<script>alert($one, $two );</script>";
                    $check++;
                    $table_id = "table".$timeline_reply[$iCount][$jCount] -> reply_num;
                    $reply_id = "reply".$timeline_reply[$iCount][$jCount] -> reply_num;
        ?>
                    <table id='<?=$table_id?>' class='<?=$reply_id?>'>
                        <tr>
                            <td>
                                <?php
                                $reply = $timeline_reply[$iCount][$jCount]->user_psimage;
                                $user = $timeline_reply[$iCount][$jCount]->user_id;
                                ?>
                                <div class='desc' data-toggle='modal' data-target='#userModal' data-title='people/<?=$user?>'>
                                    <img class="img-circle" src='/public/img/member_s/<?=$reply?>'>
                                </div>
                            </td>

                            <td>
                                &nbsp;
                            </td>
                            <?php
                            $xx = $timeline_reply[$iCount][$jCount]->user_id;
                            ?>
                            <td><?php echo $xx?></td>

                            <td>
                                &nbsp;
                            </td>
                            <?php
                            $update_reply = 'update'.$timeline_reply[$iCount][$jCount] -> reply_num;
                            $reply_content = $timeline_reply[$iCount][$jCount]->reply_content;
                            ?>
                            <td id =<?=$update_reply?>>
                                <div style='min-height: 3em; min-width: 50em; border : 1px solid black'>
                                    <?php echo $reply_content ?>
                                </div>
                            </td>
                        <?php
                        if($_SESSION['loginID'] == $timeline_reply[$iCount][$jCount]->user_id) {

                            $delete_reply = $timeline_reply[$iCount][$jCount]->reply_num;
                            $update_reply = $timeline_reply[$iCount][$jCount]->reply_num;
                            ?>
                            <td>
                                <div style='min-height: 3em; min-width: 50em; border : 0px solid black'>
                                    <span id='reply_update_ready' onclick='reply_update_ready(<?=$update_reply?>)'>수정</span>&nbsp;
                                    <span id='reply_delete' onclick='reply_delete(<?=$delete_reply?>)'>삭제</span>
                                </div>
                            </td>
                            <?php
                        }
                        ?>
                        </tr>
                    </table>
                    <p id='space_01'></p>
                <?php
                //}
                if($check >= 5) {

                    $parent_board = $timeline_reply[$iCount][$jCount] -> time_num;
                    $reply_last_num =  $timeline_reply[$iCount][$jCount] -> reply_num;
                    $limit = 5;
                    echo "<script>var reply_last_num = $reply_last_num;</script>";
                    echo "<script>var parent_board = $parent_board;</script>";

                    $button_id = $reply_last_num;
                    $div_id = 'div'.$reply_last_num;
                    echo "<button id='$button_id' onclick='reply_go($reply_last_num, $limit, $parent_board);'>댓글 더 보기</button>";

                    echo "<div id='$div_id'>";

                    echo "</div>";

                    break;

                }
            }

        }
        ?>
        </div>
    </li>
<?php
$last = $timelineList[$iCount] -> time_num;

    ?>
<script>var last_notice_num = <?=$last ?> </script>

<?php
}
?>
