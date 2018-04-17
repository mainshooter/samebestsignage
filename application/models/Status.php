<?php
/**
 * Created by PhpStorm.
 * User: Jordi
 * Date: 6-2-2018
 * Time: 13:17
 */

class Status extends CI_Model
{
    /**
     * @return mixed
     */
    public function get_all_entries(){
        $query = $this->db->query('SELECT * FROM status_types ');
        return $query->result_array();
    }

    /**
     * @return mixed
     */
    public function get_all_entries_active(){
        $query = $this->db->query('SELECT * FROM status_types WHERE status_active = 1');
        return $query->result_array();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function get_single_entry($id){
        $query = $this->db->query('SELECT * FROM status_types WHERE status_id = '.$this->db->escape($id));
        return $query->row_array();
    }

    /**
     * @return array
     */
    public function get_enum(){
        $type = $this->db->query( "SHOW COLUMNS FROM status_types WHERE Field = 'status_level'" )->row( 0 )->Type;
        preg_match("/^enum\(\'(.*)\'\)$/", $type, $matches);
        $enum = explode("','", $matches[1]);
        return $enum;
    }

    /**
     * @param $nam
     * @param $lvl
     * @param $inf
     * @return mixed
     */
    public function insert_entry($nam, $lvl, $inf){
        $query = $this->db->query('
          INSERT INTO status_types (status_name, status_level, status_info)
          VALUES (
          '.$this->db->escape($nam).',
           '.$this->db->escape($lvl).',
            '.$this->db->escape($inf).')
           ');

        if($query){
            $this->logs->insert_entry("INSERT", "Status created", ($this->session->userdata('DX_user_id') != null)? $this->session->userdata('DX_user_id') : $this->input->ip_address());
        }

        return $query;
    }

    /**
     * @param $id
     * @param $nam
     * @param $lvl
     * @param $inf
     * @return mixed
     */
    public function update_entry($id, $nam, $lvl, $inf){
        $query = $this->db->query('UPDATE status_types
            SET 
             status_name = '.$this->db->escape($nam).',
             status_info = '.$this->db->escape($inf).',
             status_level = '.$this->db->escape($lvl).'
            WHERE 
             status_id = '.$this->db->escape($id));

        if($query){
            $this->logs->insert_entry("UPDATE", "Status no.".$id." updated", ($this->session->userdata('DX_user_id') != null)? $this->session->userdata('DX_user_id') : $this->input->ip_address());
        }

        return $query;
    }

    /**
     * @param $id
     * @return bool|string
     */
    public function toggle_status($id){
        $stat = $this->get_single_entry($id);

        $bool = $stat['status_active'];

        switch ($bool) {
            case 0:
                $bool = 1;
                $msg = 'on';
                break;
            case 1:
                $bool = 0;
                $msg = 'off';
                break;
        }

        $query = $this->db->query('UPDATE status_types
            SET 
             status_active = '.$bool.'
            WHERE status_id = '.$this->db->escape($id));

        if($query){
            $this->logs->insert_entry("UPDATE", "Status no.".$id." is turned ". $msg, ($this->session->userdata('DX_user_id') != null)? $this->session->userdata('DX_user_id') : $this->input->ip_address());
            return $msg;
        } else{
            return false;
        }
    }
}