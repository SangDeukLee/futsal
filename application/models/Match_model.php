<?php
class Match_model extends CI_Model
{
    function __construct() {
        parent::__construct();
    }
    function getListSupporterBoard($limit)
    {
        // match menu get list 매치 메뉴 리스트 뽑기
        $sql = "SELECT t.*, mb.*
                FROM team t, match_board mb
                where mb.match_writer=t.team_leader
                ORDER BY mb.match_num DESC
                LIMIT 0, $limit";

        $query = $this->db->query($sql);

        return $query->result();
    }
    function getListSupporterBoard_Scroll($last_num, $limit)
    { // 매치 글 스크롤
        $sql = "SELECT t.*, mb.*
                FROM team t, match_board mb
                where mb.match_writer=t.team_leader
                AND match_num < $last_num
                ORDER BY rb.recruit_num DESC
                LIMIT 0, $limit";

        $query = $this->db->query($sql);

        return $query->result();
    }
    function writeMatchBoard($match_writer, $match_rule, $match_address, $match_date, $match_starttime, $match_endtime, $match_content)
    { // match menu write add 매치 메뉴 글쓰기
        $sql = "INSERT INTO match_board (match_writer, match_rule, match_address, match_starttime, match_endtime, match_date, match_content)
                VALUES ('$match_writer', '$match_rule', '$match_address', '$match_starttime', '$match_endtime', '$match_date', '$match_content');";
        $this->db->query($sql);
    }
    function getModifyMatchBoard($match_num)
    { // match menu modifyView print 매치 메뉴의 글 수정을 위해 원글 출력
        $match_num = (int)$match_num;
        $sql = "SELECT * FROM match_board where match_num = $match_num";
        $query = $this->db->query($sql);
        return $query->row();
    }
    function modifyMatchBoard($match_num, $match_rule, $match_address, $match_date, $match_starttime, $match_endtime, $match_content)
    { // match menu modify 매치 메뉴 글 수정
        $match_num = (int)$match_num;
        $sql = "UPDATE match_board SET match_rule = '$match_rule', match_address = '$match_address', match_starttime = '$match_starttime', match_endtime = '$match_endtime', match_date = '$match_date', match_content = '$match_content'
                WHERE match_num = $match_num";
        $this->db->query($sql);
    }
    function delMatchBoard($match_num)
    { // match menu delete 매치 메뉴 글 삭제
        $match_num = (int)$match_num;
        $sql = "DELETE FROM match_board where match_num = $match_num";
        $this->db->query($sql);
    }
    function getTeam($user_id)
    { // 팀네임 획득
        $sql = "SELECT *
                FROM team
                WHERE team_leader = '$user_id'";
        $query = $this->db->query($sql);

        return $query->row();
    }
    function viewMatchBoardInfo($match_num)
    { // 매치 자세히 보기 정보 - 글 정보
        $sql = "SELECT mb.*, t.*
                FROM match_board mb, team t
                WHERE t.team_leader = mb.match_writer
                AND match_num = $match_num";
        $query = $this->db->query($sql);
        return $query->row();
    }
    function viewMatchBoardRequestInfo($match_num)
    { // 매치 자세히 보기 - 신청자 정보
        $sql = "SELECT mr.*, t.*
                FROM match_request mr, team t
                WHERE mr.matchr_user = t.team_leader
                AND mr.match_num = $match_num";
        $query = $this->db->query($sql);
        return $query->result();
    }
    function requestMatchBoard($match_num, $matchr_user)
    {   // 매치 신청 수정 필요
        $sql = "SELECT team_leader FROM team WHERE team_leader = '$matchr_user';";
        $check = $this ->db->query($sql);

        if($check==false) {
            $confirm = false;
        }
        else {
            $sql = "INSERT INTO match_request (matchr_user, match_num)
                VALUES ('$matchr_user', $match_num);";
            $this->db->query($sql);
            $confirm = true;
        }

        return $confirm;
    }
    function gameCancelMatchBoard($matchr_num)
    { // 신청 취소
        $sql = "DELETE FROM match_request WHERE matchr_num = $matchr_num";
        $this->db->query($sql);
    }
    function gameJoinMatchBoard($matchr_num, $match_num)
    { // 매치 수락
        $sql = "UPDATE match_request SET matchr_status = 2 WHERE match_num = $match_num";
        $this->db->query($sql);

        $sql = "UPDATE match_request SET matchr_status = 1 WHERE matchr_num = $matchr_num";
        $this->db->query($sql);

        $sql = "UPDATE match_board SET match_status = 1 WHERE match_num = $match_num";
        $this->db->query($sql);
    }
    function gameRefusalMatchBoard($matchr_num)
    { // 매치 거절
        $sql = "UPDATE match_request SET matchr_status = 2 WHERE matchr_num = $matchr_num";
        $this->db->query($sql);
    }
    function viewTeamMatchInfo($match_num)
    {
        $sql = "SELECT t.*
                FROM team t, match_request mr
                WHERE mr.matchr_user = t.team_leader
                AND mr.matchr_status = 1
                AND mr.match_num = $match_num";
        $query = $this->db->query($sql);
        return @$query->row();
    }
}