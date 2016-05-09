<?php
class Message_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }



    // 초기 페이지 진입시 총 메세지 들고옴
    function getMessage($user) {
        $sql = "SELECT    mes.*, m.user_psimage
                FROM      message mes, member m
                WHERE     mes.user_receive = '$user'
                AND       mes.user_send = m.user_id
                ORDER BY  mes.send_date DESC;
                ";

        $query = $this->db->query($sql);

        return $query->result();
    }

    // 메세지 숫자(ajax)
    function getMessage_01($user) {
        $sql = "SELECT count(*) as aa
                FROM   message
                WHERE  user_receive = '$user'
                AND    read_status = 0;";

        $query = $this->db->query($sql);

        return $query->result();
    }
}
