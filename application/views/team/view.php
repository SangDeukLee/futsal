
<?php
    $modifyDistinction = isset($modifyDistinction)?$modifyDistinction:null;
?>
<div class="col-lg-9 main-chart">
    <div class="team_page_board">

        <h2>제목 : <?php echo $team_page->teampage_title; ?></h2>

        <p>글쓴이 : <?php echo $team_page->user_id; ?>
            작성일 : <?php echo $team_page->teampage_date; ?></p>

        <p>세부내용<br> <?php echo $team_page->teampage_content; ?></p>
        <hr color="black" width=100%>
        <a href="/team/delete/<?php echo $team_page->teampage_num ?>"> 삭제</a>
        <a href="/team/modifyV/<?php echo $team_page->teampage_num ?>"> 수정</a>
        <a href="/team/repage/<?php echo $team_page->teampage_num ?>"> 목록</a>
        <form action="/team/writev" method="post" >
            <input type="hidden" name="team_name" value="<?php echo $team_page->team_name ?>">
            <input type="hidden" name="teampage_num" value="<?php echo $team_page->teampage_num ?>">
            <input type="submit" name="submit_teampage_response" value="답글">
        </form>
    </div>
    <hr color="black" width=100%>
    <h3>댓글</h3><br/>

    <?php
    if($team_reply){ ?>
    <table border='0'><tr><th>댓글번호</th><th width="325">내용</th><th>작성자</th><th>최종작성일자</th><th>수정</th><th>삭제</th></tr>

        <?php for($cnt = 0 ; $cnt < count($team_reply) ; $cnt++){
            ?>
            <tr>
                <td align="center"><?php echo $team_reply[$cnt]->teampage_reply_num; ?></td>
                <?php if(! ($modifyDistinction && $user_id==$team_reply[$cnt]->user_id && $teampage_reply_num==$team_reply[$cnt]->teampage_reply_num)){ ?>
                    <td><?php echo $team_reply[$cnt]->teampage_reply_content ?></td>
                <?php }else{ ?>
                    <td>
                        <form name="reply_modify" action="/team/teampageReplyModify/" method="post">
                            <input type="hidden" name="teampage_num" value="<?= $team_page->teampage_num ?>">
                            <input type="hidden" name="teampage_reply_num" value="<?= $teampage_reply_num ?>">
                            <textarea name="teampage_reply_content" rows="5" cols="50"><?=$team_reply[$cnt]->teampage_reply_content?></textarea>
                            <input type="submit" value="수정하기">
                            <input type="reset" value="취소">
                        </form>
                    </td>
                <?php } ?>
                <td align="center"><?php echo $team_reply[$cnt]->user_id?></td>
                <td><?= $team_reply[$cnt]->teampage_reply_date?></td>
                <?php if($user_id == $team_reply[$cnt]->user_id){?>
                    <td><a href='/team/view/<?=$team_page->teampage_num."/".$team_reply[$cnt]->teampage_reply_num?>/111'>수정</a></td>
                    <td><a href='/team/teampageReplyDelete/<?=$team_page->teampage_num."/".$team_reply[$cnt]->teampage_reply_num ?>'>삭제</a></td>
                <?php }else{ ?>
                    <td>수정</td>
                    <td>삭제</td>
                <?php } ?>
            </tr>
        <?php } ?>
    </table>
    <?php }

    /*if( $replyList ){   //여기는 댓글 페이지네이션

        include_once "./body/common/replyPageNavi.php";

        $targetAction = 714;
        $pageNumParaName = "rpageNum";
        pageNavigator( $free_replyPageInfo , $targetAction, $pageNumParaName,$board['fnum'],$id );
    }*/


    ?>

    <div id="boardComment">
        <form name="write_reply" action="/team/teampageReplyWrite/" method="post">
            <input type="hidden" name="teampage_num" value="<?= $team_page->teampage_num ?>">
            <br/>
            <table>
                <tbody>
                <tr>
                    <th scope="row"><label for="Id">아이디</label></th>
                    <td><input type="text" name="user_id" value="<?= $user_id ?>" readonly/></td>
                </tr>
                <tr>
                    <th scope="row"><label for="content">내용</label></th>
                    <td><textarea name="teampage_reply_content"></textarea></td>
                </tr>
                </tbody>
            </table>
            <?php if($user_id){?>
                <div class="btnSet">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="submit" value="코멘트 작성">
                </div>
            <?php }else {?>
                댓글을 입력하시려면 로그인하세요!
            <?php } ?>
            <br/>
        </form>
        <div>
            <hr noshade size=1>
        </div>
    </div>

</div><!-- /col-lg-9 END SECTION MIDDLE -->

