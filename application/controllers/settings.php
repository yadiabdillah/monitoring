<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {

	function __construct() {
            parent::__construct();
            $this->load->model('m_profile');
        }

	public function index()
	{
            if ($this->session->userdata("status")=="login"){
                $this->load->view('user/setings');
            } else {
                $this->load->view('login');
            }
		
	}
        
        public function change_pwd()
	{
            if ($this->session->userdata("status")=="login"){
                $id = $this->session->userdata("nama");
                
                $this->m_profile->edit($id);
                $this->load->view('user/setings');
            } else {
                $this->load->view('login');
            }
		
	}
        
        

}
