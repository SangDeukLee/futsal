<section id="main-content">
    <section class="wrapper">


            <div class="col-lg-9 main-chart">

                <?php if(!empty($teamLeaderCheck)) {?>
                <button class="btn btn-default" onclick="location.href='/Recruit/writev'">글쓰기</button>
                <?php }?>

                    <?php
                    $last_num = 0;
                    foreach($recruit_getList as $row) {
                        $last_num = $row -> recruit_num;
                        ?>
                        <table class="table table-bordered">
                            <tr align="center">
                                <td rowspan="3" width="15%">
                                    <img src="../../public/img/team/<?=$row->team_pfimage?>">
                                </td>
                                <td><?php echo $row->team_name ?></td>
                                <td rowspan="2">
                                    <button class="btn btn-warning" onclick="location.href='/recruit/view/<?php echo $row->recruit_num ?>'">자세히보기</button>
                                </td>
                            </tr>
                            <tr align="center">
                                <td>현재 인원 :<?php echo $row->team_number ?></td>
                            </tr>
                            <tr>
                                <td><?php echo $row->team_home ?></td>
                                <td>
                                    <?php if($row->recruit_status == 0 ) { ?>
                                        모집중
                                    <?php }else{?>
                                        모집완료
                                    <?php }?>
                                </td>
                            </tr>
                        </table>
                        <br>
                    <?php } ?>
                    <div id="scroll">
                    </div>

                    <script type="text/javascript">
                        var last_num = <?php echo "$last_num"; ?>;

                    </script>
                    <p id="loader" style="text-align: center; display: none"><img src="../../public/assets/img/loader.gif"></p>

            </div>