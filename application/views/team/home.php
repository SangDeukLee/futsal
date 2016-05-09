<script type="text/javascript">
    function doUpDownTalk(param1) {
        var pageform = document.pageform;
        pageform.team_name.value = param1;

        pageform.submit();
    }

    function doUpDownTalkt(param1) {
        var pageformt = document.pageformt;
        pageformt.team_name.value = param1;

        pageformt.submit();
    }
    function doUpDownTalko(param1) {
        var pageformo = document.pageformo;
        pageformo.team_name.value = param1;

        pageformo.submit();
    }
</script>


<section id="main-content">
    <section class="wrapper">
        <div class="col-lg-9 main-chart">
            <h2>
                <i class="fa fa-angle-right"></i>
                대표팀
            </h2>
            <?php
            if($teamList){
            foreach ($teamList as $row) {
                if ($row->main_team_check == 1) { ?>
                    <div class="content-panel">
                        <h4>
                            <i class="fa fa-futbol-o"></i> &nbsp;
                            <?php echo $row->team_name ?>
                        </h4>
                    <table class="table">
                        <tr>
                            <td rowspan="4" width="150">
                                <form action="/team/page/" method="post" name="pageform">

                                    <input type="hidden" name="team_name" value="<?php echo $row->team_name ?>">

                                <div class="ih-item circle effect13 from_left_and_right"> <a href="javascript:doUpDownTalk(pageform.team_name.value);"/>
                                        <div class="img">
                                            <img src="../../../public/img/team/<?php echo $row->team_pfimage ?>">
                                        </div>

                                        <div class="info">
                                            <div class="info-back">
                                                <h3>Team</h3>
                                                <p>in detail</p>
                                            </div>
                                        </div></a></div>
                                </form>
                                </td>
                            <td class="warning">리더 : <?php echo $row->team_leader ?></td>
                        </tr>
                        <tr>
                            <td class="success">실력 : <?php echo $row->team_ability ?></td>
                        </tr>
                        <tr>
                            <td class="info">홈&nbsp;&nbsp; : <?php echo $row->team_home ?></td>
                        </tr>
                        <tr>
                            <td class="danger">소개 : <?php echo $row->team_produce ?></td>
                        </tr>

                    </table>
                    </div>
                    <hr>
                <?php }
            }
                $count=0;
            foreach ($teamList as $row) {

                if ($row->main_team_check == 0) {
                    if($count==1){
                        ?>
                        <div class = "panel panel-warning">
                            <div class = "panel-heading">
                                <h3 class = "panel-title"><?php echo $row->team_name ?></h3>
                            </div>
                            <div class = "panel-body">
                                <table class="table">
                                    <tr class="warning">
                                        <td rowspan="4" width="150">
                                            <form action="/team/page/" method="post" name="pageformt">

                                                <input type="hidden" name="team_name" value="<?php echo $row->team_name  ?>">

                                                <div class="ih-item circle effect13 from_left_and_right"> <a href="javascript:doUpDownTalkt(pageformt.team_name.value);"/>
                                                    <div class="img">
                                                        <img src="../../../public/img/team/<?php echo $row->team_pfimage ?>">
                                                    </div>

                                                    <div class="info">
                                                        <div class="info-back">
                                                            <h3>Team</h3>
                                                            <p>in detail</p>
                                                        </div>
                                                    </div></a></div>
                                            </form>
                                        </td>
                                        <td>리더 : <?php echo $row->team_leader ?></td>
                                    </tr>
                                    <tr class="warning">
                                        <td>실력 : <?php echo $row->team_ability ?></td>
                                    </tr>
                                    <tr class="warning">
                                        <td>홈&nbsp;&nbsp; : <?php echo $row->team_home ?></td>
                                    </tr>
                                    <tr class="warning">
                                        <td>소개 : <?php echo $row->team_produce ?></td>
                                    </tr>
                                    <br/>
                                </table>
                            </div>
                        </div>
                    <?php $count++; }elseif($count==2){?>
                        <div class = "panel panel-success">
                            <div class = "panel-heading">
                                <h3 class = "panel-title"><?php echo $row->team_name ?></h3>
                            </div>
                            <div class = "panel-body">
                                <table class="table">
                                    <tr class="success">
                                        <td rowspan="4" width="150">
                                            <div class="ih-item circle effect13 from_left_and_right"><a href="/team/page/<?php echo $row->team_name ?>">
                                                <div class="img">
                                                    <img src="../../../public/img/team/<?php echo $row->team_pfimage ?>">
                                                </div>
                                                <div class="info">
                                                    <div class="info-back">
                                                        <h3>Team</h3>
                                                        <p>in detail</p>
                                                    </div>
                                                </div></a></div>
                                        </td>
                                        <td>리더 : <?php echo $row->team_leader ?></td>
                                    </tr>
                                    <tr class="success">
                                        <td>실력 : <?php echo $row->team_ability ?></td>
                                    </tr>
                                    <tr class="success">
                                        <td>홈&nbsp;&nbsp; : <?php echo $row->team_home ?></td>
                                    </tr>
                                    <tr class="success">
                                        <td>소개 : <?php echo $row->team_produce ?></td>
                                    </tr>
                                    <br/>
                                </table>
                            </div>
                        </div>
                    <?php $count++; }elseif($count==3){?>
                        <div class = "panel panel-info">
                            <div class = "panel-heading">
                                <h3 class = "panel-title"><?php echo $row->team_name ?></h3>
                            </div>
                            <div class = "panel-body">
                                <table class="table">
                                    <tr class="info">
                                        <td rowspan="4" width="150">
                                            <div class="ih-item circle effect13 from_left_and_right"><a href="/team/page/<?php echo $row->team_name ?>">
                                                <div class="img">
                                                    <img src="../../../public/img/team/<?php echo $row->team_pfimage ?>">
                                                </div>
                                                <div class="info">
                                                    <div class="info-back">
                                                        <h3>Team</h3>
                                                        <p>in detail</p>
                                                    </div>
                                                </div></a></div>
                                        </td>
                                        <td>리더 : <?php echo $row->team_leader ?></td>
                                    </tr>
                                    <tr class="info">
                                        <td>실력 : <?php echo $row->team_ability ?></td>
                                    </tr>
                                    <tr class="info">
                                        <td>홈&nbsp;&nbsp; : <?php echo $row->team_home ?></td>
                                    </tr>
                                    <tr class="info">
                                        <td>소개 : <?php echo $row->team_produce ?></td>
                                    </tr>
                                    <br/>
                                </table>
                            </div>
                        </div>
                    <?php $count = 0; }else{
                    ?>
            <div class = "panel panel-danger">
                <div class = "panel-heading">
                    <h3 class = "panel-title"><?php echo $row->team_name ?></h3>
                </div>
                <div class = "panel-body">
                    <table class="table">
                        <tr class="danger">
                            <td rowspan="4" width="150">
                                <form action="/team/page/" method="post" name="pageformo">

                                    <input type="hidden" name="team_name" value="<?php echo $row->team_name ?>">

                                    <div class="ih-item circle effect13 from_left_and_right"> <a href="javascript:doUpDownTalko(pageformo.team_name.value);"/>
                                        <div class="img">
                                            <img src="../../../public/img/team/<?php echo $row->team_pfimage ?>">
                                        </div>

                                        <div class="info">
                                            <div class="info-back">
                                                <h3>Team</h3>
                                                <p>in detail</p>
                                            </div>
                                        </div></a></div>
                                </form>
                            </td>
                            <td>리더 : <?php echo $row->team_leader ?></td>
                        </tr>
                        <tr class="danger">
                            <td>실력 : <?php echo $row->team_ability ?></td>
                        </tr>
                        <tr class="danger">
                            <td>홈&nbsp;&nbsp; : <?php echo $row->team_home ?></td>
                        </tr>
                        <tr class="danger">
                            <td>소개 : <?php echo $row->team_produce ?></td>
                        </tr>
                        <br/>
                    </table>
                </div>
            </div>
                <?php $count++;}}
            }}else{ ?>
                <button type="button" class="btn btn-primary btn-lg" onclick="location.href='/team/makeV/'">팀 생성</button>
            <?php } ?>
        </div>
      <!-- /col-lg-9 END SECTION MIDDLE -->
