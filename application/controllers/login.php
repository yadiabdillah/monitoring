<?php 
 
class Login extends CI_Controller{

	function __construct(){
		parent::__construct();		
		$this->load->model('m_login');
 
	}
 
	function index(){
            if ($this->session->userdata("status")=="login"){
                redirect(base_url("index.php/welcome"));
            } else {
                redirect(base_url('index.php/welcome'));
            }
		
	}
 
	function aksi_login(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
				$id = $username;
				//print_r($username);print_r($password);exit();
		$where = array(
			'username' => $username,
			'password' => md5($password)
			);
		$cek = $this->m_login->cek_login("user",$where)->num_rows();
	//	print_r($cek);exit();
		if($cek > 0){
                    $data = $this->m_login->get_one($id)->row_array();
                  //  print_r($data);exit();
			$data_session = array(
				'role' => $data['jabatan'],
				'id_user'=>$data['id_user'],
				'nama' => $data['nama'],
				'status' => "login"
				);
 
			$this->session->set_userdata($data_session);
 
			redirect(base_url("index.php/welcome"));
 
		}else{
                   // $gagal = "Undefind username or password";
			$this->session->set_flashdata('success', 'Username Atau Password Salah'); 
			redirect(base_url('index.php/welcome'));
		}
	}
 
	function logout(){
		$this->session->sess_destroy();
		redirect(base_url('index.php/welcome'));
	}
}