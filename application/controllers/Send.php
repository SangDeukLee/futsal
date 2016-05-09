<?php

session_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Send extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('Send_model');
    }

    public function index()
    {

    }

    public function submit(){

        $receive_name = isset($_REQUEST['name']) ? $_REQUEST['name'] : null;
        $sender_name = $_SESSION['loginID'];
        $message = isset($_REQUEST['message']) ? $_REQUEST['message'] : null;

        //echo "$receive_name/$sender_name/$message";
        $xx = $this->Send_model->insert_message($receive_name, $sender_name, $message);

        $return = $this->Send_model->select_noread_message($receive_name);
        $current_message_much = $return -> aa;
        $note_receive = $return->user_receive;

        //var_dump($return -> aa);
        //echo $return['aa'];
        //$current_message_much['current_much'] = $return -> aa;
        $arr['message'] = $return -> aa;
        $arr['receive'] = $return -> user_receive;
        /*$arr['im'] = $return -> user_receive;*/
        $arr['message_content'] = $return -> message_content;
        $arr['send_date'] = $return -> send_date;
        $arr['read_status'] = $return -> read_status;
        echo json_encode($arr);
    }


}