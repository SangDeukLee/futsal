<?php
session_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Message extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('Message_model');
    }

    public function index()
    {
        $this->get_list();
    }

    public function get_list(){

        $user_id = isset($_SESSION['loginID']) ? $_SESSION['loginID'] : null;

        $this -> data['get_message_list'] = $this -> Message_model -> getMessage($user_id);

        //사진까지 구한다.


        $this->load->view('./_templates/header.php', $this -> data);
        $this->load->view('./_templates/Laside.php', $this -> data);
        $this->load->view('./message/message.php',   $this -> data);
        $this->load->view('./_templates/Raside.php', $this -> data);
        $this->load->view('./_templates/footer.php', $this -> data);
    }

    // ajax
    public function get_list_01(){
        $user_id = isset($_SESSION['loginID']) ? $_SESSION['loginID'] : null;
        $aa = $this -> Message_model -> getMessage_01($user_id);
        echo $aa[0] -> aa;
    }
}