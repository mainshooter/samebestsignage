<?php
/**
 * Created by PhpStorm.
 * User: Jordi
 * Date: 1-2-2018
 * Time: 11:55
 */

class Mailtemplates
{
    private $template;

    private $subject;
    private $customSubject;

    public function __construct(){
        $this->ci =& get_instance();
        $this->ci->load->database();

        log_message('debug', 'Templates Initialized');
    }

    public function setTemplate( $id ){
        $query = $this->ci->db->query('SELECT * FROM mail_templates WHERE id = '. $id);
        $data = $query->row_array();
        $this->template = $data['content'];
        $this->subject = $data['subject'];
    }

    public function writeData($array = array()){
        foreach ($array as $mailVariable => $value){
            $this->template = str_replace($mailVariable, $value, $this->template);
        }
    }

    public function setCustomSubject($var){ $this->customSubject = $var; }

    public function subject(){ return (!empty($this->customSubject))? $this->customSubject : $this->subject; }
    public function getData(){ return $this->template; }
}