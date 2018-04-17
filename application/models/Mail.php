<?php
/**
 * Created by PhpStorm.
 * User: Jordi
 * Date: 6-2-2018
 * Time: 13:41
 */

class Mail extends CI_Model
{
    /**
     * @return mixed
     */
    public function get_all_entries(){
        $query = $this->db->query('SELECT * FROM mail_config WHERE id = 1');
        return $query->row_array();
    }

    /**
     * @return mixed
     */
    public function get_default_entry(){
        $query = $this->db->query('SELECT * FROM mail_config WHERE id = 0');
        return $query->row_array();
    }

    /**
     * @param $id
     * @param $protocol
     * @param $smtp_host
     * @param $smtp_user
     * @param $smtp_pass
     * @param $smtp_port
     * @param $smtp_timeout
     * @param $smtp_crypto
     * @param $mailtype
     * @param $newline
     * @param $crlf
     * @param $charset
     * @param $validate
     * @param $priority
     * @return mixed
     */
    public function update_entry(
        $id,
        $protocol,
        $smtp_host,
        $smtp_user,
        $smtp_pass,
        $smtp_port,
        $smtp_timeout,
        $smtp_crypto,
        $mailtype,
        $newline,
        $crlf,
        $charset,
        $validate,
        $priority
    ){
        if($query = $this->db->query('
          UPDATE 
           mail_config 
          SET 
           protocol = ' . $this->db->escape($protocol) . ',
           smtp_host = ' . $this->db->escape($smtp_host) . ',
           smtp_user = ' . $this->db->escape($smtp_user) . ',
           smtp_pass = ' . $this->db->escape($smtp_pass) . ',
           smtp_port = ' . $this->db->escape($smtp_port) . ',
           smtp_timeout = ' . $this->db->escape($smtp_timeout) . ',
           smtp_crypto = ' . $this->db->escape($smtp_crypto) . ',
           mailtype = ' . $this->db->escape($mailtype) . ',
           newline = ' . $this->db->escape($newline) . ',
           crlf = ' . $this->db->escape($crlf) . ',
           charset = ' . $this->db->escape($charset) . ',
           validate = ' . $this->db->escape($validate) . ',
           priority = ' . $this->db->escape($priority) . '
          WHERE 
           id = '. $id
        )){
            $this->logs->insert_entry("UPDATE", "Mail config updated", ($this->session->userdata('DX_user_id') != null)? $this->session->userdata('DX_user_id') : $this->input->ip_address());
        }

        return $query;
    }

    /**
     * @param $key
     * @param $item
     * @return mixed
     */
    public function reset_entry($key, $item){
        $query = $this->db->query('UPDATE mail_config SET ' . $key . ' = ' . $this->db->escape($item) . ' WHERE id = 1');

        if($query){
            $this->logs->insert_entry("UPDATE", "Mail config(".$key.") updated", ($this->session->userdata('DX_user_id') != null)? $this->session->userdata('DX_user_id') : $this->input->ip_address());
        }

        return $query;
    }
}