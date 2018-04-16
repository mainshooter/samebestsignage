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
        $this->load->model('user');
        $this->load->model('mail');
    }

    function login()
    {
        $master = $this->user->get_single_entry_id(1);
        if ($master == null || !is_array($master)){
            $this->user->insert_super_admin();
        }

        if (! $this->session->userdata('DX_logged_in')) {
            if (!empty($_POST['email']) && !empty($_POST['password'])) {

                if($row = $this->user->get_single_entry_by_email_active($_POST['email'])) {
                    $password = $this->_encode($_POST['password']);
                    $stored_hash = $row['password'];

                    // Is password matched with hash in database
                    if (crypt($password, $stored_hash) === $stored_hash) {
                        // Log in user
                        $this->_set_session($row);

                        // Set last ip and last login
                        $this->user->_set_last_ip_and_last_login($row['id']);

                        // Set return value
                        echo json_encode(
                            array(
                                "error" => false,
                                "msg" => "Success",
                                "href" => "/home"
                            )
                        );
                    } else {
                        echo json_encode(
                            array(
                                "error" => true,
                                "msg" => "Password incorrect",
                                "href" => "unset"
                            )
                        );
                    }
                } else{
                    echo json_encode(
                        array(
                            "error" => true,
                            "msg" => "User does not exist",
                            "href" => "unset"
                        )
                    );
                }
            } else{
                echo json_encode(
                    array(
                        "error" => true,
                        "msg" => "Form not filled out properly",
                        "href" => "unset"
                    )
                );
            }
        } else{
            echo json_encode(
                array(
                    "error" => false,
                    "msg" => "Already logged in",
                    "href" => "/home"
                )
            );
        }
    }

    public function logout(){
        $this->session->sess_destroy();
        redirect('/login');
    }

    private function _encode($password)
    {
        $majorsalt = 'UITY&O*7d8u09pasolkJGDT))polkhjg879SOI';

        // if PHP5
        if (function_exists('str_split'))
        {
            $_pass = str_split($password);
        } /*if PHP4*/
        else {
            $_pass = array();
            if (is_string($password))
            {
                for ($i = 0; $i < strlen($password); $i++)
                {
                    array_push($_pass, $password[$i]);
                }
            }
        }

        // encrypts every single letter of the password
        foreach ($_pass as $_hashpass)
        {
            $majorsalt .= md5($_hashpass);
        }

        // encrypts the string combinations of every single encrypted letter
        // and finally returns the encrypted password
        return md5($majorsalt);
    }

    function _set_session($data)
    {
        // Set session data array
        $user = array(
            'DX_user_id'						=> $data['id'],
            'DX_username'						=> $data['username'],
            'DX_email'						=> $data['email'],
            'DX_role_id'						=> $data['role_id'],
            'DX_role_name'					=> $data['role_name'],
            'DX_logged_in'					=> TRUE
        );

        $this->session->set_userdata($user);
    }

    public function forgotPassword(){
        if (! $this->user->forgot_password($_POST['email'], $hash = $this->hash($_POST['email']))){
            echo $hash;
        } else{
            $this->load->library('email');
            $this->load->library('MailTemplates');


            $insertId = $this->db->insert_id();
            $config = array();

            //all config items
            foreach ($this->mail->get_all_entries() as $key => $item){
                $config[$key] = $item;
            }
            $this->email->initialize($config);

            $values = array(
                '({[!TITLE!]})' => 'Password Reset',
                '({[!HASH!]})' => $hash,
                '({[!PROBLEM!]})' => "Here is the link to change you password",
                '({[!CATEGORY!]})' => 'Change Password',
                '({[!BASEURL!]})' => base_url(),
            );

            $this->mailtemplates->setTemplate(2);
            $this->mailtemplates->setCustomSubject("Password Reset");
            $this->mailtemplates->writeData($values);


            $this->email->from('info@idsignage.nl', 'IdSignage');
            $this->email->to($_POST['email']);
            $this->email->subject($this->mailtemplates->subject());
            $this->email->message($this->mailtemplates->getData());

            if ($this->email->send()){
                echo json_encode(
                    array(
                        "error" => false,
                        "msg" => "Success",
                        "href" => "/home"
                    )
                );
            } else{
                echo json_encode(
                    array(
                        "error" => true,
                        "msg" => "<pre>".$this->email->print_debugger()."</pre>",
                        "href" => "unset"
                    )
                );
            }
        }
    }

    function hash($data){
        $majorsalt = '';

        // if PHP5
        if (function_exists('str_split'))
        {
            $_data = str_split($data);
        }

        foreach ($_data as $_hashdata)
        {
            $majorsalt .= crypt(
                crypt(
                    md5($_hashdata.random_int(1, 100)),
                    $data
                ),
                crypt(
                    md5(
                        json_encode($_data)
                    ),
                    date('Y/F\W-l H:i:s e+c')
                )
            );
        }

        //just some fun
        $majorsalt .= sha1(
            md5($majorsalt.random_int(8946, 89465)),
            false
            );

        return str_replace('/', random_int(10, 55), $majorsalt);
    }

    public function resetPassword($id){
        if ($_POST['password'] == $_POST['confirm_password']){
            $pass = crypt($this->_encode($_POST['password']), '');
            if ($this->user->update_password($id, $pass)){
                if($this->user->remove_salt($id)){
                    echo json_encode(
                        array(
                            "error" => false,
                            "msg" => "Success",
                            "href" => "/login"
                        )
                    );
                } else{
                    echo json_encode(
                        array(
                            "error" => true,
                            "msg" => "Sorry at this moment it is not possible to reset your password. /n Please come back later to try again.",
                            "href" => "Unset"
                        )
                    );
                }
            } else{
                echo json_encode(
                    array(
                        "error" => true,
                        "msg" => "Sorry at this moment it is not possible to reset your password. /n Please come back later to try again.",
                        "href" => "Unset"
                    )
                );
            }
        } else{
            redirect();
        }
    }

}