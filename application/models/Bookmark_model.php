<?php


class Bookmark_model extends CI_Model
{

    function __construct() {
        parent::__construct();
    }

    function delete_start($id, $loginID) {

        $sql = "DELETE FROM favorite_people
                WHERE user_id = '$loginID'
                AND favorite_user = '$id';";

        return $this->db->query($sql);
    }

    function insert_start($id, $loginID) {

        $sql = "INSERT INTO favorite_people (favorite_user, user_id)
                VALUES ('$id', '$loginID');";

        return $this->db->query($sql);
    }

    function team_delete_start($team_name, $loginID){
        $sql = "DELETE FROM favorite_team
                WHERE user_id = '$loginID'
                AND team_name = '$team_name';";

        return $this->db->query($sql);
    }

    function team_insert_start($team_name, $loginID){

        $sql = "INSERT INTO favorite_team (team_name, user_id)
                VALUES ('$team_name', '$loginID');";

        return $this->db->query($sql);
    }
}