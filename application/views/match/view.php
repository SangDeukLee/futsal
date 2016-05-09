<style>
    .left-box {
        float: left;
        width: 50%;
        line-height: 566px;
        vertical-align: middle;
    }
    .right-box {
        float: right;
        width: 50%;
        line-height: 566px;
        vertical-align: middle;
    }
</style>

<section id="main-content">
    <section class="wrapper">
        <div class="col-lg-9 main-chart">
                <!-- 상세보기를 위한 div -->
                    <!-- 유저 상세보기 -->
                    <?php
                    $check = true;
                    $pfRowSpan = 4;
                    for($i = 0 ; $i < count($match_request) ; $i++ ) {
                        if($_SESSION['loginID'] == ($match_request[$i] -> matchr_user)) {
                            $check = false;
                            $pfRowSpan = 3;
                        }
                    }
                    ?>



                    <div class="content-panel">
                        <table class="table">
                            <tr>
                                <td rowspan="4" width="150">
                                    <div class="img">
                                        <img src="../../public/img/team/<?php echo $match_info->team_pfimage ?>" class="img-circle" width="133px" height="133px">
                                    </div>
                                    </form>
                                </td>
                                <td class="warning">팀이름 : <?php echo $match_info->team_name; ?></td>
                            </tr>
                            <tr>
                                <td class="warning">
                                    <div class="desc" data-toggle="modal" data-target="#userModal" data-title="people/<?php echo $match_info -> match_writer?>">
                                        Leader : <?php echo $match_info->team_leader ?></div>
                                </td>
                            </tr>
                            <tr>
                                <td class="warning">홈그라운드 : <?php echo $match_info->team_home ?></td>
                            </tr>
                            <tr>
                                <?php if($match_info->match_status == 0) $check == false ?>
                                <?php if(($_SESSION['loginID'] != $match_info->match_writer) && ($check == true) ) {?>
                                    <td>
                                        <form action="../../Match/request" method="post">
                                            <input type="hidden" name="matchr_user" value="<?=$_SESSION['loginID']?>">
                                            <input type="hidden" name="match_num" value="<?=$match_info->match_num?>">
                                            <input type="submit" value="대전신청">
                                        </form>
                                    </td>
                                <?php } ?>
                            </tr>

                        </table>
                    </div>

                    <br>

                    <!-- 용병신청 글 -->
                    <div class="content-panel">
                        <table class="table" width="80%" align="center">
                            <tr><td class="success" colspan="2">상세위치 : <?php echo $match_info->match_address ?></td></tr>
                            <tr>
                                <td class="success">경기날짜 : <?php echo $match_info->match_date ?></td>
                                <td class="success">실력 : <?php echo $match_info->team_ability ?></td>
                            </tr>
                            <tr>
                                <td class="success">경기 예정 시간 : <?php echo $match_info->match_starttime ?> ~ <?php echo $match_info->match_endtime ?></td>
                                <td class="success">경기 방식 : <?=$match_info->match_rule?></td>
                            </tr>
                            <tr>
                                <td class="success" colspan="2">
                                    <textarea class="form-group" cols="100%" rows="6" readonly/><?php echo $match_info->match_content ?></textarea>
                                </td>
                            </tr>
                        </table>
                        <!-- 용병신청 글 종료 -->
                    </div>
                    <hr>


                    <div align="center" style="background: url('/public/img/ground.jpg');height: 569px; width: 758px; margin-left:250px;">
                        <div class="left-box" align="center"><img src="../../public/img/team/<?php echo $match_info->team_pfimage ?>"  width="133px" height="133px"></div>
                        <div class="right-box" align="center"><img src="../../public/img/team/<?php echo $match_info->team_pfimage ?>" width="133px" height="133px"></div>
                    </div>


                    <hr>
                    <br>
                    <?php
                    $cnt = count($match_request);
                    if($cnt > 0 || $match_info->match_writer != $user_id) { ?>
                        <p align="right"><button class="btn btn-warning" disabled>수정불가</button>&nbsp;&nbsp;<button class="btn btn-danger" disabled>삭제불가</button></p>
                    <?php } else { ?>
                        <p align="right"><button onclick="location.href='/match/modifyv/<?=$match_info->match_num?>/'">수정</button>&nbsp;&nbsp;<button onclick="location.href='/match/del/<?=$match_info->match_num?>/'">삭제</button></p>
                    <?php } ?>
                    <div>
                        <h4 align="center"><button type="button" class="btn btn-info btn-lg btn-block">신청자 목록</button> </h4>
                        <br>
                        <?php
                        foreach($match_request as $row) {?>
                            <div class="content-panel">
                            <table class="table"align="center">
                                <tr>
                                    <td width="100" rowspan="3"><img src="../../../public/img/team_s/<?= $row->team_psimage ?>" class="img-circle" width="133px" height="133px"></td>
                                    <td>
                                        <div class="desc" data-toggle="modal" data-target="#userModal" data-title="people/<?php echo $row->matchr_user?>">
                                            Leader : <?=$row->matchr_user ?>
                                        </div>
                                    </td>
                                    <?php
                                    if($user_id != $match_info->match_writer) $colSpan = 3;
                                    else $colSpan = 2;
                                    ?>
                                    <?php if($user_id == $match_info->match_writer) { ?>
                                        <?php if(0 == $row->matchr_status) { ?>
                                            <td>
                                                <form action="../../Match/gameJoin" method="post">
                                                    <input type="hidden" name="match_num" value="<?=$row->match_num?>">
                                                    <input type="hidden" name="matchr_num" value="<?=$row->matchr_num?>">
                                                    <input type="submit" value="승인">
                                                </form>
                                            </td>
                                        <?php } else if(1 == $row->matchr_status) { ?>
                                            <td rowspan="<?= $colSpan ?>">승인</td>
                                        <?php } else { ?>
                                            <td rowspan="<?= $colSpan ?>">거절</td>
                                        <?php } ?>
                                    <?php } else { ?>
                                        <?php if(0 == $row->matchr_status) { ?>
                                            <td rowspan="3">
                                                <form action="../../Match/gameCancel" method="post">
                                                    <input type="hidden" name="match_num" value="<?=$row->match_num?>">
                                                    <input type="hidden" name="matchr_num" value="<?=$row->matchr_num?>">
                                                    <input type="submit" value="취소">
                                                </form>
                                            </td>
                                        <?php } else if(1 == $row->matchr_status) { ?>
                                            <td rowspan="<?= $colSpan ?>">승인</td>
                                        <?php } else { ?>
                                            <td rowspan="<?= $colSpan ?>">거절</td>
                                        <?php } ?>
                                    <?php }?>
                                </tr>
                                <tr>
                                    <td>실력 : <?php echo $match_info->team_ability ?></td>
                                    <?php if($user_id == $match_info->match_writer) { ?>
                                        <?php if(0 == $row->matchr_status) { ?>
                                            <td>
                                                <form action="../../Match/gameRefusal" method="post">
                                                    <input type="hidden" name="match_num" value="<?=$row->match_num?>">
                                                    <input type="hidden" name="matchr_num" value="<?=$row->matchr_num?>">
                                                    <input type="submit" class="btn btn-danger" value="거절">
                                                </form>
                                            </td>
                                        <?php } ?>
                                    <?php } ?>
                                </tr>
                                <tr>
                                    <td>참여 인원 : <?php echo $row->team_number ?></td>
                                </tr>
                            </table>
                            <br>
                        <?php } ?>
                    </div>
                    </div>
                </div>

