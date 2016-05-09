<?php

session_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends CI_Controller
{

    function __construct(){

        parent::__construct();
        $this->load->database();
        $this->load->model('Member_model');
    }

    public function joinV()
    {

        $this->load->view('./member/joinV');
    }

    public function logout()
    {
        unset($_SESSION['loginID']);
        header('Location: ../../');
    }

    public function join() //필요하면모델을불러서처리하고 필요한뷰를 불러서처리를해주는형태!
    {

        if (isset($_POST["submit_join"])) {
            if($_POST['home']){
                $home = implode("-", $_POST['home']);
            }

            $memberImgSavePath = "./public/img/member/";
            $thumbnailImgSavePath = "./public/img/member_s/";
            $fileMaxSize = 2000000;


            $this -> Member_model->insertMember($_POST, $home);

            $upImgFileInfo['name'] = isset($_FILES['pfimage']['name'])?$_FILES['pfimage']['name']:null;
            $upImgFileInfo['tmp_name'] = isset($_FILES['pfimage']['tmp_name'])?$_FILES['pfimage']['tmp_name']:null; //임시저장소
            $upImgFileInfo['type'] = isset($_FILES['pfimage']['type'])?$_FILES['pfimage']['type']:null;
            $upImgFileInfo['size'] = isset($_FILES['pfimage']['size'])?$_FILES['pfimage']['size']:null;
            $upImgFileInfo['error'] = isset($_FILES['pfimage']['error'])?$_FILES['pfimage']['error']:null;
            //$_FILES는 최근에 클라이언트에서 서버로 업로드한 파일의 정보를 받는 환경변수이다.


            if( $upImgFileInfo['name'] && $upImgFileInfo['error'] == 0){ //값을 잘 받았고 에러가 없으면

                $imgFileType = pathinfo($upImgFileInfo['name'],PATHINFO_EXTENSION); //확장자 추출

                $saveFileName = $_POST['id']; //id로 파일이름을생성!
                $saveFileNameWithExt = $saveFileName.".".strval($imgFileType); // C12.jpg같은 완전한 파일이름 생성!
                $thumbnailFileNameWithExt = $saveFileName."_S".".".strval($imgFileType); //썸네일 파일이름 생성!

                $retArr2 = $this->singleFileUpload($upImgFileInfo, $memberImgSavePath, $saveFileNameWithExt, $fileMaxSize);

                //$reArr2 업로드한 메세값을 담고있다.
                if( $retArr2['uploadOk'] ){ //큰그림파일 올리는것 이상이없으면.
                    $_POST['pfimage'] = $saveFileNameWithExt; //Cds12.jpg같은 파일이름을 저장한다.

                    if( $imgFileType == "jpg" || $imgFileType == "jpeg" || $imgFileType == "png" || $imgFileType == "gif"){
                        $src = $memberImgSavePath.strval($saveFileNameWithExt); //이미지저장경로와 파일이름을 붙여 변수에 저장.
                        $dest = $thumbnailImgSavePath.strval($thumbnailFileNameWithExt); //썸네일이미지경로와 썸네일 파일이름을 붙여 변수에 저장.
                        $this -> makeThumbnailImage($src, $dest, $imgFileType); //썸네일이미지 생성.
                        $this -> makeSingleImage($src, $imgFileType); //싱글이미지생성
                        $_POST['psimage'] = $thumbnailFileNameWithExt;// Cds12_s.jpg같은 파일이름 저장.

                    }
                }
            }
            $this -> Member_model->updateMember($_POST); //저장한 이름을 업데이트!
        }
        $this->load->view('./home/index');
    }


    public function loginCheck()
    {

        if (isset($_POST["submit_login"])) {

            $returnArr = $this->Member_model->loginCheck($_POST["id"], $_POST["pass"]);
        }

        if($returnArr['alertCode'] == 1) { //로그인 성공했을 때
            $_SESSION['loginID'] = $returnArr['loginID'];
            header('Location: ../../../Mypage');
        }
        else {
            $this->load->view('./home/index', array(alertCode => $returnArr['alertCode']));
        }

        /*$this->load->view('head');
        $topics = $this->topic_model->gets();
        $this->load->view('topic_list', array('topics'=>$topics));
        $this->load->view('main');
        $this->load->view('footer');*/
    }

    public function findIdV(){


        $this->load->view('./member/findidv');

    }
    public function findPwV(){


        $this->load->view('./member/findpwv');

    }
    public function findId(){
        if(isset($_POST["submit_find_id"])) {


            $member_id = $this -> Member_model->findId($_POST["email"], $_POST["phone"]);
            // require 'application/views/member/findid.php';
            $this->load->view('./member/findid', $member_id);
        }
    }
    public function findPw()
    {
        if (isset($_POST["submit_find_pw"])) {

            $member_pw = $this -> Member_model->findPw($_POST["id"],$_POST["email"],$_POST["phone"]);
            // require 'application/views/member/findpw.php';
            $this->load->view('./member/findpw');

        }
    }

    public function modifyv()
    {
        $user_id = isset($_SESSION['loginID']) ? $_SESSION['loginID'] : null;

        $member['member_info'] = $this -> Member_model->selectMember($user_id);
        $member['user_home']=explode("-",$member['member_info']->user_home);

        $this->load->view('./_templates/header.php', $this -> data);
        $this->load->view('./_templates/Laside.php', $this -> data);
        $this->load->view('member/modifyv.php', $member);
        $this->load->view('./_templates/Raside.php', $this -> data);
        $this->load->view('./_templates/footer.php', $this -> data);
    }
    public function modify()
    {
        $user_id = isset($_SESSION['loginID']) ? $_SESSION['loginID'] : null;
        $user_home = isset($_REQUEST['user_home'])?$_REQUEST['user_home']:null;

        if(isset($_POST["submit_modify"])) {
            if ($_POST['home'][0]) {
                $_POST['home'] = implode("-", $_POST['home']);
            }else{
                $_POST['home'] = implode("-", $user_home);
            }

            $memberImgSavePath = "./public/img/member/";
            $thumbnailImgSavePath = "./public/img/member_s/";
            $fileMaxSize = 2000000;


            $this -> Member_model->modifyMember($_POST,$user_id);

            if(isset($_FILES['pfimage'])) {
                $upImgFileInfo['name'] = isset($_FILES['pfimage']['name'])?$_FILES['pfimage']['name']:null;
                $upImgFileInfo['tmp_name'] = isset($_FILES['pfimage']['tmp_name'])?$_FILES['pfimage']['tmp_name']:null; //임시저장소
                $upImgFileInfo['type'] = isset($_FILES['pfimage']['type'])?$_FILES['pfimage']['type']:null;
                $upImgFileInfo['size'] = isset($_FILES['pfimage']['size'])?$_FILES['pfimage']['size']:null;
                $upImgFileInfo['error'] = isset($_FILES['pfimage']['error'])?$_FILES['pfimage']['error']:null;
                //$_FILES는 최근에 클라이언트에서 서버로 업로드한 파일의 정보를 받는 환경변수이다.

                if( $upImgFileInfo['name'] && $upImgFileInfo['error'] == 0){ //값을 잘 받았고 에러가 없으면

                    $imgFileType = pathinfo($upImgFileInfo['name'],PATHINFO_EXTENSION); //확장자 추출

                    $saveFileName = $user_id; //id로 파일이름을생성!
                    $saveFileNameWithExt = $saveFileName.".".strval($imgFileType); // C12.jpg같은 완전한 파일이름 생성!
                    $thumbnailFileNameWithExt = $saveFileName."_S".".".strval($imgFileType); //썸네일 파일이름 생성!

                    unlink("$memberImgSavePath/$saveFileNameWithExt");
                    unlink("$thumbnailImgSavePath/$thumbnailFileNameWithExt");

                    $retArr2 = $this->singleFileUpload($upImgFileInfo, $memberImgSavePath, $saveFileNameWithExt, $fileMaxSize);

                    //$reArr2 업로드한 메세값을 담고있다.
                    if( $retArr2['uploadOk'] ){ //큰그림파일 올리는것 이상이없으면.
                        $pic['pfimage'] = $saveFileNameWithExt; //Cds12.jpg같은 파일이름을 저장한다.

                        if( $imgFileType == "jpg" || $imgFileType == "jpeg" || $imgFileType == "png" || $imgFileType == "gif"){
                            $src = $memberImgSavePath.strval($saveFileNameWithExt); //이미지저장경로와 파일이름을 붙여 변수에 저장.
                            $dest = $thumbnailImgSavePath.strval($thumbnailFileNameWithExt); //썸네일이미지경로와 썸네일 파일이름을 붙여 변수에 저장.
                            $this -> makeThumbnailImage($src, $dest, $imgFileType); //썸네일이미지 생성.
                            $this -> makeSingleImage($src, $imgFileType); //싱글이미지생성
                            $pic['psimage'] = $thumbnailFileNameWithExt;// Cds12_s.jpg같은 파일이름 저장.


                            $this -> Member_model->updateMember($pic); //저장한 이름을 업데이트!
                        }
                    }
                }
            }
        }
        $this->load->view('./home/index');
    }
}