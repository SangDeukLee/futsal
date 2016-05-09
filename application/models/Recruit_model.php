<?php
class Recruit_model extends CI_Model
{
    function __construct() {
        parent::__construct();
    }
    function getListRecruitBoard( $limit)
    { // getList 팀원모집글 획득
        $sql = "SELECT rb.*, t.*
                FROM recruit_board rb, team t
                WHERE rb.recruit_writer = t.team_leader
                ORDER BY rb.recruit_num DESC
                LIMIT 0, $limit";
        $query = $this->db->query($sql);
        return $query->result();
    }
    function getListRecruitBoard_Scroll($last_num, $limit)
    { // 팀원 모집글 스크롤
        $sql = "SELECT rb.*, t.*
                FROM recruit_board rb, team t
                WHERE rb.recruit_writer = t.team_leader
                AND    rb.recruit_num < $last_num
                ORDER BY rb.recruit_num DESC
                LIMIT  0, $limit;";
        $query = $this->db->query($sql);
        return $query->result();
    }
    function getTeamName($user_id)
    { // 팀네임 획득
        $sql = "SELECT team_name, team_home
                FROM team
                WHERE team_leader = '$user_id'";
        $query = $this->db->query($sql);
        return $query->row();
    }
    function writeRecruitBoard($recruit_writer, $recruit_content)
    { // 팀원모집글 쓰기
        $sql = "INSERT INTO recruit_board (recruit_writer, recruit_content) VALUES ('$recruit_writer', '$recruit_content')";
        $this->db->query($sql);
    }
    function viewRecruitBoard($recruit_num)
    { // 팀원모집글 자세히보기
        $sql = "SELECT t.*, rb.*
                FROM team t, recruit_board rb
                WHERE t.team_leader = rb.recruit_writer
                AND rb.recruit_num = $recruit_num";
        $query = $this->db->query($sql);
        return $query->row();
    }
    function viewRecruitBoardRequest($recruit_num)
    { // 팀원 모집글에 신청한 신청자 획득
        $sql = "SELECT m.*, rr.*
                FROM member m, recruit_request rr
                WHERE m.user_id = rr.recruitr_user
                AND rr.recruit_num = $recruit_num";
        $query = $this->db->query($sql);
        return $query->result();
    }
    function modifyRecruitBoard($recruit_num, $recruit_content)
    { // 팀원 모집글 수정
        $sql = "UPDATE recruit_board SET recruit_content = '$recruit_content' WHERE recruit_num = $recruit_num";
        $this->db->query($sql);
    }
    function delRecruitBoard($recruit_num)
    { // 팀원 모집글 삭제
        $sql = "DELETE FROM recruit_board WHERE recruit_num = $recruit_num";
        $this->db->query($sql);
    }
    function requestRecruitBoard($recruit_num, $recruitr_user)
    { // 팀원 신청
        $sql = "INSERT INTO recruit_request (recruit_num, recruitr_user) VALUES ($recruit_num, '$recruitr_user')";
        $this->db->query($sql);
    }
    function teamJoinRecruitBoard($recruitr_num, $team_name, $user_id)
    { // 팀원 신청 수락
        $sql = "UPDATE recruit_request SET recruitr_status = 1 WHERE recruitr_num = $recruitr_num";
        $this->db->query($sql);

        $sql = "INSERT INTO attach_team (attach_team_num, team_name, user_id) VALUES ('','$team_name', '$user_id')";
        $this->db->query($sql);

        $sql = "UPDATE team SET team_number = team_number+1 WHERE team_name = '$team_name'";
        $this->db->query($sql);
    }
    function teamRefusalRecruitBoard($recruitr_num)
    { // 팀원 신청 거절
        $sql = "UPDATE recruit_request SET recruitr_status = 2 WHERE recruitr_num = $recruitr_num";
        $this->db->query($sql);
    }
    function gameCencelRecruitBoard($recruitr_num)
    { // 팀원 신청 취소
        $sql = "DELETE FROM recruit_request WHERE recruitr_num = $recruitr_num";
        $this->db->query($sql);
    }
    function teamLeadeCheck($user_id)
    { // 팀 리더 체크
        $sql = "SELECT * FROM team WHERE team_leader = '$user_id';";
        $query = $this->db->query($sql);
        return $query->row();

    }
}