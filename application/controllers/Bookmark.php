<?php

session_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Bookmark extends CI_Controller
{
    function __construct() {
        parent::__construct();

        $this -> load -> database();
        $this -> load -> model('Bookmark_model');
    }

    // 즐겨찾기 추가 삭제 구분(사람)
    public function index()
    {
        $loginID = isset($_SESSION['loginID']) ? $_SESSION['loginID'] : null;
        $user_id = isset($_REQUEST['user_id']) ? $_REQUEST['user_id'] : null;
        $check = $_REQUEST['check'];



        // 즐겨찾기 삭제
        if($check == "delete") {
            $bookmark_check = $this -> Bookmark_model -> delete_start($user_id, $loginID);
            //echo "$bookmark_check";
        }

        // 즐겨찾기 추가
        elseif($check == "insert"){
            $bookmark_check = $this -> Bookmark_model -> insert_start($user_id, $loginID);
            echo $check;
        }
    }

    public function team_book(){

        $team_name = isset($_REQUEST['team_name']) ? $_REQUEST['team_name'] : null;
        $loginID = isset($_SESSION['loginID']) ? $_SESSION['loginID'] : null;
        $check = $_REQUEST['check'];

        //echo "$check";


        // 즐겨찾기 삭제
        if($check == "delete") {
            $bookmark_check = $this -> Bookmark_model -> team_delete_start($team_name, $loginID);
            //echo "$bookmark_check";
        }

        // 즐겨찾기 추가
        elseif($check == "insert"){
            $bookmark_check = $this -> Bookmark_model -> team_insert_start($team_name, $loginID);
            //echo "$bookmark_check";
        }

    }

}