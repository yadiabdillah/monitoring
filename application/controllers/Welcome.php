<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	function __construct(){
		parent::__construct();		
		$this->load->model('m_login');
		$this->load->model('model_formulir');
		$this->load->model('model_sertifikat');
		$this->load->model('model_invoice');
 
	}

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{		//print_r('ada'); exit();
		//print_r($this->session->userdata("status"));exit();
            if ($this->session->userdata("status")=="login"){
				if ($this->session->userdata("role")=="user") {
					$id = $this->session->userdata("id_user");
					$data['serti'] = $this->model_sertifikat->view($id)->num_rows();
					$a = $this->model_formulir->view($id)->num_rows();
					$b = $this->model_formulir->view_yayasan($id)->num_rows();
					$data['form'] = $a+$b;
					$data['serti_inv'] = $this->model_invoice->view_sertifikat_user($id)->num_rows();
					$data['form_inv'] = $this->model_invoice->view_formulir_user($id)->num_rows();
           
          
			 
				$this->load->view('template', $data);
				}else {
					$this->load->view('template');
			
				}

            } else {
                $this->load->view('login');
            }
		
	}
        
        public function login()
	{
		$this->load->view('template');
	}
}
