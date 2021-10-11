<?php
Class Register extends CI_Controller{
    
    function __construct() {
        parent::__construct();
        $this->load->model('model_register');
    }
    
    function index(){
        if(isset($_POST['submit'])){
                $data = array('id_user'=> '',
                    'username'=> $this->input->post('username'), 
                    'nama'=> $this->input->post('nama'),
                    'password'=> md5($this->input->post('password')),
                    'email'=> $this->input->post('email'),
                    'no_telp'=> $this->input->post('telp'),
                    'jabatan'=> 'user'
                );
                $this->model_register->save($data);
                redirect('login');
            } else {
                redirect('login');
            }
    }
   
}