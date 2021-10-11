<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends CI_Controller {

     function __construct() {
        parent::__construct();
        $this->load->model('model_payment');
        $this->load->model('model_invoice');
    }
   

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *      http://example.com/index.php/welcome
     *  - or -
     *      http://example.com/index.php/welcome/index
     *  - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
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

      public function input_payment_sertifikat()
    {
        $id = $this->uri->segment(3);
        $data['id_invoice'] = $id;
                $this->model_->get_one($id)->row_array();
        //$data['record'] = $this->model_invoice->get_one($id)->row_array();
       // print_r($data); exit();
        //print_r($data);
        $this->load->view('payment/input_payment_sertifikat',$data);
    }


    public function input_formulir()
    {
        $id = $this->uri->segment(3);
        $data['id_po'] = $id;
        $data['record'] = $this->model_invoice->get_one_formulir($id)->row_array();
       // print_r($data); exit();
        //print_r($data);
        $this->load->view('invoice/input_form',$data);
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

    public function save_payment_form()
    {
        $tgl = date('Y-m-d');
        $id_invoice = $this->input->post('id_invoice');
        $jml_bayar = $this->input->post('jml_bayar');
        $data  = array('id_payment' => '' ,
            'id_invoice' => $id_invoice ,
            'tgl_bayar' => $tgl ,
            'jml_bayar' => $jml_bayar);
        //print_r($data);
        $this->model_payment->save($data);
        redirect('payment/view_sertifikat');
    }

    public function view_sertifikat(){
        if ($this->session->userdata("status")=="login"){
            $data['record'] = $this->model_payment->view_sertifikat();
           //print_r($data);exit();
            $this->load->view('payment/view', $data);
        } else {
            redirect(base_url('index.php/welcome'));
        }
    }

    public function view_formulir(){
    if ($this->session->userdata("status")=="login"){
            $data['record'] = $this->model_payment->view_formulir();
            $this->load->view('payment/view_formulir', $data);
        } else {
            redirect(base_url('index.php/welcome'));
        }
    }
        
        public function dp_sertifikat(){
    if ($this->session->userdata("status")=="login"){
            $id = $this->uri->segment(3);
            $tagihan = $this->uri->segment(4);
            $bayar = $tagihan/2;
            $tgl = date('Y-m-d');
            $data_payment  = array('id_payment' => '' ,
                         'id_invoice' => $id ,
                         'jml_bayar' => $bayar ,
                         'tgl_bayar' => $tgl);
        //print_r($data);
        //    $this->model_payment->save_payment($data_payment);
            $this->model_payment->update_status($id);
            redirect('payment/view_sertifikat');
        } else {
            redirect(base_url('index.php/welcome'));
        }
    }
        
        public function lunas_sertifikat(){
    if ($this->session->userdata("status")=="login"){
            $id = $this->uri->segment(3);
            $tagihan = $this->uri->segment(4);
            $bayar = $tagihan/2;
            $tgl = date('Y-m-d');
            $data_payment  = array('id_payment' => '' ,
                         'id_invoice' => $id ,
                         'jml_bayar' => $bayar ,
                         'tgl_bayar' => $tgl);
        //print_r($data);
        //  $this->model_payment->save_payment($data_payment);
            $this->model_payment->update_status_lunas($id);
            redirect('payment/view_sertifikat');
        } else {
            redirect(base_url('index.php/welcome'));
        }
    }

    public function lihat_history(){
        if ($this->session->userdata("status")=="login"){
            $id = $this->uri->segment(3);
            $data['record'] = $this->model_payment->view_detail_transaksi($id);
           $this->load->view('payment/view_detail', $data);
        } else {
            redirect(base_url('index.php/welcome'));
        }
    }
    public function lihat_bukti_bayar(){
        if ($this->session->userdata("status")=="login"){
            $id = $this->uri->segment(3);
            $data['record'] = $this->model_payment->view_detail_transaksi($id);
           $this->load->view('payment/view_bukti_bayar', $data);
        } else {
            redirect(base_url('index.php/welcome'));
        }
    }
    public function lihat_bukti_bayar_formulir(){
        if ($this->session->userdata("status")=="login"){
            $id = $this->uri->segment(3);
            $data['record'] = $this->model_payment->view_detail_transaksi($id);
           $this->load->view('payment/view_bukti_bayar_formulir', $data);
        } else {
            redirect(base_url('index.php/welcome'));
        }
    }

    public function lihat_history_formulir(){
        if ($this->session->userdata("status")=="login"){
            $id = $this->uri->segment(3);
            $data['record'] = $this->model_payment->view_detail_transaksi($id);
           $this->load->view('payment/view_detail_formulir', $data);
        } else {
            redirect(base_url('index.php/welcome'));
        }
    }
        
        public function dp_balik_nama(){
    if ($this->session->userdata("status")=="login"){
            $id = $this->uri->segment(3);
            $tagihan = $this->uri->segment(4);
            $bayar = $tagihan/2;
            $tgl = date('Y-m-d');
            $data_payment  = array('id_payment' => '' ,
                         'id_invoice' => $id ,
                         'jml_bayar' => $bayar ,
                         'tgl_bayar' => $tgl);
        //print_r($data);
          //  $this->model_payment->save_payment($data_payment);
            $this->model_payment->update_status($id);
            redirect('payment/view_formulir');
        } else {
            redirect(base_url('index.php/welcome'));
        }
    }
        
        public function lunas_balik_nama(){
    if ($this->session->userdata("status")=="login"){
            $id = $this->uri->segment(3);
            $bayar = $this->uri->segment(4);
            $tgl = date('Y-m-d');
            $data_payment  = array('id_payment' => '' ,
                         'id_invoice' => $id ,
                         'jml_bayar' => $bayar ,
                         'tgl_bayar' => $tgl);
        //print_r($data);
          //  $this->model_payment->save_payment($data_payment);
            $this->model_payment->update_status_lunas($id);
            redirect('payment/view_formulir');
        } else {
            redirect(base_url('index.php/welcome'));
        }
    }
}
