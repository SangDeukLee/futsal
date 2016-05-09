<?php

session_start();

defined('BASEPATH') OR exit('No direct script access allowed');
class Mypage extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();

    }

    public function index()
    {


        // 내 타임라인
        if(($this -> data['timeline_user'] == $this -> data['user_id']) ){

            $last_notice_num = isset($_REQUEST['last_notice_num']) ? $_REQUEST['last_notice_num'] : 0;
            $limit = isset($_REQUEST['limit']) ? $_REQUEST['limit'] : 5;
            $is_loading = isset($_REQUEST['is_loading']) ? $_REQUEST['is_loading'] : null;

            $this->load->model('Timeline_model');
            $timeline = $this -> Timeline_model;

            if($last_notice_num == 0 ) {
                $timelineList = $this -> data['timelineList'] = $timeline -> timelineList_01($this -> data['timeline_user'], $limit);
            }
            else {
                $timelineList = $this -> data['timelineList'] = $timeline -> timelineList_02($this -> data['timeline_user'], $last_notice_num, $limit);
            }


            // 리플 목록
            $this->load->model('Timelinereply_model');
            $timeline_reply = $this -> data['timeline_reply'] = $this -> Timelinereply_model -> getList($this -> data['timelineList']);



            // 스크롤 요청 들어왔나???
            if($is_loading){
                require_once "Mypage_01.php";
            }
            else {

                $this->load->view('./_templates/header.php', $this -> data);
                $this->load->view('./_templates/Laside.php', $this -> data);
                $this->load->view('./mypage/index.php', $this -> data);
                $this->load->view('./_templates/Raside.php', $this -> data);
                $this->load->view('./_templates/footer.php', $this -> data);

            }
        }

        // 다른 사람 타임라인
        else {



            $last_notice_num = isset($_REQUEST['last_notice_num']) ? $_REQUEST['last_notice_num'] : 0;
            $limit = isset($_REQUEST['limit']) ? $_REQUEST['limit'] : 5;
            $is_loading = isset($_REQUEST['is_loading']) ? $_REQUEST['is_loading'] : null;

            $this->load->model('Timeline_model');
            $timeline = $this -> Timeline_model;

            if($last_notice_num == 0 ) {
                $timelineList = $this -> data['timelineList'] = $timeline -> otherTimelineList_01($this -> data['timeline_user'], $limit);
            }
            else {
                $timelineList = $this -> data['timelineList'] = $timeline -> otherTimelineList_02($this -> data['timeline_user'], $last_notice_num, $limit);
            }


            // 리플 목록
            $this->load->model('Timelinereply_model');
            $timeline_reply = $this -> data['timeline_reply'] = $this -> Timelinereply_model -> getList($this -> data['timelineList']);



            // 스크롤 요청 들어왔나???
            if($is_loading){
                require_once "Mypage_01.php";
            }
            else {

                $this->load->view('./_templates/header.php', $this -> data);
                $this->load->view('./_templates/Laside.php', $this -> data);
                $this->load->view('./mypage/index.php', $this -> data);
                $this->load->view('./_templates/Raside.php', $this -> data);
                $this->load->view('./_templates/footer.php', $this -> data);

            }
        }
    }


    public function mypageWrite()
    {


        $content = isset($_REQUEST['content']) ? $_REQUEST['content'] : null;


        $this->load->model('Timeline_model');
        $timeline = $this -> Timeline_model;

        $writeCheck = $timeline -> writeStart($content, $this->data['user_id']);

        if($writeCheck == true) {
            $this -> index();
        }
        else {
            echo "<script>alert('글 쓰기 실패하였습니다.'); history.back(-1);</script>";
        }
    }

}
?>