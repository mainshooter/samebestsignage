<?php
/**
 * Created by PhpStorm.
 * User: Jordi
 * Date: 16-2-2018
 * Time: 12:44
 */

class Image extends CI_Model
{
    public function get_all_entries(){
        $query = $this->db->query('SELECT * FROM images ');
        $data = $query->result_array();
        foreach ($data as $key => $item){
            $data[$key]['img_path'] = base_url().$item['img_path'];
        }
        return $data;
    }

    public function get_single_entry($id){
        $query = $this->db->query('SELECT * FROM images WHERE img_id = '.$this->db->escape($id));
        $data = $query->row_array();
        $data['img_path'] = base_url().$data['img_path'];

        return $data;
    }

    public function get_group_entries($id){
        $query = $this->db->query('
          SELECT 
           * 
          FROM 
           images
          WHERE 
           img_con = '.$this->db->escape($id));
        $data = $query->result_array();
        foreach ($data as $key => $item){
            $data[$key]['img_path'] = base_url().$item['img_path'];
        }
        return $data;
    }

    public function insert_entry($gro, $nam, $thu, $pat, $siz){
        $query = $this->db->query('
          INSERT INTO 
           images (
            img_con,
            img_name, 
            img_thumb, 
            img_path, 
            img_size
           )
          VALUES (
           '.$this->db->escape($gro).',
           '.$this->db->escape($nam).',
           '.$this->db->escape($thu).',
           '.$this->db->escape($pat).',
           '.$this->db->escape($siz).'
          )
        ');

        if($query){
            $this->logs->insert_entry("INSERT", "Image uploaded", ($this->session->userdata('DX_user_id') != null)? $this->session->userdata('DX_user_id') : $this->input->ip_address());
        }

        return $query;
    }

    public function update_entry($id, $nam, $pat, $siz){
        $query = $this->db->query('
          UPDATE 
           images
          SET 
           img_name = '.$this->db->escape($nam).',
           img_path = '.$this->db->escape($pat).',
           img_size = '.$this->db->escape($siz).'
          WHERE 
           img_id = '.$this->db->escape($id));
        if($query){
            $this->logs->insert_entry("UPDATE", "Image no.".$id." updated", ($this->session->userdata('DX_user_id') != null)? $this->session->userdata('DX_user_id') : $this->input->ip_address());
        }
        return $query;
    }

    public function generate_new_group(){
        $query = $this->db->query('
          INSERT INTO 
           image_connections ( con_array )
          VALUES ( "[]" )
        ');

        if($query){
            $this->logs->insert_entry("INSERT", "Group created", ($this->session->userdata('DX_user_id') != null)? $this->session->userdata('DX_user_id') : $this->input->ip_address());
        }
        return $this->db->insert_id();;
    }
}