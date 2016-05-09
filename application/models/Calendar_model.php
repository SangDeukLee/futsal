<?php

class Calendar_model extends CI_Model
{

    function __construct() {
        parent::__construct();
    }

    function schedule($id) {
        $sql = "
                    SELECT  match_address, match_date, match_starttime, match_endtime
                    FROM    match_board
                    WHERE   match_num IN (
                                          SELECT  match_num
                                          FROM    match_request
                                          WHERE   matchr_user = '$id'
                                          AND     matchr_status = 1
                                      )
                    OR       match_writer = '$id'
                    AND      match_status = 1
                    ORDER BY match_date asc, match_starttime desc;
        ";
        $query = $this->db->query($sql);

        $arr = $query->result();
        /*var_dump($arr);*/
        //$result = 0;
        for($iCount = 0 ; $iCount < count($arr) ; $iCount++) {


            $result[$iCount]['title'] = $arr[$iCount] -> match_address;
            $result[$iCount]['spt_date'] = $arr[$iCount] -> match_date;
            $result[$iCount]['spt_starttime'] = $arr[$iCount] -> match_starttime;
            $result[$iCount]['spt_endtime'] = $arr[$iCount] -> match_endtime;
            $result[$iCount]['start'] = $result[$iCount]['spt_date']." ". $result[$iCount]['spt_starttime'];
            $result[$iCount]['end'] = $result[$iCount]['spt_date']." ". $result[$iCount]['spt_endtime'];

            unset($result[$iCount]['spt_date']);
            unset($result[$iCount]['spt_starttime']);
            unset($result[$iCount]['spt_endtime']);
        }


        return $result;
    }



}