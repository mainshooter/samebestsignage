<?php
/**
 * Created by PhpStorm.
 * User: Jordi
 * Date: 6-2-2018
 * Time: 13:46
 */

class Roles extends CI_Model
{
    public function get_all_entries(){
        $query = $this->db->query('SELECT * FROM roles');
        return $query->result_array();
    }
}