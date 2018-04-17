<?php
/**
 * Created by PhpStorm.
 * User: Jordi
 * Date: 22-2-2018
 * Time: 12:37
 */

class Logs extends CI_Model
{
    /**
     * @param $id
     * @return mixed
     */
    public function get_entry($id){
        $query = $this->db->query('SELECT * FROM log WHERE log_id = '.$id);
        return $query->row_array();
    }

    /**
     * @return mixed
     */
    public function get_all_entries(){
        $query = $this->db->query('SELECT * FROM log ORDER BY log_id DESC');
        return $query->result_array();
    }

    /**
     * @param $use
     * @return mixed
     */
    public function get_user_entries($use){
        $query = $this->db->query('SELECT * FROM log WHERE log_user = '.$use);
        return $query->result_array();
    }

    /**
     * @param $act
     * @return mixed
     */
    public function get_action_entries($act){
        $query = $this->db->query('SELECT * FROM log WHERE log_action = '.$act);
        return $query->result_array();
    }

    /**
     * @param $act
     * @param $des
     * @param $id
     * @return mixed
     */
    public function insert_entry($act, $des, $id){
        $query = $this->db->query('
          INSERT INTO 
            log (
             log_action, 
             log_desc, 
             log_user
            )
          VALUES (
           '.$this->db->escape($act).',
           '.$this->db->escape($des).',
           '.$this->db->escape($id).'
          )
        ');
        return $query;
    }
}