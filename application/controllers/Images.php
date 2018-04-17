<?php
/**
 * Created by PhpStorm.
 * User: Jordi
 * Date: 20-2-2018
 * Time: 10:36
 */

class Images extends CI_Controller{

    /**
     * Images constructor.
     */
    public function __construct(){
        parent::__construct();


        $this->load->database();

        $this->load->model('ticket');
        $this->load->model('clients');
        $this->load->model('user');
        $this->load->model('category');
        $this->load->model('status');
        $this->load->model('importance');
        $this->load->model('alert');

        $this->data['clients'] = $this->clients->get_all_entries();
        $this->data['users'] = $this->user->get_all_entries();
        $this->data['categorys'] = $this->category->get_all_entries();
        $this->data['statuses'] = $this->status->get_all_entries();
        $this->data['importances'] = $this->importance->get_all_entries();
        $this->data['alerts'] = $this->alert->get_all_entries_user($this->session->userdata('DX_user_id'));
    }

    /**
     * @param $hash
     */
    public function add($hash){
        $data['ticket'] = $this->ticket->get_entry_by_hash($hash);
        if(!empty($data['ticket'])){
            $data['statuses'] = $this->status->get_all_entries();
            $data['images'] = $this->image->get_group_entries($data['ticket']['ticket_images']);

            $data['title'] = 'Ticket: ' . $data['ticket']['ticket_id'];

            $this->load->view('templates/header', $data);
            $this->load->view('image/add.php', $data);
            $this->load->view('templates/footer', $data);
        } else{
            redirect('/home');
        }
    }

    /**
     * @param $group
     * @param $id
     */
    public function insert($group, $id)
    {
        $ticket = $this->ticket->get_single_entry($id);

        $config = array(
            'upload_path'      => 'public/img/uploads/',
            'allowed_types'    => 'gif|jpg|png',
            'file_ext_tolower' => TRUE,
            'max_size'         => 6144,
            'max_width'        => 0,
            'max_height'       => 0,
            'max_filename'     => 1000,
        );

        $this->load->library('upload');
        $this->load->library('image_lib');
        $this->upload->initialize($config);

        $upload = true;

        $files_uploaded = array();
        $number_of_files_uploaded = count($_FILES['image']['name']);
        for ($i = 0; $i < $number_of_files_uploaded; $i++) {
            $_FILES['userfile']['name'] = $_FILES['image']['name'][$i];
            $_FILES['userfile']['type'] = $_FILES['image']['type'][$i];
            $_FILES['userfile']['tmp_name'] = $_FILES['image']['tmp_name'][$i];
            $_FILES['userfile']['error'] = $_FILES['image']['error'][$i];
            $_FILES['userfile']['size'] = $_FILES['image']['size'][$i];

            if (!$this->upload->do_upload('userfile')) {
                echo json_encode(
                    array(
                        "error" => true,
                        "msg" => $this->upload->display_errors(),
                        "href" => "unset"
                    )
                );

                $upload = false;
            } else {
                $data = $this->upload->data();

                $config_lib = array(
                    'image_library'  => 'gd2',
                    'source_image'   => $config['upload_path'] . $data['file_name'],
                    'create_thumb'   => TRUE,
                    'thumb_marker'   => '_thumb',
                    'maintain_ratio' => TRUE,
                    'width'          => 200,
                    'height'         => 200
                );

                $this->image_lib->initialize($config_lib);
                $this->image_lib->resize();


                $data['thumb'] = $data['raw_name'].$config_lib['thumb_marker'].$data['file_ext'];
                $data['file_path'] = $config['upload_path'];
                $data['file_path'] = $config['upload_path'];
                $data['full_path'] = $config['upload_path'] . $data['file_name'];
                $files_uploaded[] = $data;
            }
        }

        if ($upload != false) {

            $insert = true;
            foreach ($files_uploaded as $key => $item) {
                if (!$this->image->insert_entry($group, $item['file_name'], $item['thumb'], $item['file_path'], $item['file_size'])) {
                    $insert = false;
                }
            }

            if ($insert !== false) {
                $this->alert->insert_entry($ticket['ticket_master'], 'Add', 'A client added new images to the ticket.', 'add', '/ticket/' . $ticket['ticket_id']);
                echo json_encode(
                    array(
                        "error" => false,
                        "msg" => "Success",
                        "href" => ""
                    )
                );
            } else{
                echo json_encode(
                    array(
                        "error" => true,
                        "msg" => "At this moment is is not possible to upload a image. /n Please come back later to try again.",
                        "href" => "unset"
                    )
                );
            }
        }
    }
}