<?php

class Teampagereply_model extends CI_Model
{
    function __construct(){
        parent::__construct();
    }

    function getTeamReplyList($teampage_num){
        return $this->db->query("SELECT * FROM teampage_reply WHERE teampage_num ='$teampage_num'")->result();
    }

    function insertReply($user_id, $teampage_num,$teampage_reply_content){
        $date = date('Y-m-d H:i:s');
        $sql = "INSERT INTO teampage_reply(user_id,teampage_num,teampage_reply_content,teampage_reply_date)";
        $sql.=" VALUES('$user_id','$teampage_num','$teampage_reply_content','$date')";

        $this->db->query($sql);
    }
    function modifyReply($teampage_reply_num,$teampage_reply_content){
        $date = date('Y-m-d H:i:s');
        $sql = "UPDATE teampage_reply SET teampage_reply_content='$teampage_reply_content', teampage_reply_date = '$date'";
        $sql.=" WHERE teampage_reply_num = '$teampage_reply_num'";

        $this->db->query($sql);
    }
    function deleteReply($teampage_reply_num){
        $sql = "DELETE FROM teampage_reply WHERE teampage_reply_num = '$teampage_reply_num'";

        $this->db->query($sql);
    }
}