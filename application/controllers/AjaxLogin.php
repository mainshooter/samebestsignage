<?php
/**
 * Created by PhpStorm.
 * User: Jordi
 * Date: 26-1-2018
 * Time: 14:10
 */

class AjaxLogin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('main_helper');
        $this->load->database();
    }

    public function login(){
        if ($this->dx_auth->login(html_entity_decode($_POST['username']), $_POST['password'], false)){
            echo check('check-success', 'check', '/home');
        } else{
            echo alert('danger', '', 'Password or username is incorrect');
        }
    }
}