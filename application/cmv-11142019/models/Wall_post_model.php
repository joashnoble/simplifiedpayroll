<?php

class Wall_post_model extends CORE_Model {
    protected  $table="wall_post";
    protected  $pk_id="wall_post_id";

    function __construct() {
        parent::__construct();
    }

    function xTimeAgo ($oldTime, $newTime) {
    $timeCalc = strtotime($newTime) - strtotime($oldTime);
    if ($timeCalc > (60*60*24*30)) {$timeCalc = round($timeCalc/60/60/24/30) . " month ago";}
    else if ($timeCalc > (60*60*24)) {$timeCalc = round($timeCalc/60/60/24) . " days ago";}
    else if ($timeCalc > (60*60)) {$timeCalc = round($timeCalc/60/60) . " hours ago";}
    else if ($timeCalc > 60) {$timeCalc = round($timeCalc/60) . " minutes ago";}
    else if ($timeCalc > 0) {$timeCalc .= " seconds ago";}
    return $timeCalc;
    }

    function wall_post($chatamount,$company_id) {
        $date = date("Y-m-d H:i:s");
        $query = $this->db->query('SELECT wpost.*,CONCAT(user_accounts.user_fname," ",user_accounts.user_mname," ",user_lname) as full_name,user_accounts.photo_path,
        wpost.date_created as readable FROM (SELECT * FROM wall_post WHERE company_id = '.$company_id.' ORDER BY wall_post_id DESC LIMIT '.$chatamount.')  as wpost
        LEFT JOIN user_accounts ON
        user_accounts.user_id=wpost.user_id
        WHERE user_accounts.company_id = '.$company_id.'
        ORDER BY wpost.date_created ASC');

        $queresult=$query->result();
        $array_post = array();
        $i = 0;
        foreach($queresult as $row){
           $array_post[$i]["user_id"]= $row->user_id;
           $array_post[$i]["full_name"]= $row->full_name;
           $array_post[$i]["photo_path"]= $row->photo_path;
           $array_post[$i]["post_content"]= $row->post_content;
           $array_post[$i]["readable"]= $this->xTimeAgo($row->readable,$date);
           $i++;
        }

        return $array_post;
    }

    function get_wallpost_list($company_id){
        $query = $this->db->query("SELECT COUNT(*) as count FROM wall_post WHERE company_id = $company_id");
        $query->result();
        return $query->result();
    }

    function get_wall_post($company_id){
        $query = $this->db->query("SELECT wall_post.*,
                    CONCAT(user_accounts.user_fname,' ',user_accounts.user_mname,' ',user_accounts.user_lname) as full_name,
                    user_accounts.photo_path,
                    DATE_FORMAT(wall_post.date_created, '%M %D, %Y %H:%i:%s') as `readable`
                    FROM wall_post
                    LEFT JOIN user_accounts ON user_accounts.user_id=wall_post.user_id
                    WHERE 
                        wall_post.company_id = $company_id
                        AND user_accounts.company_id = $company_id
                    ORDER BY wall_post_id desc
                    LIMIT 20
                    ");
        $query->result();
        return $query->result();
    }
}
?>
