<?php

session_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Replymore extends CI_Controller
{
    function __construct() {
        parent::__construct();

        $this -> load -> database();
        $this -> load -> model('Replymore_model');
    }

    // 댓글 더보기
    public function index()
    {
        $reply_last_num = $_REQUEST['reply_last_num'];

        $limit = $_REQUEST['limit'];
        $parent_board = $_REQUEST['parent_board'];

        $location = $reply_last_num;    // 동적으로 생성될 버튼과 div 값을 위해
        $div_location = 'div_' + $location;
    /*
        echo "$reply_last_num<br/>";
        echo "$limit<br/>";
        echo "$parent_board<br/>";
    */


        $reply = $this -> Replymore_model -> replyGetMore($reply_last_num, $limit, $parent_board);
        //var_dump($reply);
        $check_01 = 0;
        for( $cnt = 0 ; $cnt < count($reply) ; $cnt++) {
            $check_01++;
            $psimage = $reply[$cnt] -> user_psimage;
            $table_num = "table".$reply[$cnt] -> reply_num;
            $reply_id = "reply".$reply[$cnt] -> reply_num;
            //echo $reply[$cnt] -> reply_num;

            echo "<table id='$table_num' class='$reply_id'>";
            echo "<tr>";
            $userId = $reply[$cnt] -> user_id;
            echo "<td>";

            echo "          <div class='desc' data-toggle='modal' data-target='#userModal' data-title='people/$userId'>";
            echo "            <img class='img-circle' src='/public/img/member_s/$psimage'>";
            echo "          <div>";

            echo "</td>";

            echo "<td>";
            echo "&nbsp";
            echo "</td>";


            echo "<td>";

            echo "          <div class='desc' data-toggle='modal' data-target='#userModal' data-title='people/$userId'>";
            echo "              $userId";
            echo "          <div>";

            echo "</td>";

            echo "<td>";
            echo "&nbsp";
            echo "</td>";

            $content = $reply[$cnt] -> reply_content;
            $update_reply = 'update'.$reply[$cnt] -> reply_num;
            echo "<td id='$update_reply'>";
            echo "      <div style='min-height: 3em; min-width: 50em; border : 1px solid black'>";
            echo "          $content";
            echo "      </div>";
            echo "</td>";

            if($_SESSION['loginID'] == $userId){
                $reply_num = $reply[$cnt] -> reply_num;

                echo "<script type='text/javascript' src='/public/assets/js/jquery-1.8.3.min.js'></script>";
                echo "<script src='/public/assets/js/reply_delete.js'></script>";
                echo "<script src='/public/assets/js/reply_update.js'></script>";
                echo "<td>";
                echo "    <div style = 'min-height: 3em; min-width: 50em; border : 0px solid black'>";
                echo "        <span id='reply_update_ready' onclick='reply_update_ready($reply_num)'>수정</span>&nbsp;";
                echo "        <span id='reply_delete' onclick='reply_delete($reply_num);'>삭제</span>";
                echo "    </div>";
                echo "</td>";
            }

            echo "</tr>";
            echo "</table>";
            echo "<p id='space_01'></p>";
            $reply_last_num = $reply[$cnt] -> reply_num;
            $div_location = 'div'.$reply_last_num;

            echo "<script>var reply_last_num = $reply_last_num;</script>";
            echo "<script>var parent_board = $parent_board;</script>";

            if($check_01 >= 5) {
                echo "<script type='text/javascript' src='/public/assets/js/jquery-1.8.3.min.js'></script>";
                echo "<script src='/public/assets/js/reply_more.js'></script>";
                echo "<button id='$reply_last_num' onclick='reply_go($reply_last_num, $limit, $parent_board);'>댓글 더 보기</button>";
                echo "<div id='$div_location'></div>";
                break;
            }
        }

    }

    // 댓글 쓰기
    public function replywrite($time_num){

        $reply_user = $_REQUEST['reply_user'];
        $reply_content = $_REQUEST['reply_content'];
        $reply_date = date("Y-m-d H:i:s",time());


        $inserId = $this -> Replymore_model -> timeline_reply_write($time_num, $reply_content, $reply_user, $reply_date);

        $data = $this -> Replymore_model -> timeline_reply_new($inserId);
        $reply_id = "reply".$data -> reply_num;
        echo "<br>";
        echo "<table class='$reply_id'>";
        echo "<tr>";
        echo "<td>";

        $userId = $data -> user_id;

        echo "          <div class='desc' data-toggle='modal' data-target='#userModal' data-title='people/$userId'>";
        $psimage = $data -> user_psimage;
        echo "                <img class='img-circle' src='/public/img/member_s/$psimage'>";
        echo "          <div>";

        echo "</td>";

        echo "<td>";
        echo "&nbsp";
        echo "</td>";

        echo "<td>";

        echo "          <div class='desc' data-toggle='modal' data-target='#userModal' data-title='people/$userId'>";
        echo "              $userId";
        echo "          <div>";

        echo "</td>";

        echo "<td>";
        echo "&nbsp";
        echo "</td>";

        $content = $data -> reply_content;
        $update_reply = 'update'.$data -> reply_num;
        echo "<td id=$update_reply>";
        echo "      <div style='min-height: 3em; min-width: 50em; border : 1px solid black'>";
        echo "          $content";
        echo "      </div>";
        echo "</td>";
        $reply_num = $data -> reply_num;

        if($_SESSION['loginID'] == $userId){

            echo "<script type='text/javascript' src='/public/assets/js/jquery-1.8.3.min.js'></script>";
            echo "<script src='/public/assets/js/reply_delete.js'></script>";
            echo "<td>";
            echo "    <div style = 'min-height: 3em; min-width: 50em; border : 0px solid black'>";
            echo "        <span id='reply_update_ready' onclick='reply_update_ready($reply_num)'>수정</span>&nbsp;";
            echo "        <span id='reply_delete' onclick='reply_delete($reply_num);'>삭제</span>";
            echo "    </div>";
            echo "</td>";
        }

        echo "</tr>";
        echo "</table>";
        echo "<p id='space_01'></p>";

    }

    // 댓글 삭제
    public function replydelete($time_num){
        //var_dump($time_num);
        $delete = $this -> Replymore_model -> timeline_reply_delete($time_num);
        //echo "$delete";
    }

    // 댓글 수정
    public function replyupdate($reply_num){
        $update_content = $_REQUEST['update_reply_content'];
        $update_time = date("Y-m-d H:i:s",time());
        //var_dump($update_time);
        $this -> Replymore_model -> timeline_reply_update($reply_num, $update_content, $update_time);

        $data = $this -> Replymore_model -> timeline_reply_new($reply_num);

        $content = $data -> reply_content;
        //$update_reply = 'update'.$data -> reply_num;
        echo "<div style='min-height: 3em; min-width: 50em; border : 1px solid black'>$content</div>";

    }

}