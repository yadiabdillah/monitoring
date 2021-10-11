<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {
        function __construct() {
            parent::__construct();
            $this->load->model('m_profile');
        }

	public function index()
	{
            if ($this->session->userdata("status")=="login"){
                $id = $this->session->userdata("nama");
                
                $data['record'] = $this->m_profile->get_one($id)->row_array();
                $this->load->view('user/profile', $data);
            } else {
                $this->load->view('login');
            }
		
	}
       
}
