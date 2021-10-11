<?php
Class User extends CI_Controller{
    
    function __construct() {
        parent::__construct();
        $this->load->model('model_user');
    }
    
    function index(){
        if ($this->session->userdata("status")=="login"){
            $this->load->view('user/form_input');
        } else {
            redirect(base_url('index.php/welcome'));
        }
    }
    
    function save(){
        if ($this->session->userdata("status")=="login"){
            if(isset($_POST['submit'])){
                $data = array('id_user'=> '',
                    'username'=> $this->input->post('username'), 
                    'nama'=> $this->input->post('nama'),
                    'password'=> md5($this->input->post('password')),
                    'email'=> $this->input->post('email'),
                    'no_telp'=> $this->input->post('telp'),
                    'jabatan'=> $this->input->post('jabatan')
                );
                $this->model_user->save($data);
                redirect('user');
            }else {
                $this->load->view('user/form_input');
            }
        } else {
            redirect(base_url('index.php/welcome'));
        }
    }
    
    function view(){
        if ($this->session->userdata("status")=="login"){
            $data['record'] = $this->model_user->view();
            $this->load->view('user/view', $data);
        } else {
            redirect(base_url('index.php/welcome'));
        }
    }
    
    function edit(){
        if ($this->session->userdata("status")=="login"){
            if(isset($_POST['submit'])){
                $this->model_user->edit();
                redirect('user/view');
            } else {
                $id = $this->uri->segment(3);
                $data['record'] = $this->model_user->get_one($id)->row_array();

                $this->load->view('user/form_edit', $data);
            }
        } else {
            redirect(base_url('index.php/welcome'));
        }
    }
    
    function delete(){
        if ($this->session->userdata("status")=="login"){
            $id = $this->uri->segment(3);
            $this->model_user->delete($id);
            redirect('user/view');
        } else {
            redirect(base_url('index.php/welcome'));
        }
    }

     
}