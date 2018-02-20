<?php
/**
 * Created by PhpStorm.
 * User: Jordi
 * Date: 8-2-2018
 * Time: 16:45
 */

class Main extends CI_Controller
{
    public function __construct(){
        parent::__construct();
    }

    public function login(){
        redirect('/home');
    }
}