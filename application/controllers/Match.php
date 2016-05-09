<?php

session_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Match extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('Match_model');
    }
    public function index()
    {
        $this->getList();
    }
    public function getList() // 매치 리스트
    {
        $last_num = isset($_REQUEST['last_num']) ? $_REQUEST['last_num'] : 0 ;
        $limit = isset($_REQUEST['limit']) ? $_REQUEST['limit'] : 5;
        $is_loading = isset($_REQUEST['is_loading']) ? $_REQUEST['is_loading'] : null;

        $match['match_getList'] = $this->Match_model->getListSupporterBoard($limit);

        if($is_loading) {
            $match['match_getList'] = $this->Match_model->getListSupporterBoard_Scroll($last_num, $limit);
            for($iCount = 0 ; $iCount < count($match['match_getList']) ; $iCount++ ){

                echo "<table class='table table-bordered'>";
                echo "    <tr align=center>";
                echo "          <td rowspan='3' width='15%'>";
                $image = "<img src=../../../public/img/team/".$match['match_getList'][$iCount]->team_pfimage.">";

                echo "$image";
                echo "          </td>";
                echo "          <td>".$match['match_getList'][$iCount]->team_name."</td>";
                echo "          <td colspan='2'>";
                echo "              <button class='btn btn-warning' onclick='location.href=/match/view/'".$match['match_getList'][$iCount]->recruit_num.">"."자세히보기"."</button>";
                echo "          </td>";                echo "    </tr>";
                echo "    <tr align=center>";
                echo "          <td>".$match['match_getList'][$iCount]->team_number."</td>";
                echo "    </tr>";
                echo "    <tr align=center>";
                echo "          <td>".$match['match_getList'][$iCount]->team_home."</td>";
                echo "          <td>".$match['match_getList'][$iCount]->recruit_status."</td>";
                echo "    </tr>";

            }
            echo "<script type='text/javascript'>var last_num = $last_num;</script>";
        }else{

            $this->load->view('./_templates/header.php', $this -> data);
            $this->load->view('./_templates/Laside.php', $this -> data);
            $this->load->view('./match/getlist.php', $match);
            $this->load->view('./_templates/Raside.php', $this -> data);
            $this->load->view('./_templates/footer.php', $this -> data);
        }
    }
    public function writeV() // 글쓰기 뷰
    {
        $user_id = isset($_SESSION['loginID']) ? $_SESSION['loginID'] : null;
        $match['match_taem'] = $this->Match_model->getTeam($user_id);

        $this->load->view('./_templates/header.php', $this -> data);
        $this->load->view('./_templates/Laside.php', $this -> data);
        $this->load->view('match/writev.php', $match);
        $this->load->view('./_templates/Raside.php', $this -> data);
        $this->load->view('./_templates/footer.php', $this -> data);
    }
    public function write() // 매치 글쓰기
    {
        if (isset($_POST["submit_write_match"])) {

            $match_writer = isset($_REQUEST['match_writer']) ? $_REQUEST['match_writer'] : 'kite3305';
            $match_rule = isset($_REQUEST['match_rule']) ? $_REQUEST['match_rule'] : null;
            $match_address = isset($_REQUEST['match_address']) ? $_REQUEST['match_address'] : null;
            $match_date = isset($_REQUEST['match_date']) ? $_REQUEST['match_date'] : null;
            $match_starttime = isset($_REQUEST['match_starttime']) ? $_REQUEST['match_starttime'] : null;
            $match_endtime = isset($_REQUEST['match_endtime']) ? $_REQUEST['match_endtime'] : null;
            $match_content = isset($_REQUEST['match_content']) ? $_REQUEST['match_content'] : null;

            $this->Match_model->writeMatchBoard($match_writer, $match_rule, $match_address, $match_date, $match_starttime, $match_endtime, $match_content);
        }
        $this->index();
    }
    public function modifyv($match_num) // 매치글 수정 폼
    {
        $user_id = isset($_SESSION['loginID']) ? $_SESSION['loginID'] : null;
        $match['match_modify'] = $this->Match_model->getModifyMatchBoard($match_num);
        $match['match_teamName'] = $this->Match_model->getTeam($user_id);

        $this->load->view('./_templates/header.php', $this -> data);
        $this->load->view('./_templates/Laside.php', $this -> data);
        $this->load->view('match/modifyv.php',$match);
        $this->load->view('./_templates/Raside.php', $this -> data);
        $this->load->view('./_templates/footer.php', $this -> data);
    }
    public function modify() // 매치글 수정
    {
        $match_num = isset($_REQUEST['match_num']) ? $_REQUEST['match_num'] : null;
        $match_rule = isset($_REQUEST['match_rule']) ? $_REQUEST['match_rule'] : null;
        $match_address = isset($_REQUEST['match_address']) ? $_REQUEST['match_address'] : null;
        $match_date = isset($_REQUEST['match_date']) ? $_REQUEST['match_date'] : null;
        $match_starttime = isset($_REQUEST['match_starttime']) ? $_REQUEST['match_starttime'] : null;
        $match_endtime = isset($_REQUEST['match_endtime']) ? $_REQUEST['match_endtime'] : null;
        $match_content = isset($_REQUEST['match_content']) ? $_REQUEST['match_content'] : null;

        if (isset($_POST["submit_modify_match"])) {
            $this->Match_model->modifyMatchBoard($match_num, $match_rule, $match_address, $match_date, $match_starttime, $match_endtime, $match_content);
        }
        header('location:/match/view/'.$match_num.'');
    }
    public function del($match_num) // 매치 글 삭제
    {
        $this->Match_model->delMatchBoard($match_num);
        $this->index();
    }
    public function view($match_num) // 매치 자세히 보기
    {
        $match['match_info'] = $this->Match_model->viewMatchBoardInfo($match_num);
        $match['match_request'] = $this->Match_model->viewMatchBoardRequestInfo($match_num);
        $match['match_team'] = $this->Match_model->viewTeamMatchInfo($match_num);

        $this->load->view('./_templates/header.php', $this -> data);
        $this->load->view('./_templates/Laside.php', $this -> data);
        $this->load->view('match/view.php',$match);
        $this->load->view('./_templates/Raside.php', $this -> data);
        $this->load->view('./_templates/footer.php', $this -> data);
    }
    public function request() // 매치 신청
    {
        $matchr_user = isset($_REQUEST['matchr_user']) ? $_REQUEST['matchr_user'] : null;
        $match_num = isset($_REQUEST['match_num']) ? $_REQUEST['match_num'] : null;

        $check = $this->Match_model->requestMatchBoard($match_num, $matchr_user);

        if($check) {
            header('location:/match/view/'.$match_num);
        }
        else {
            echo "<script>alert('리더만 신청가능')</script>";
        }
    }
    public function gameCancel() // 신청 취소
    {
        $match_num = isset($_REQUEST['match_num']) ? $_REQUEST['match_num'] : null;
        $matchr_num = isset($_REQUEST['matchr_num']) ? $_REQUEST['matchr_num'] : null;

        $this->Match_model->gameCancelMatchBoard($matchr_num);
        header('location:/match/view/'.$match_num);
    }
    public function gameJoin() // 매치 승인
    {
        $match_num = isset($_REQUEST['match_num']) ? $_REQUEST['match_num'] : null;
        $matchr_num = isset($_REQUEST['matchr_num']) ? $_REQUEST['matchr_num'] : null;

        $this->Match_model->gameJoinMatchBoard($matchr_num, $match_num);
        header('location:/match/view/'.$match_num);
    }
    public function gameRefusal() // 신청 거절
    {
        $match_num = isset($_REQUEST['match_num']) ? $_REQUEST['match_num'] : null;
        $matchr_num = isset($_REQUEST['matchr_num']) ? $_REQUEST['matchr_num'] : null;

        $this->Match_model->gameRefusalMatchBoard($matchr_num);
        header('location:/match/view/'.$match_num);
    }
}