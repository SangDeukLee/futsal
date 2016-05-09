<?php

session_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Detail extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->load->database();
        $this->load->model('Detail_model');
    }

    public function index()
    {

        $param = $_REQUEST['param'];
        $category = explode("/", $param);
        $num = isset($_REQUEST['message_num']) ? $_REQUEST['message_num'] : null;

        //var_dump($category[0]);
        // var_dump($num);

        // 사람
        if ($category[0] == "people") {
            $this->people($category[1]);
        }

        // 소속팀, 팀
        else if ($category[0] == "team") {
            $this->ownTeam($category[1]);
        }


        else if ($category[0] == "ownTeam") {
            $this->ownTeam($category[1]);
        }

        // 메세지 상세보기
        else if ($category[0] == "message") {
            //var_dump($category[2]);
            $this -> message($category[2]);
        }


    }


    // ajax로 상세보기 모달창 사람 정보 들고온다.
    public function people($user_id)
    {

        // 받은 user_id로 사용자 정보를 구한다.
        $detail_list = $this->Detail_model->find_user($user_id);


        $pfimage = $detail_list[0]->user_pfimage;

        $home = $detail_list[0]->user_home;
        $phone = $detail_list[0]->user_phone;
        $email = $detail_list[0]->user_email;
        $ability = $detail_list[0]->user_ability;

        // 즐겨찾기 된 유저인지 구한다(버튼표시 위해)
        $loginID = isset($_SESSION['loginID']) ? $_SESSION['loginID'] : null;
        $favorite_people_list = $this->Detail_model->favorite_people_check($user_id, $loginID);

        if (($favorite_people_list)) {
            $star = "YES";

        } else {
            $star = "NO";
        }

        for ($iCount = 0; $iCount < count($detail_list); $iCount++) {
            echo "
                <img src='/public/img/member/$pfimage' align='middle'>
                <br/>
                <br/>
                <table class='table table-striped'>
                    <tr>
                        <td>휴대폰</td><td>$phone</td>
                    </tr>
                    <tr>
                        <td>email</td><td>$email</td>
                    </tr>
                    <tr>
                        <td>홈그라운드</td><td>$home</td>
                    </tr>
                    <tr>
                        <td>능력</td><td>$ability</td>
                    </tr>
                </table>
                <span id='star'>$star</span>

            ";
        }
    }

    public function ownTeam($team_name)
    {

        // 받은 user_id로 소속 팀을 구한다.
        $detail_list = $this->Detail_model->find_ownTeam($team_name);


        $leader = $detail_list[0]->team_leader;
        $ability = $detail_list[0]->team_ability;
        $produce = $detail_list[0]->team_produce;
        $home_ground = $detail_list[0]->team_home;
        $NumberOfTeam = $detail_list[0]->team_number;
        $pfimage = $detail_list[0]->team_pfimage;

        // 즐겨찾기 된 팀인지 구한다(버튼표시 위해)
        $loginID = isset($_SESSION['loginID']) ? $_SESSION['loginID'] : null;
        $favorite_team_list = $this->Detail_model->favorite_team_check($loginID, $team_name);

        if (($favorite_team_list)) {
            $star = "YES";

        } else {
            $star = "NO";
        }


        for ($iCount = 0; $iCount < count($detail_list); $iCount++) {


            echo "
                <img src='/public/img/team/$pfimage' align='middle'>
                <br/>
                <br/>
                <table class='table table-striped'>
                    <tr>
                        <td>리더</td><td>$leader</td>
                    </tr>
                    <tr>
                        <td>팀원 수</td><td>$NumberOfTeam</td>
                    </tr>
                    <tr>
                        <td>홈그라운드</td><td>$home_ground</td>
                    </tr>
                    <tr>
                        <td>능력</td><td>$ability</td>
                    </tr>
                    <tr>
                        <td>소개</td><td>$produce</td>
                    </tr>
                </table>
                <span id='starT'>$star</span>

            ";
        }

    }

    public function team($team_name)
    {
        echo "$team_name";

        // 받은 team_name로 팀 정보를 구한다.
        $detail_list = $this->Detail_model->find_ownTeam($team_name);


    }

    public function message($message_num)
    {

        // echo "도착";
        // 보낸 사용자 ID로 메세지 정보를 구한다.
        $this -> Detail_model -> update_set($message_num);
        $detail_list = $this -> Detail_model -> find_message($message_num);
        $xx = $detail_list->message_content;
        //var_dump($xx);


            echo "
                    <table class='table table-striped'>
                        <tr>
                            <td>내용</td><td>$xx </td>
                        </tr>
                    </table>
            ";
    }


}