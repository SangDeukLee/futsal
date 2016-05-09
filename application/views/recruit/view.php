<?php $loginID = $_SESSION['loginID']; ?>

<section id="main-content">
    <section class="wrapper">
        <div class="col-lg-9 main-chart">
            <div>

                <!-- 상세보기를 위한 div -->
                <div>
                    <!-- 유저 상세보기 -->
                    <?php
                    $check = true;
                    $pfRowSpan = 4;
                    for($i = 0 ; $i < count($recruit_request) ; $i++ ) {
                        if($_SESSION['loginID'] == ($recruit_request[$i] -> recruitr_user)) {
                            $check = false;
                            $pfRowSpan = 3;
                        }
                    }
                    ?>
                    <table border="1" width="80%" align="center">
                        <tr>
                            <td rowspan="<?= $pfRowSpan ?>" width="15%" height="100"><img src="../../public/img/team/<?= $recruit_team_board->team_pfimage ?>"</td>
                            <td>
                                <div class="desc" data-toggle="modal" data-target="#teamModal" data-title="team/<?php echo $recruit_team_board -> team_name?>">
                                    <?= $recruit_team_board->team_name ?>
                                </div>
                            </td>
                        </tr>
                        <tr><td>leader : <?php echo $recruit_team_board->team_leader ?></td></tr>
                        <tr><td>홈그라운드 : <?php echo $recruit_team_board->team_home ?></td></tr>
                        <tr>
                            <?php if(($_SESSION['loginID'] != $recruit_team_board->recruit_writer) && ($check == true) ) {?>
                                <td>
                                    <form action="../../Recruit/request" method="post">
                                        <input type="hidden" name="recruitr_user" value="<?=$_SESSION['loginID']?>">
                                        <input type="hidden" name="recruit_num" value="<?=$recruit_team_board->recruit_num?>">
                                        <input type="submit" name="submit_request_recruit" value="가입신청">
                                    </form>
                                </td>
                            <?php } ?>
                        </tr>
                    </table>
                </div>
                <br>

                <!-- 팀원신청 글 -->
                <table border="1" width="80%" align="center">
                    <tr>
                        <td>실력 : <?= $recruit_team_board->team_ability ?></td>
                        <td>현재 인원 : <?= $recruit_team_board->team_number ?></td>
                    </tr>
                    <tr><td colspan="2">
                            <textarea cols="100%" rows="6" readonly/><?php echo $recruit_team_board->recruit_content ?></textarea>
                        </td></tr>
                </table>
            </div>
            <!-- 팀원신청 글 종료 -->
            <br>
            <?php if($loginID == $recruit_team_board->recruit_writer) { ?>
                <p align="right">
                    <button onclick="location.href='/recruit/modifyv/<?= $recruit_team_board->recruit_num ?>'">수정</button>&nbsp;&nbsp;
                    <button onclick="location.href='/recruit/del/<?= $recruit_team_board->recruit_num ?>'">삭제</button></p>
            <?php } ?>
            <div>
                <h4 align="center">---------------------신청자 목록-------------------</h4>
                <br>
                <?php
                foreach($recruit_request as $row) {?>
                    <table width="80%" border="1" align="center">
                        <tr>
                            <td rowspan="3"><img src="../../../public/img/member_s/<?php echo $row->user_psimage ?>"></td>
                            <td colspan="3">
                                <div class="desc" data-toggle="modal" data-target="#userModal" data-title="people/<?php echo $row->recruitr_user?>">
                                    ID : <?php echo $row->recruitr_user ?>
                                </div>
                            </td>
                        </tr>
                        <tr><td colspan="3"><?= $row->user_ability ?></td></tr>
                        <tr>
                            <?php
                            if($loginID != $recruit_team_board->recruit_writer) $colSpan = 2;
                            else $colSpan = 1;
                            ?>
                            <?php if($loginID == $recruit_team_board->recruit_writer) { ?>
                                <?php if(0 == $row->recruitr_status) { ?>
                                    <td>

                                        <form action="/Recruit/teamJoin" method="post">
                                            <input type="hidden" name="team_name" value="<?= $recruit_team_board->team_name ?>">
                                            <input type="hidden" name="user" value="<?=$row->user_id ?>">
                                            <input type="hidden" name="recruitr_num" value="<?=$row->recruitr_num?>">
                                            <input type="hidden" name="recruit_num" value="<?=$row->recruit_num?>">
                                            <input type="submit" name="submit_join_recruit" value="수락">
                                        </form>
                                    </td>
                                    <td>
                                        <form action="/Recruit/teamRefusal" method="post">
                                            <input type="hidden" name="recruitr_num" value="<?=$row->recruitr_num?>">
                                            <input type="hidden" name="recruit_num" value="<?=$row->recruit_num?>">
                                            <input type="submit" name="submit_refusal_recruit" value="거절">
                                        </form>
                                    </td>
                                    <td><button>쪽지</button></td>
                                <?php } else if(1 == $row->recruitr_status) { ?>
                                    <td colspan="<?= $colSpan ?>">승인</td>
                                <?php } else { ?>
                                    <td colspan="<?= $colSpan ?>">거절</td>
                                <?php } ?>
                            <?php } else { ?>
                                <?php if(0 == $row->recruitr_status) { ?>
                                    <td colspan="3">
                                        <form action="../../Recruit/gameCancel" method="post">
                                            <input type="hidden" name="recruitr_num" value="<?=$row->recruitr_num?>">
                                            <input type="hidden" name="recruit_num" value="<?=$row->recruit_num?>">
                                            <input type="submit" name="submit_cancel_recruitr" value="취소">
                                        </form>
                                    </td>
                                <?php } else if(1 == $row->recruitr_status) { ?>
                                    <td colspan="3">승인</td>
                                <?php } else { ?>
                                    <td colspan="3">거절</td>
                                <?php } ?>
                            <?php }?>
                        </tr>
                    </table>
                    <br>
                <?php } ?>
            </div>
        </div>

