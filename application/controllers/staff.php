<?php
Class Staff extends CI_Controller{
    
    function __construct() {
        parent::__construct();
        $this->load->model('model_sertifikat');
    }
    
    function index(){
        if ($this->session->userdata("status")=="login"){
            $this->load->view('sertifikat/form_input');
        } else {
            redirect(base_url('index.php/welcome'));
        }
    }
    
    function save(){
        if ($this->session->userdata("status")=="login"){
            if(isset($_POST['submit'])){
                $this->model_sertifikat->save();
                redirect('Sertifikat');
            } else {
                $this->load->view('sertifikat/form_input');
            }
        } else {
            redirect(base_url('index.php/welcome'));
        }
    }
    
    function view(){
        if ($this->session->userdata("status")=="login"){
            if ($this->session->userdata("role")=="user") {
                $id = $this->session->userdata("id_user");
                $data['record'] = $this->model_sertifikat->view($id);
            $this->load->view('sertifikat/view', $data);
            }
            
        } else {
            redirect(base_url('index.php/welcome'));
        }
    }
    
    
    function edit(){
        if ($this->session->userdata("status")=="login"){
            if(isset($_POST['submit'])){
                $this->model_sertifikat->edit();
                redirect('sertifikat/view');
            } else {
                $id = $this->uri->segment(3);
                $data['record'] = $this->model_sertifikat->get_one($id)->row_array();

                $this->load->view('sertifikat/form_edit', $data);
            }
        } else {
            redirect(base_url('index.php/welcome'));
        }
    }
    
    function check(){
        if ($this->session->userdata("status")=="login"){
            $id = $this->uri->segment(3);
            $data['record'] = $this->model_sertifikat->get_one($id)->row_array();
            
            $this->load->view('sertifikat/form_check', $data);
        } else {
            redirect(base_url('index.php/welcome'));
        }
        
    }
    
    function delete(){
        if ($this->session->userdata("status")=="login"){
            $id = $this->uri->segment(3);
            $this->model_sertifikat->delete($id);
            redirect('sertifikat/view');
        } else {
            redirect(base_url('index.php/welcome'));
        }
    }
    
}