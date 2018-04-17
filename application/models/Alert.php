<?php
/**
 * Created by PhpStorm.
 * User: Jordi
 * Date: 13-2-2018
 * Time: 11:21
 */

class Alert extends CI_Model
{
    /**
     * @return mixed
     */
    public function get_all_entries(){
        $query = $this->db->query('SELECT * FROM alerts ORDER BY alert_id DESC');
        return $query->result_array();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function get_all_entries_user($id){
        $query = $this->db->query('SELECT * FROM alerts WHERE user_id = '.$this->db->escape($id).' AND alert_seen = 0 ORDER BY alert_id DESC');
        return $query->result_array();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function get_entry($id){
        $query = $this->db->query('SELECT * FROM alerts WHERE alert_id = '.$this->db->escape($id).' ');
        return $query->row_array();
    }

    /**
     * @param $use
     * @param $tit
     * @param $des
     * @param $ico
     * @param $hre
     * @return mixed
     */
    public function insert_entry($use, $tit, $des, $ico, $hre){
        $query = $this->db->query('
          INSERT INTO 
            alerts (user_id, alert_title, alert_desc, alert_icon, alert_href)
          VALUES (
          '.$this->db->escape($use).',
           '.$this->db->escape($tit).',
            '.$this->db->escape($des).',
            '.$this->db->escape($ico).',
            '.$this->db->escape($hre).')
           ');
        return $query;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function update_entry($id){
        $query = $this->db->query('
          UPDATE alerts
           SET 
            alert_seen = 1
           WHERE alert_id = '.$this->db->escape($id));
        return $query;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function set_read($id){
        $query = $this->db->query('
          UPDATE alerts
           SET 
            alert_seen = 1
           WHERE alert_id = '.$this->db->escape($id));
        return $query;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function set_read_all($id){
        $query = $this->db->query('
          UPDATE alerts
           SET 
            alert_seen = 1
           WHERE alert_seen = 0 AND user_id = '.$this->db->escape($id));
        return $query;
    }
}