<script type="text/javascript">
    function doUpDownTalk(param1) {
        var pageform = document.pageform;
        pageform.team_name.value = param1;

        pageform.submit();
    }
</script>
<style>

    hr.style-six {
        border: 0;
        height: 0;
        border-top: 1px solid rgba(0, 0, 0, 0.1);
        border-bottom: 1px solid rgba(255, 255, 255, 0.3);
    }
</style>
<section id="main-content">
    <section class="wrapper">
        <div class="col-lg-9 main-chart">
            <h2>
                <i class="fa fa-angle-right"></i>
                TeamPage
            </h2>


            <div class="team_page">
                <div class="content-panel">
                    <h4>
                        <i class="fa fa-home"></i>&nbsp;
                        <?php echo $team_page->team_name?>
                    </h4>
                    <table class="table">
                        <tr>
                            <td rowspan="4" width="150">
                                <form action="/team/page/" method="post" name="pageform">

                                    <input type="hidden" name="team_name" value="<?php echo $team_page->team_name ?>">

                                    <div class="ih-item circle effect13 from_left_and_right"> <a href="javascript:doUpDownTalk(pageform.team_name.value);"/>
                                        <div class="img">
                                            <img src="/public/img/team/<?php echo $team_page->team_pfimage ?>">
                                        </div>

                                        <div class="info">
                                            <div class="info-back">
                                                <h3>Team</h3>
                                                <p>in modify</p>
                                            </div>
                                        </div></a></div>
                                </form>
                            </td>
                            <td class="warning">리더 : <?php echo $team_page->team_leader ?></td>
                        </tr>
                        <tr>
                            <td class="success">실력 : <?php echo $team_page->team_ability ?></td>
                        </tr>
                        <tr>
                            <td class="info">홈&nbsp;&nbsp; : <?php echo $team_page->team_home ?></td>
                        </tr>
                        <tr>
                            <td class="danger">소개 : <?php echo $team_page->team_produce ?></td>
                        </tr>

                    </table>
                </div>
                <hr class="style-six">
                <div class="btn-group btn-group-justified">
                    <div class="btn-group">
                <form action="/team/page/" method="post">
                    <input type="submit" class="btn btn-theme02"  value="소통">
                    <input type="hidden" name="team_name" value="<?php echo $team_page->team_name ?>">
                </form>
                    </div>
                    <div class="btn-group">
                <form action="/team/memberlist/" method="post">
                    <input type="submit" class="btn btn-theme03" value="멤버">
                    <input type="hidden" name="team_name" value="<?php echo $team_page->team_name ?>">
                </form>
                    </div>
                </div>
                <hr class="style-six">
            </div>
        </div><!-- /col-lg-9 END SECTION MIDDLE -->

