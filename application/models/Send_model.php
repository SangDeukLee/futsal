<?php

class Send_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function insert_message($receive_name, $sender_name, $message){

        $sql = "INSERT INTO message (message_num, user_send, user_receive, message_content, send_date, read_status)
                VALUES ('','$sender_name', '$receive_name', '$message', now(), '');";

        return $this->db->query($sql);
    }

    // 안 읽은 메세지
    function select_noread_message($receive_name){

        $sql = "SELECT COUNT(*) as aa, m.*
                FROM message m
                WHERE m.user_receive = '$receive_name'
                AND   m.read_status = 0;";

        $query = $this -> db -> query($sql);

        return $query -> row();
    }

    // 초기 화면 안 읽은 메세지
    function select_noread_message_01($receive_name){

        $sql = "SELECT COUNT(*) as aa
                FROM message
                WHERE user_receive = '$receive_name'
                AND   read_status = 0;";

        $query = $this -> db -> query($sql);

        return $query -> row();
    }
}