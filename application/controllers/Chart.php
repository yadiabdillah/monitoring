<?php 
 
class Chart extends CI_Controller{

	function __construct(){
		parent::__construct();		
		$this->load->model('model_chart');
 
	}
 
	function index(){
            if ($this->session->userdata("status")=="login"){
                redirect(base_url("index.php/welcome"));
            } else {
                redirect(base_url('index.php/welcome'));
            }
		
	}

	public function chart_view(){
	if (isset($_POST['submit'])) {
			$bln = $this->input->post('bulan');
			$thn = $this->input->post('tahun');

			if ($bln == '01') {
				$isibulan = 'Januari';
			}
				if ($bln == '02') {
				$isibulan = 'Februari';
			}
				if ($bln == '03') {
				$isibulan = 'Maret';
			}
				if ($bln == '04') {
				$isibulan = 'April';
			}
				if ($bln == '05') {
				$isibulan = 'Mei';
			}
				if ($bln == '06') {
				$isibulan = 'Juni';
			}
				if ($bln == '07') {
				$isibulan = 'Juli';
			}
				if ($bln == '08') {
				$isibulan = 'Agustus';
			}
				if ($bln == '09') {
				$isibulan = 'September';
			}
				if ($bln == '10') {
				$isibulan = 'Oktober';
			}
				if ($bln == '11') {
				$isibulan = 'November';
			}
				if ($bln == '12') {
				$isibulan = 'Desember';
			}
			
$data['bulan'] =$isibulan;
$data['tahun'] = $thn;
			
		$data['form'] = $this->model_chart->jumlah_pendirian_bdn();
		$data['balik_nama']=$this->db->get('sertifikat')->num_rows();
		$data['yayasan'] = $this->model_chart->jumlah_pendirian_yayasan();
		$data['form_bln_ini'] = $this->model_chart->jumlah_pendirian_bdn_bln_ini($bln,$thn)->num_rows();
		$data['balik_nama_ini'] = $this->model_chart->jumlah_baliknama_bln_ini($bln,$thn)->num_rows();
		$data['yayasan_bln_ini'] = $this->model_chart->jumlah_pendirian_yayasan_bln_ini($bln,$thn)->num_rows();
		
		}
		else {
			$bln = date('m');
			$thn = date('Y');

				if ($bln == '01') {
				$isibulan = 'Januari';
			}
				if ($bln == '02') {
				$isibulan = 'Februari';
			}
				if ($bln == '03') {
				$isibulan = 'Maret';
			}
				if ($bln == '04') {
				$isibulan = 'April';
			}
				if ($bln == '05') {
				$isibulan = 'Mei';
			}
				if ($bln == '06') {
				$isibulan = 'Juni';
			}
				if ($bln == '07') {
				$isibulan = 'Juli';
			}
				if ($bln == '08') {
				$isibulan = 'Agustus';
			}
				if ($bln == '09') {
				$isibulan = 'September';
			}
				if ($bln == '10') {
				$isibulan = 'Oktober';
			}
				if ($bln == '11') {
				$isibulan = 'November';
			}
				if ($bln == '12') {
				$isibulan = 'Desember';
			}
			$data['bulan'] =$isibulan;
			$data['tahun'] = $thn;
		$data['form'] = $this->model_chart->jumlah_pendirian_bdn();
		$data['balik_nama']=$this->db->get('sertifikat')->num_rows();
		$data['yayasan'] = $this->model_chart->jumlah_pendirian_yayasan();
		$data['form_bln_ini'] = $this->model_chart->jumlah_pendirian_bdn_bln_ini($bln,$thn)->num_rows();
		$data['balik_nama_ini'] = $this->model_chart->jumlah_baliknama_bln_ini($bln,$thn)->num_rows();
		$data['yayasan_bln_ini'] = $this->model_chart->jumlah_pendirian_yayasan_bln_ini($bln,$thn)->num_rows();
		
		}
		//$data['tes'] = $this->model_chart->jumlah_pendirian_yayasan_bln_ini($bln)->result();

		//$data['form'] = $this->db->get('formulir_pp')->num_rows();
	//	print_r($data);exit();
		$this->load->view('chart',$data);



	}

	public function laporan_bulanan_baliknama(){

		if (isset($_POST['submit'])) {
			
			$tgl_awal = $this->input->post('tgl_awal');
			$tgl_akhir = $this->input->post('tgl_akhir');
			$data['record'] = $this->model_chart->cari_baliknama($tgl_awal,$tgl_akhir);
			$this->load->view('sertifikat/view_bulanan_baliknama', $data);
					}else{
			$bln = date('m');
		$data['record'] = $this->model_chart->view_baliknama($bln);
		$this->load->view('sertifikat/view_bulanan_baliknama', $data);
	
		}
		}

	public function laporan_bulanan_yayasan(){
		if (isset($_POST['submit'])) {
			$tgl_awal = $this->input->post('tgl_awal');
			$tgl_akhir = $this->input->post('tgl_akhir');
			$data['record'] = $this->model_chart->cari_yayasan($tgl_awal,$tgl_akhir);
			$this->load->view('formulir/view_bulanan_yayasan', $data);
			//print_r($data);
		}else{
			$bln = date('m');
		$data['record'] = $this->model_chart->view_yayasan($bln);
		$this->load->view('formulir/view_bulanan_yayasan', $data);
		}
		}

	public function laporan_bulanan_pt(){
		if (isset($_POST['submit'])) {
			$tgl_awal = $this->input->post('tgl_awal');
			$tgl_akhir = $this->input->post('tgl_akhir');
			$data['record'] = $this->model_chart->cari_pt($tgl_awal,$tgl_akhir);
			$this->load->view('formulir/view_bulanan_pt', $data);
		}else{
		$bln = date('m');
		$data['record'] = $this->model_chart->view_pt($bln);
		$this->load->view('formulir/view_bulanan_pt', $data);
		}
	}	
 
	
}