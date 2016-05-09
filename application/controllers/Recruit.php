<?php

session_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Recruit extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('Recruit_model');
    }
    function index()
    {
        $this->getList();
    }
    public function getList() // 팀원 모집 게시판 출력
    {
        $user_id = isset($_SESSION['loginID']) ? $_SESSION['loginID'] : null;
        $last_num = isset($_REQUEST['last_num']) ? $_REQUEST['last_num'] : 0 ;
        $limit = isset($_REQUEST['limit']) ? $_REQUEST['limit'] : 5;
        $is_loading = isset($_REQUEST['is_loading']) ? $_REQUEST['is_loading'] : null;

        $recruit['recruit_getList'] = $this->Recruit_model->getListRecruitBoard($limit);

        // 팀 리더인지 확인
        $recruit['teamLeaderCheck'] = $this->Recruit_model->teamLeadeCheck($user_id);

        if($is_loading) {
            $recruit['recruit_getList'] = $this->Recruit_model->getListRecruitBoard_Scroll($last_num, $limit);
            for($iCount = 0 ; $iCount < count($recruit['recruit_getList']) ; $iCount++ ){

                echo "<table class='table table-bordered'>";
                echo "    <tr align=center>";
                echo "          <td rowspan='3' width='15%'>";
                $image = "<img src=../../../public/img/team/".$recruit['recruit_getList'][$iCount]->team_pfimage.">";

                echo "$image";
                echo "          </td>";
                echo "          <td>".$recruit['recruit_getList'][$iCount]->team_name."</td>";
                echo "          <td colspan='2'>";
                echo "              <button class='btn btn-warning' onclick='location.href=/recruit/view/'".$recruit['recruit_getList'][$iCount]->recruit_num.">"."자세히보기"."</button>";
                echo "          </td>";                echo "    </tr>";
                echo "    <tr align=center>";
                echo "          <td>".$recruit['recruit_getList'][$iCount]->team_number."</td>";
                echo "    </tr>";
                echo "    <tr align=center>";
                echo "          <td>".$recruit['recruit_getList'][$iCount]->team_home."</td>";
                echo "          <td>".$recruit['recruit_getList'][$iCount]->recruit_status."</td>";
                echo "    </tr>";
            }
            echo "<script type='text/javascript'>var last_num = $last_num;</script>";
        }else{
            $this->load->view('./_templates/header.php', $this -> data);
            $this->load->view('./_templates/Laside.php', $this -> data);
            $this->load->view('./recruit/getlist.php', $recruit);
            $this->load->view('./_templates/Raside.php', $this -> data);
            $this->load->view('./_templates/footer.php', $this -> data);
        }
    }
    public function writev() // 글쓰기 뷰
    {
        $user_id = isset($_SESSION['loginID']) ? $_SESSION['loginID'] : null;

        $recruit['recruit_team_name'] = $this->Recruit_model->getTeamName($user_id);

        $this->load->view('./_templates/header.php', $this -> data);
        $this->load->view('./_templates/Laside.php', $this -> data);
        $this->load->view('./recruit/writev.php', $recruit);
        $this->load->view('./_templates/Raside.php', $this -> data);
        $this->load->view('./_templates/footer.php', $this -> data);
    }
    public function write() // 글쓴거 DB에 저장
    {
        if (isset($_POST["submit_write_recruit"])) {

            $recruit_writer = isset($_REQUEST['recruit_writer']) ? $_REQUEST['recruit_writer'] : 'error';
            $recruit_content = isset($_REQUEST['recruit_content']) ? $_REQUEST['recruit_content'] : null;

            $this->Recruit_model->writeRecruitBoard($recruit_writer, $recruit_content);
        }
        $this->index();
    }
    public function view($recruit_num) // 자세히 보기
    {
        $recruit['recruit_team_board'] = $this->Recruit_model->viewRecruitBoard($recruit_num);
        $recruit['recruit_request'] = $this->Recruit_model->viewRecruitBoardRequest($recruit_num);

        $this->load->view('./_templates/header.php', $this -> data);
        $this->load->view('./_templates/Laside.php', $this -> data);
        $this->load->view('./recruit/view.php', $recruit);
        $this->load->view('./_templates/Raside.php', $this -> data);
        $this->load->view('./_templates/footer.php', $this -> data);
    }
    public function modifyv($recruit_num)
    {
        $user_id = isset($_SESSION['loginID']) ? $_SESSION['loginID'] : null;

        $recruit['recruit_board'] = $this->Recruit_model->viewRecruitBoard($recruit_num);
        $recruit['recruit_team_name'] = $this->Recruit_model->getTeamName($user_id);

        $this->load->view('./_templates/header.php', $this -> data);
        $this->load->view('./_templates/Laside.php', $this -> data);
        $this->load->view('./recruit/modifyv.php', $recruit);
        $this->load->view('./_templates/Raside.php', $this -> data);
        $this->load->view('./_templates/footer.php', $this -> data);
    }
    public function modify() // 수정
    {
        $recruit_num = isset($_REQUEST['recruit_num']) ? $_REQUEST['recruit_num'] : null;
        $recruit_content = isset($_REQUEST['recruit_content']) ? $_REQUEST['recruit_content'] : null;

        if (isset($_POST["submit_modify_recruit"])) {
            $this->Recruit_model->modifyRecruitBoard($recruit_num, $recruit_content);
        }
        header('location:/recruit/view/'.$recruit_num.'');
    }
    public function del($recruit_num) // 삭제
    {
        $this->Recruit_model->delRecruitBoard($recruit_num);

        header('location:/recruit/index');
    }
    public function request() // 팀원 신청
    {
        if (isset($_POST["submit_request_recruit"])) {

            $recruit_num = isset($_REQUEST['recruit_num']) ? $_REQUEST['recruit_num'] : null;
            $recruitr_user = isset($_REQUEST['recruitr_user']) ? $_REQUEST['recruitr_user'] : null;

            $this->Recruit_model->requestRecruitBoard($recruit_num, $recruitr_user);

            header('location:/recruit/view/'.$recruit_num.'');
        }
    }
    public function teamJoin() // 신청 승인
    {
        if (isset($_POST["submit_join_recruit"])) {

            $recruit_num = isset($_REQUEST['recruit_num']) ? $_REQUEST['recruit_num'] : null;
            $recruitr_num = isset($_REQUEST['recruitr_num']) ? $_REQUEST['recruitr_num'] : null;
            $team_name = isset($_REQUEST['team_name']) ? $_REQUEST['team_name'] : null;
            $user_id = isset($_REQUEST['user']) ? $_REQUEST['user'] : null;

            $this->Recruit_model->teamJoinRecruitBoard($recruitr_num, $team_name, $user_id);

            header('location:/recruit/view/'.$recruit_num.'');
        }
    }
    public function teamRefusal() // 신청 거부
    {
        if (isset($_POST["submit_refusal_recruit"])) {

            $recruit_num = isset($_REQUEST['recruitr_num']) ? $_REQUEST['recruit_num'] : null;
            $recruitr_num = isset($_REQUEST['recruitr_num']) ? $_REQUEST['recruitr_num'] : null;

            $this->Recruit_model->teamRefusalRecruitBoard($recruitr_num);

            header('location:/recruit/view/'.$recruit_num.'');
        }
    }
    public function gameCancel() // 신청 취소
    {
        if (isset($_POST["submit_cancel_recruitr"])) {

            $recruit_num = isset($_REQUEST['recruitr_num']) ? $_REQUEST['recruit_num'] : null;
            $recruitr_num = isset($_REQUEST['recruitr_num']) ? $_REQUEST['recruitr_num'] : null;

            $this->Recruit_model->gameCencelRecruitBoard($recruitr_num);

            header('location:/recruit/view/' . $recruit_num . '');
        }
    }
}