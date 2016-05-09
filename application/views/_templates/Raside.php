    <div id="rsidebar" class="col-lg-3 ds" style="z-index: 999">

        <!-- --------------------------------------------------------------->
        <ul id="myTab" class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a data-target="#friends" id="friend-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">Friends</a></li>
            <li role="presentation" class=""><a data-target="#teams" role="tab" id="teams-tab" data-toggle="tab" aria-controls="teams" aria-expanded="false">Teams</a></li>
            <li role="presentation" class=""><a data-target="#ownTeam" role="tab" id="ownTeam-tab" data-toggle="tab" aria-controls="ownTeam" aria-expanded="false">MyTeams</a></li>
        </ul>


        <div id="myTabContent" class="tab-content">

            <!-- 즐겨찾기 유저 상세보기 -->
            <div role="tabpanel" class="tab-pane fade active in" id="friends" aria-labelledby="home-tab">
                <?php foreach($favorites_User as $row){ ?>
                    <div class="desc" data-toggle="modal" data-target="#userModal" data-title="people/<?php echo $row -> user_id?>">
                        <div class="thumb">
                            <img class="img-circle" src="/public/img/member_s/<?=$row -> user_psimage?>" align="left">
                        </div>

                        <div class="details" align="center">
                            <p>
                                <?php echo $row -> user_id ?><br/>
                                <muted>Available</muted>
                            </p>
                        </div>
                    </div>

                <?php } ?>
            </div>

            <!-- 팀 상세보기 -->
            <div role="tabpanel" class="tab-pane fade" id="teams" aria-labelledby="profile-tab">
                <?php /*var_dump($favorites_team)*/
                        foreach($favorites_team as $row) {
                ?>
                            <div class="desc" data-toggle="modal" data-target="#teamModal" data-title="team/<?php echo $row -> team_name?>">
                                <div class="thumb">
                                    <img class="img-circle" src="/public/img/team_s/<?=$row -> team_psimage?>" align="left">
                                </div>

                                <div class="details" align="center">
                                    <p>
                                        <?php echo $row -> team_name ?><br/>
                                        <muted>Available</muted>
                                    </p>
                                </div>
                            </div>
                <?php   }
                ?>
            </div>

            <!-- 즐겨찾기 소속팀 상세보기 -->
            <div role="tabpanel" class="tab-pane fade" id="ownTeam" aria-labelledby="ownTeam-tab">
                <?php foreach($own_Team as $row){
                       if(($row->main_team_check) != 0 ){


                    ?>

                    <div class="desc" data-toggle="modal" data-target="#ownTeamModal" data-title="ownTeam/<?php echo $row -> team_name?>" style="background-color:#F2FFED;">
                        <div class="thumb">
                            <img class="img-circle" src="/public/img/team_s/<?=$row -> team_psimage?>" align="left">
                        </div>
                        <div class="details" align="center">
                            <p>
                                <?php echo $row -> team_name ?><br/>
                                <muted>Available</muted>
                            </p>
                        </div>
                    </div>
                    <?php }
                       else{  ?>
                           <div class="desc" data-toggle="modal" data-target="#ownTeamModal" data-title="ownTeam/<?php echo $row -> team_name?>">
                               <div class="thumb">
                                   <img class="img-circle" src="/public/img/team_s/<?=$row -> team_psimage?>" align="left">
                               </div>
                               <div class="details" align="center">
                                   <p>
                                       <?php echo $row -> team_name ?><br/>
                                       <muted>Available</muted>
                                   </p>
                               </div>
                           </div>

                           <?php }?>
                <?php } ?>
            </div>


        </div>
    </div>

    </section>

    <!-- --------------------------------------------------------------->
