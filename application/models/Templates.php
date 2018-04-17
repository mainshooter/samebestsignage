<?php
/**
 * Created by PhpStorm.
 * User: Jordi
 * Date: 6-2-2018
 * Time: 13:41
 */

class Templates extends CI_Model
{
    /**
     * @return mixed
     */
    public function get_all_entries(){
        $query = $this->db->query('SELECT * FROM mail_templates');
        return $query->result_array();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function get_single_entry($id){
        $query = $this->db->query('SELECT * FROM mail_templates WHERE id = '.$id);
        return $query->row_array();
    }

    /**
     * @param $sub
     * @param $con
     * @return mixed
     */
    public function insert_entry($sub, $con){
        $query = $this->db->query('
          INSERT INTO mail_templates ( subject, content ) 
            VALUES ('.$this->db->escape($sub).',
             '.$this->db->escape($con).')');

        if($query){
            $this->logs->insert_entry("INSERT", "Mail template created", ($this->session->userdata('DX_user_id') != null)? $this->session->userdata('DX_user_id') : $this->input->ip_address());
        }

        return $query;
    }

    /**
     * @param $id
     * @param $sub
     * @param $con
     * @return mixed
     */
    public function update_entry($id, $sub, $con){
        $query = $this->db->query('
          UPDATE 
           mail_templates 
          SET 
           subject = '.$this->db->escape($sub).',
           content = '.$this->db->escape($con).'
          WHERE id = '.$id);

        if($query){
            $this->logs->insert_entry("UPDATE", "Mail template no.".$id." updated", ($this->session->userdata('DX_user_id') != null)? $this->session->userdata('DX_user_id') : $this->input->ip_address());
        }

        return $query;
    }
}