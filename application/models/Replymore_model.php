<?php


class Replymore_model extends CI_Model
{

    function __construct() {
        parent::__construct();
    }

    public function replyGetMore($reply_last_num, $limit, $parent_board){

        $sql = "
                SELECT   t.*, m.*
                FROM     timeline_reply t, member m
                WHERE    t.user_id = m.user_id
                AND      time_num = $parent_board
                AND      reply_num < $reply_last_num
                ORDER BY reply_date DESC
                LIMIT    0, $limit;
                ";
        $query = $this -> db -> query($sql);
        return $query -> result();
    }

    // 댓글 쓰기
    function timeline_reply_write($time_num, $content, $reply_user, $reply_date){

        $sql = "INSERT INTO timeline_reply(reply_num, time_num, user_id, reply_content, reply_date)
                VALUES ('', '$time_num', '$reply_user', '$content', '$reply_date');";
        $this->db->query($sql);

        return  $this->db->insert_id();
    }

    // 쓰기 후 마지막 아이디
    function timeline_reply_new($insertId){

        $sql = "
                SELECT t.*, m.*
                FROM timeline_reply t, member m
                WHERE t.user_id = m.user_id
                AND   t.reply_num = $insertId;
        ";
        $query = $this -> db -> query($sql);
        return $query -> row();
    }

    // 댓글 삭제
    function timeline_reply_delete($reply_num) {

        $sql = "DELETE FROM timeline_reply WHERE reply_num = $reply_num";

        return  $this->db->query($sql);
        //return $sql;
    }

    // 댓글 수정
    function timeline_reply_update($reply_num, $update_content, $update_time) {

        $sql = "UPDATE timeline_reply SET reply_content = '$update_content', reply_date = '$update_time'
                WHERE  reply_num = $reply_num";

        return $this -> db -> query($sql);

    }



    /*function getList($timelineList){



        for( $cnt = 0 ; $cnt < count($timelineList) ; $cnt++ ) {
            $time_num = $timelineList[$cnt] -> time_num;

            $sql = "SELECT t.*, m.*
                    FROM timeline_reply t, member m
                    WHERE t.user_id = m.user_id
                    AND time_num = '$time_num'
                    ORDER BY reply_date DESC;";
            $query = $this->db->query($sql);
            $data[$cnt] = $query -> result();
        }

        return @$data;

    }*/
}