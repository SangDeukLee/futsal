<div class="col-lg-9 main-chart">
    <div class="teampage_memberlist">
        <div class="content-panel">
            <?php foreach($team_memberlist as $member) {?>
            <table class="table">
                <tr>
                    <td rowspan="4" width="150">
                        <div class="ih-item circle effect13 from_left_and_right">
                                <div class="img">
                                    <img src="/public/img/member/<?php echo $member->user_pfimage ?>">
                                </div>
                                </a></div>
                    </td>
                    <td class="info"><?php echo $member->user_id ?> 님</td>
                </tr>
                <tr>
                    <td class="active"><?php echo $member->user_home ?></td>
                </tr>
                <tr>
                    <td class="info"><?php
                        if($member->main_team_check == 1){echo "팀 대표";}
                        else {echo "일반 회원";} ?></td>
                </tr>

                <?php  } ?>
            </table>
        </div>
    </div>

</div><!-- /col-lg-9 END SECTION MIDDLE -->

