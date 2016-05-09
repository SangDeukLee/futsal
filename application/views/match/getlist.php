<section id="main-content">
    <section class="wrapper">


        <div class="col-lg-9 main-chart">

            <button class="btn btn-default" onclick="location.href='/match/writev'">글쓰기</button>

            <?php
            $last_num = 0;
            foreach($match_getList as $row) {
                $last_num = $row -> match_num;
                ?>
            <div class="content-panel">
                <table class="table table-bordered">

                    <tr align="center">
                        <td class="danger" width="15%">
                            <?php echo $row->match_starttime ?> ~ <?php echo $row->match_endtime ?>
                        </td>
                        <td class="danger">
                            <button class="btn btn-theme04" onclick="location.href='/Match/view/<?php echo $row->match_num ?>'">자세히보기</button>
                        </td>
                        <td width="150" rowspan="4">
                            <?php if($row->match_status == 0 ) { ?>
                                <img src="/public/assets/img/mojip1.jpg" width="150" height="150">
                            <?php }else{?>
                                <img src="/public/assets/img/mojip2.jpg" width="150" height="150">
                            <?php }?>
                        </td>
                    </tr>
                    <tr align="center">

                        <td rowspan="3">
                            <img src="../../public/img/team/<?=$row->team_pfimage?>" class="img-circle" >
                        </td>
                        <td><?php echo $row->match_writer ?></td>
                    </tr>
                    <tr class="danger" align="center">
                        <td><?php echo $row->match_rule ?></td>
                    </tr>
                    <tr align="center">
                        <td><?php echo $row->match_address ?></td>
                    </tr>
                </table>
                </div>
                <br>
            <?php } ?>
            <div id="scroll">
            </div>

            <script type="text/javascript">
                var last_num = <?php echo "$last_num"; ?>;

            </script>
            <p id="loader" style="text-align: center; display: none"><img src="../../public/assets/img/loader.gif"></p>

        </div>