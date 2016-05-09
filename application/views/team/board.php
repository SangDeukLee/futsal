<?php
if (!$teamMember) { ?>
    <script>
        window.alert('팀 멤버가 아닐 경우 게시글 읽기만 가능합니다')
    </script>
<?php }?>
<div class="col-lg-9 main-chart">
    <div class="content-panel">
        <h4>
            <i class="fa fa-list-alt"></i>
            Board
        </h4>
        <hr>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>카테고리</th>
                    <th>작성자</th>
                    <th>제목</th>
                    <th>작성일</th>
                </tr>
                </thead>
                <tbody>
                    <?php if ($team_board != null) {
                    foreach ($team_board as $row) {
                    $gap = "";
                    $key = "";
                    for ($cnt = 0; $cnt < $row->teampage_depth; $cnt++) {
                        $gap = "&nbsp&nbsp" . $gap;
                        $key = "└";
                    }
                    ?>
                    <tr>
                            <td><?php echo $row->teampage_category; ?></td>
                            <td><?php echo $row->user_id ?></td>
                            <td><?php echo "$gap$key" ?><a
                                    href="/team/view/<?php echo $row->teampage_num ?>/0/0"><?php echo $row->teampage_title ?></a>
                            </td>
                            <td><?php echo $row->teampage_date ?></td>
                        </tr>
                    <?php }
                } ?>
                    </tbody>
            </table>
                <br>
                <div align="center"><?php echo $links; ?></p>
        </div>
            <div align="left">
                <form action="/team/writev" method="post">
                    <?php if ($teamMember) {
                        echo '<input type="submit" class="btn btn-primary" value="글쓰기">';
                    } ?>
                    <input type="hidden" name="team_name" value="<?php echo $team_page->team_name ?>">
                </form>
            </div>
    </div><!-- /col-md-12 -->
</div><!-- /col-lg-9 END SECTION MIDDLE -->

