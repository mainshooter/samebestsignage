<?php
/**
 * Created by PhpStorm.
 * User: Jordi
 * Date: 6-2-2018
 * Time: 14:36
 */

class Logins extends CI_Model
{
    public function get_all_entries(){
        $query = $this->db->query('SELECT * FROM logins');
        return $query->result_array();
    }
}