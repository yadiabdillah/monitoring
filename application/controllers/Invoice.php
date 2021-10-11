<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice extends CI_Controller {

	 function __construct() {
        parent::__construct();
        $this->load->model('model_invoice');
        $this->load->model('model_sertifikat');
        $this->load->model('model_payment');
    }
   

	public function index()
	{
           /* if ($this->session->userdata("status")=="login"){
                $this->load->view('template');
            } else {
                $this->load->view('login');
            } */
		
	}
        
        public function input_sertifikat()
	{
		$id = $this->uri->segment(3);
		$data['id_po'] = $id;
        $data['record'] = $this->model_invoice->get_one($id)->row_array();
       // print_r($data); exit();
        //print_r($data);
		$this->load->view('invoice/input',$data);
	}


	public function input_formulir()
	{
		$id = $this->uri->segment(3);
		$data['id_po'] = $id;
		$jum = $this->model_invoice->get_one_formulir($id)->num_rows();
		if ($jum > 0){
			$data['record'] = $this->model_invoice->get_one_formulir($id)->row_array();
		
			// print_r($data); exit();
			 //print_r($data);
			 $this->load->view('invoice/input_form',$data);
		 
		}else 
		{
			$data['record'] = $this->model_invoice->get_one_formulir_yys($id)->row_array();
		
			// print_r($data); exit();
			 //print_r($data);
			 $this->load->view('invoice/input_form',$data);
		 
		
		}
	}

	public function save_sertifikat()
	{
		$id = $this->input->post('id_user');
		$tgl = date('Y-m-d');
		$no_invoice = $this->input->post('no_invoice');
		$pengecekan_sertifikat = $this->input->post('pengecekan_sertifikat');
		$proses_balik_nama = $this->input->post('proses_balik_nama');
		$jasa_notaris = $this->input->post('jasa_notaris');
		$total = $pengecekan_sertifikat+$proses_balik_nama+$jasa_notaris;
		$id_sertifikat = $this->input->post('id_sertifikat');
		$data  = array('id_invoice' => '' ,
			'no_invoice' => $no_invoice ,
			'tgl_invoice' => $tgl ,
			'biaya_cek_sertifikat' => $pengecekan_sertifikat ,
			'biaya_proses_bpn' => $proses_balik_nama ,
			'biaya_jasa_notaris' => $jasa_notaris ,
			'total_biaya' => $total ,
			'status_bayar' => 'Belum Bayar' ,
			'id_user' => $id,
			'id_sertifikat' => $id_sertifikat,
			'id_jenis' => 1 );
		//print_r($data);
		$this->model_invoice->save($data);
		redirect('invoice/view_sertifikat');
	}

	public function save_formulir()
	{
		$id = $this->input->post('id_user');
		$tgl = date('Y-m-d');
		$total = $this->input->post('total_harga');
		$no_formulir = $this->input->post('no_formulir');
		$no_invoice = $this->input->post('no_invoice');
		$data  = array('id_invoice' => '' ,
			'no_invoice' => $no_invoice ,
			'tgl_invoice' => $tgl ,
			'total_biaya' => $total ,
			'status_bayar' => 'Belum Bayar' ,
			'id_user' => $id,
			'id_sertifikat' => $no_formulir,
			'id_jenis' => 2 );
		//print_r($data);
		$this->model_invoice->save($data);
		redirect('invoice/view_formulir');
	}

	public function view_sertifikat(){
		if ($this->session->userdata("status")=="login"){
            $data['record'] = $this->model_invoice->view_sertifikat();
           //print_r($data);exit();
            $this->load->view('invoice/view', $data);
        } else {
            redirect(base_url('index.php/welcome'));
        }
	}

	public function view_sertifikat_user(){
		if ($this->session->userdata("status")=="login"){
			$id = $this->session->userdata("id_user");
            $data['record'] = $this->model_invoice->view_sertifikat_user($id);
           //print_r($data);exit();
            $this->load->view('invoice/view_user_sertifikat', $data);
        } else {
            redirect(base_url('index.php/welcome'));
        }
	}

	public function view_formulir_user(){
		if ($this->session->userdata("status")=="login"){
			$id = $this->session->userdata("id_user");
            $data['record'] = $this->model_invoice->view_formulir_user($id);
           //print_r($data);exit();
            $this->load->view('invoice/view_user_formulir', $data);
        } else {
            redirect(base_url('index.php/welcome'));
        }
	}

	public function view_formulir(){
		if ($this->session->userdata("status")=="login"){
            $data['record'] = $this->model_invoice->view_formulir();
           //print_r($data);exit();
            $this->load->view('invoice/view_formulir', $data);
        } else {
            redirect(base_url('index.php/welcome'));
        }
	}

	public function bukti_bayardp_serti(){


		if(isset($_POST['submit'])){
			$this->load->library('upload');
                $dataInfo = array();
                $files = $_FILES;
                $cpt = count($_FILES['userfile']['name']);
               // print_r($cpt);exit();
                for($i=0; $i<$cpt; $i++)
                {           
                    $_FILES['userfile']['name']= $files['userfile']['name'][$i];
                    $_FILES['userfile']['type']= $files['userfile']['type'][$i];
                    $_FILES['userfile']['tmp_name']= $files['userfile']['tmp_name'][$i];
                    $_FILES['userfile']['error']= $files['userfile']['error'][$i];
                    $_FILES['userfile']['size']= $files['userfile']['size'][$i];    

                    $this->upload->initialize($this->set_upload_options());
                    $this->upload->do_upload();
                    $dataInfo[] = $this->upload->data();
                }
			$keterangan = 'Bayar DP';
			$tgl = date('Y-m-d');
			$jenis = $this->input->post('jenis_form');
			$jumlah_bayar = $this->input->post('total_biaya')/2;
			$id_invoice = $this->input->post('id_invoice');

			$data  = array('id_invoice' =>$id_invoice ,
							'jml_bayar' =>$jumlah_bayar,
							'tgl_bayar'=>$tgl,
							'keterangan' =>$keterangan,
							'gambar'=>$dataInfo[0]['file_name'] );

			  $this->model_payment->save_dp($data);
			  $this->model_payment->update_status_uploaddp($id_invoice);

			  if ($jenis == 1) {
			  	 redirect('invoice/view_sertifikat_user');
			  }
			  if ($jenis == 2) {
			  	redirect('invoice/view_formulir_user');
			  }
            

					} else{
			$id = $this->uri->segment(3);
		$data['id_po'] = $id;
        $data['record'] = $this->model_invoice->get_one_invoice($id)->row_array();
       //print_r($data); exit();
        //print_r($data);
             $this->session->set_flashdata('success', 'Data Bukti Bayar Berhasil Disimpan');
		$this->load->view('invoice/upload_bb_sertifikat',$data);
		}
		
	}

	public function bukti_bayar_serti(){


		if(isset($_POST['submit'])){
			$this->load->library('upload');
                $dataInfo = array();
                $files = $_FILES;
                $cpt = count($_FILES['userfile']['name']);
               // print_r($cpt);exit();
                for($i=0; $i<$cpt; $i++)
                {           
                    $_FILES['userfile']['name']= $files['userfile']['name'][$i];
                    $_FILES['userfile']['type']= $files['userfile']['type'][$i];
                    $_FILES['userfile']['tmp_name']= $files['userfile']['tmp_name'][$i];
                    $_FILES['userfile']['error']= $files['userfile']['error'][$i];
                    $_FILES['userfile']['size']= $files['userfile']['size'][$i];    

                    $this->upload->initialize($this->set_upload_options());
                    $this->upload->do_upload();
                    $dataInfo[] = $this->upload->data();
                }
			$keterangan = 'Bayar Lunas';
			$tgl = date('Y-m-d');
			$jenis = $this->input->post('jenis_form');
			$jumlah_bayar = $this->input->post('total_biaya')/2;
			$id_invoice = $this->input->post('id_invoice');

			$data  = array('id_invoice' =>$id_invoice ,
							'jml_bayar' =>$jumlah_bayar,
							'tgl_bayar'=>$tgl,
							'keterangan' =>$keterangan,
							'gambar'=>$dataInfo[0]['file_name'] );

			  $this->model_payment->save_dp($data);
			   if ($jenis == 1) {
			  	 redirect('invoice/view_sertifikat_user');
			  }
			  if ($jenis == 2) {
			  	redirect('invoice/view_formulir_user');
			  }

					} else{
			$id = $this->uri->segment(3);
		$data['id_po'] = $id;
        $data['record'] = $this->model_invoice->get_one_invoice($id)->row_array();
       //print_r($data); exit();
        //print_r($data);
          $this->session->set_flashdata('success', 'Data Bukti Bayar Berhasil Disimpan');
		$this->load->view('invoice/upload_bb_sertifikat_lunas',$data);
		}
		
	}

	     private function set_upload_options()
{   
    //upload an image options
    $config = array();
    $config['upload_path'] = './images/struk_dp/';
    $config['allowed_types'] = 'jpeg|gif|jpg|png|pdf';
    $config['max_size']      = '0';
   // $config['overwrite']     = FALSE;

    return $config;
}

}
