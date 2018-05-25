<?php
/**
 * Created by PhpStorm.
 * User: Jordi
 * Date: 1-2-2018
 * Time: 11:55
 */

class Mailtemplates
{
    /**
     * @var
     *
     */
    private $template;

    /**
     * @var
     */
    private $subject;
    /**
     * @var
     */
    private $customSubject;

    /**
     * Mailtemplates constructor.
     */
    public function __construct(){
        $this->ci =& get_instance();
        $this->ci->load->database();

        log_message('debug', 'Templates Initialized');
    }

    /**
     * @param $id
     */
    public function setTemplate($id ){
        $query = $this->ci->db->query('SELECT * FROM mail_templates WHERE id = '. $id);
        $data = $query->row_array();
        $this->template = $data['content'];
        $this->subject = $data['subject'];
    }

    /**
     * @param array $array
     */
    public function writeData($array = array()){
        foreach ($array as $mailVariable => $value){
            $this->template = str_replace($mailVariable, $value, $this->template);
        }
    }

    /**
     * @param $var
     */
    public function setCustomSubject($var){ $this->customSubject = $var; }

    /**
     * @return mixed
     */
    public function subject(){ return (!empty($this->customSubject))? $this->customSubject : $this->subject; }

    /**
     * @return mixed
     */
    public function getData(){ return $this->template; }
}
