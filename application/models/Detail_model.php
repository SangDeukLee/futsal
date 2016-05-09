<?php

class Detail_model extends CI_Model
{

    function __construct() {
        parent::__construct();
    }

    // 사용자 정보 들고온다.
    function find_user($id) {

        $sql = "SELECT *
                FROM member
                WHERE user_id = '$id'";

        $query = $this -> db -> query($sql);

        /*$row = $query->result();*/

        return $query -> result();
    }

    function find_ownTeam($team_name) {

        // team으로 찾아야한다.

        $sql = "SELECT *
                FROM   team
                WHERE  team_name = '$team_name';
                 ";

        $query = $this -> db -> query($sql);
        //$query -> execute();

        return $query -> result();
    }


    // 즐겨찾기 유저인지 구한다.
    function favorite_people_check($user_id, $loginID){

        $sql ="SELECT *
               FROM   favorite_people
               WHERE  favorite_user = '$user_id'
               AND    user_id = '$loginID';";

        $query = $this -> db -> query($sql);
        //$query -> execute();

        return $query -> result();
    }

    // 즐겨찾기 팀인지 구한다
    function favorite_team_check($loginID, $team_name){

        $sql = "SELECT *
                FROM    favorite_team
                WHERE   team_name = '$team_name'
                AND     user_id = '$loginID';";

        $query = $this -> db -> query($sql);

        return $query -> row();
    }

    // 메세지 내용 구하기 전 읽음 상태로 변경한다.
    function update_set($message_num){
        $sql = "UPDATE message SET read_status = 1 WHERE message_num = $message_num;";
        $query = $this->db->query($sql);
    }

    // 메세지 내용 구한다
    function find_message($message_num){

        $sql = "SELECT *
                FROM    message
                WHERE     message_num = '$message_num';";

        $query = $this -> db -> query($sql);

        return $query -> row();
    }
}