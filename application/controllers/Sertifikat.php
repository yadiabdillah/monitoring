<?php
Class Sertifikat extends CI_Controller{
    
    function __construct() {
        parent::__construct();
        $this->load->model('model_sertifikat');
        $this->load->model('model_formulir');
    }
    
    function index(){
        if ($this->session->userdata("status")=="login"){
            $id = $this->session->userdata("id_user");

            $data['penjual'] = $this->model_sertifikat->get_penjual($id);
            $data['pembeli'] = $this->model_sertifikat->get_pembeli($id);
            $data['id_sertifikat']=$this->model_sertifikat->get_id_sertifikat();
            $this->load->view('sertifikat/form_input',$data);
        } else {
            redirect(base_url('index.php/welcome'));
        }
    }
    function add_penjual(){
        if ($this->session->userdata("status")=="login"){
           $data['id_sertifikat']=$this->model_sertifikat->get_id_penjual();
            $this->load->view('sertifikat/form_input_penjual',$data);
        } else {
            redirect(base_url('index.php/welcome'));
        }
    }
    function add_pembeli(){
        if ($this->session->userdata("status")=="login"){
            $this->load->view('sertifikat/form_input_pembeli');
        } else {
            redirect(base_url('index.php/welcome'));
        }
    }
    
    function save(){
        if ($this->session->userdata("status")=="login"){
            if(isset($_POST['submit'])){

               $this->load->library('upload');
                $dataInfo = array();
              /*   $files = $_FILES;
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
                }*/

                $data = array('id_sertifikat'=> $this->input->post('id_sertifikat'),
                 'tgl_input'=> $this->input->post('tgl_input'), 
                'id_penjual'=> $this->input->post('id_penjual'),
                'id_pembeli'=> $this->input->post('id_pembeli'),
                'no_sertifikat'=> $this->input->post('no_sertifikat'),
                'no_surat_ukur'=> $this->input->post('no_surat_ukur'),
                'luas_tanah'=> $this->input->post('luas_tanah'),
                'luas_bangunan'=> $this->input->post('luas_bangunan'),
                'tgl_surat_ukur'=> $this->input->post('tgl_surat_ukur'),
                'no_id_bdg_tnh'=> $this->input->post('no_id_bdg_tnh'),
                'alamat_objek'=> $this->input->post('alamat_objek'),
                'no_objek_pajak'=> $this->input->post('no_objek_pajak'),
                'harga_transaksi'=> $this->input->post('harga_transaksi'),
                'status_berkas'=> "Submit",
                'id_user'=> $this->input->post('id_user'),
               );
                $this->session->set_flashdata('success', 'Data Berhasil disimpan');
                $this->model_sertifikat->save($data);
                redirect('Sertifikat/view');
            } else {
                 $this->session->set_flashdata('failed', 'Data Gagal disimpan');
                $this->load->view('sertifikat/view');
            }
        } else {

            redirect(base_url('index.php/welcome'));
        }
    }
    function save_penjual(){
        if ($this->session->userdata("status")=="login"){
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

                $data = array('id_penjual'=> $this->input->post('id_penjual'),
                'nama_penjual'=> $this->input->post('nama_penjual'),
                'tempat_lahir'=> $this->input->post('tempat_lahir_penjual'),
                'tgl_lahir'=> $this->input->post('tgl_lahir_penjual'),
                'alamat'=> $this->input->post('alamat_penjual'),
                'pekerjaan'=> $this->input->post('pekerjaan_penjual'),
                'nik'=> $this->input->post('nik_penjual'),
                'npwp'=> $this->input->post('npwp_penjual'),
                'nama_pasangan'=> $this->input->post('nama_pasangan_penjual'),
                'tempat_lahir_pasangan'=> $this->input->post('tmp_lahir_pasangan'),
                'tgl_lahir_pasangan'=> $this->input->post('tgl_lahir_pasangan'),
                'alamat_pasangan'=> $this->input->post('alamat_pasangan'),
                'pekerjaan_pasangan'=> $this->input->post('pekerjaan_pasangan'),
                'nik_pasangan'=> $this->input->post('nik_pasangan'),
                'npwp_pasangan'=> $this->input->post('npwp_pasangan'),
                'id_user'=> $this->input->post('id_user'),
                'foto_ktp'=> $dataInfo[0]['file_name'],
                'copy_sertifikat'=> $dataInfo[1]['file_name'],
                'foto_kk'=> $dataInfo[2]['file_name'],
                'buku_nikah'=> $dataInfo[3]['file_name'],
                'foto_npwp'=> $dataInfo[4]['file_name'],
            );
               // print_r($data);exit();
                $this->session->set_flashdata('success', 'Data Berhasil disimpan');
                $this->model_sertifikat->save_penjual($data);
                redirect('Sertifikat/list_penjual');
            } else {
                 $this->session->set_flashdata('failed', 'Data Gagal disimpan');
                $this->load->view('sertifikat/list_penjual');
            }
        } else {

            redirect(base_url('index.php/welcome'));
        }
    }
    function save_pembeli(){
        if ($this->session->userdata("status")=="login"){
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

                $data = array(
                'nama_pembeli'=> $this->input->post('nama_pembeli'),
                'alamat_pembeli'=> $this->input->post('alamat_pembeli'),
                'tlp_pembeli'=> $this->input->post('tlp_pembeli'),
                'id_user'=> $this->input->post('id_user'),
                'foto_kk_pembeli'=> $dataInfo[0]['file_name'],
                'ktp_pembeli'=> $dataInfo[1]['file_name'],
                );
                $this->session->set_flashdata('success', 'Data Berhasil disimpan');
                $this->model_sertifikat->save_pembeli($data);
                redirect('Sertifikat/list_pembeli');
            } else {
                 $this->session->set_flashdata('failed', 'Data Gagal disimpan');
                $this->load->view('sertifikat/list_pembeli');
            }
        } else {

            redirect(base_url('index.php/welcome'));
        }
    }

    private function set_upload_options()
{   
    //upload an image options
    $config = array();
    $config['upload_path'] = './images/sertifikat/';
    $config['allowed_types'] = 'jpeg|gif|jpg|png|pdf';
    $config['max_size']      = '0';
   $config['overwrite']     = FALSE;

    return $config;
}
    
    function view(){
        if ($this->session->userdata("status")=="login"){
            if ($this->session->userdata("role")=="user") {
                $id = $this->session->userdata("id_user");
                $data['record'] = $this->model_sertifikat->view($id);
            $this->load->view('sertifikat/view', $data);
            }

             if ($this->session->userdata("role")=="staff"){
                $id = $this->session->userdata("id_user");
                $data['record'] = $this->model_sertifikat->view_staff();
            $this->load->view('staff/list_data_masuk', $data);
            }
            
        } else {
            redirect(base_url('index.php/welcome'));
        }
    }

    function list_penjual(){
        $data['record'] = $this->model_sertifikat->view_list_penjual();
        $this->load->view('sertifikat/list_penjual', $data);
    }
    function list_pembeli(){
        $data['record'] = $this->model_sertifikat->view_list_pembeli();
        $this->load->view('sertifikat/list_pembeli', $data);
    }

    public function view_notaris(){
        $id = $this->session->userdata("id_user");
                $data['record'] = $this->model_sertifikat->view_notaris();
            $this->load->view('notaris/list_data_sertifikat', $data);

    }

    public function view_proses(){
        $id = $this->session->userdata("id_user");
                $data['record'] = $this->model_sertifikat->view_staff_progress();
            $this->load->view('staff/list_data_proses', $data);
    }
    
    public function lolos () {
         if ($this->session->userdata("status")=="login"){
            $id = $this->uri->segment(3);
             $this->model_sertifikat->verifikasi($id);
             $input = array(
                'id_user' => $this->session->userdata('id_user'),
                'status' => "Verified Admin",
                'dokumen' => $id,
                'tgl_input' => date('Y-m-d')
            );
            $this->model_formulir->verified_monitoring($input);
              $data['record'] = $this->model_sertifikat->view_staff();
            //print_r($data);exit();
            redirect(base_url('index.php/sertifikat/view'));
        } else {
            redirect(base_url('index.php/welcome'));
        }

    }
    
    function edit(){
        if ($this->session->userdata("status")=="login"){
            if(isset($_POST['submit'])){
                $this->load->library('upload');
                $this->upload->initialize($this->set_upload_options());
                $dataInfo = array();
                $files = $_FILES;
                
                $data = array(
                'id_penjual'=> $this->input->post('id_penjual'),
                'no_sertifikat'=> $this->input->post('no_sertifikat'),
                'no_surat_ukur'=> $this->input->post('no_surat_ukur'),
                'luas_tanah'=> $this->input->post('luas_tanah'),
                'luas_bangunan'=> $this->input->post('luas_bangunan'),
                'tgl_surat_ukur'=> $this->input->post('tgl_surat_ukur'),
                'no_id_bdg_tnh'=> $this->input->post('no_id_bdg_tnh'),
                'alamat_objek'=> $this->input->post('alamat_objek'),
                'no_objek_pajak'=> $this->input->post('no_objek_pajak'),
                'harga_transaksi'=> $this->input->post('harga_transaksi')
            );
                //print_r($data);
               // print_r($dataInfo);
                //exit();
                $this->model_sertifikat->edit($data);
                redirect('sertifikat/view');
            } else {
                $id = $this->uri->segment(3);
                $idusr = $this->session->userdata("id_user");
                $data['penjual'] = $this->model_sertifikat->get_penjual($idusr);
                ;
                $data['record'] = $this->model_sertifikat->get_one($id)->row_array();

                $this->load->view('sertifikat/form_edit', $data);
            }
        } else {
            redirect(base_url('index.php/welcome'));
        }
    }
    function edit_penjual(){
        if ($this->session->userdata("status")=="login"){
            if(isset($_POST['submit'])){
                $this->load->library('upload');
                $this->upload->initialize($this->set_upload_options());
                $dataInfo = array();
                $files = $_FILES;
                $id_pen = $this->input->post('id_penjual');
                $data = array(
                'nama_penjual'=> $this->input->post('nama_penjual'),
                'tempat_lahir'=> $this->input->post('tempat_lahir_penjual'),
                'tgl_lahir'=> $this->input->post('tgl_lahir_penjual'),
                'alamat'=> $this->input->post('alamat_penjual'),
                'pekerjaan'=> $this->input->post('pekerjaan_penjual'),
                'nik'=> $this->input->post('nik_penjual'),
                'npwp'=> $this->input->post('npwp_penjual'),
                'nama_pasangan'=> $this->input->post('nama_pasangan_penjual'),
                'tempat_lahir_pasangan'=> $this->input->post('tmp_lahir_pasangan'),
                'tgl_lahir_pasangan'=> $this->input->post('tgl_lahir_pasangan'),
                'alamat_pasangan'=> $this->input->post('alamat_pasangan'),
                'pekerjaan_pasangan'=> $this->input->post('pekerjaan_pasangan'),
                'nik_pasangan'=> $this->input->post('nik_pasangan'),
                'npwp_pasangan'=> $this->input->post('npwp_pasangan'),
               );
        //       print_r($data);exit();
        
                if ($this->upload->do_upload('userfile1')) {
                    $dataInfo = $this->upload->data();
                    $data['foto_ktp'] = $dataInfo['file_name'];
                }
                if ($this->upload->do_upload('userfile2')) {
                    $dataInfo = $this->upload->data();
                    $data['copy_sertifikat'] = $dataInfo['file_name'];
                }
                if ($this->upload->do_upload('userfile3')) {
                    $dataInfo = $this->upload->data();
                    $data['foto_kk'] = $dataInfo['file_name'];
                }
                if ($this->upload->do_upload('userfile4')) {
                    $dataInfo = $this->upload->data();
                    $data['buku_nikah'] = $dataInfo['file_name'];
                }
                if ($this->upload->do_upload('userfile5')) {
                    $dataInfo = $this->upload->data();
                    $data['foto_npwp'] = $dataInfo['file_name'];
                }
                //print_r($data);
               // print_r($dataInfo);
                //exit();
                $this->model_sertifikat->edit_penjual($data);
                redirect('sertifikat/list_penjual');
            } else {
                $id = $this->uri->segment(3);
                $data['record'] = $this->model_sertifikat->get_one_penjual($id)->row_array();

                $this->load->view('sertifikat/form_edit_penjual', $data);
            }
        } else {
            redirect(base_url('index.php/welcome'));
        }
    }
    function edit_pembeli(){
        if ($this->session->userdata("status")=="login"){
            if(isset($_POST['submit'])){
                $this->load->library('upload');
                $this->upload->initialize($this->set_upload_options());
                $dataInfo = array();
                $files = $_FILES;
                $id_pen = $this->input->post('id_pembeli');
                $data = array(
                'nama_pembeli'=> $this->input->post('nama_pembeli'),
                'alamat_pembeli'=> $this->input->post('alamat_pembeli'),
                'tlp_pembeli'=> $this->input->post('tlp_pembeli'),
               );
        //       print_r($data);exit();
        
                if ($this->upload->do_upload('userfile1')) {
                    $dataInfo = $this->upload->data();
                    $data['ktp_pembeli'] = $dataInfo['file_name'];
                }
                if ($this->upload->do_upload('userfile2')) {
                    $dataInfo = $this->upload->data();
                    $data['foto_kk_pembeli'] = $dataInfo['file_name'];
                }
                //print_r($data);
               // print_r($dataInfo);
                //exit();
                $this->model_sertifikat->edit_pembeli($data);
                redirect('sertifikat/list_pembeli');
            } else {
                $id = $this->uri->segment(3);
                $data['record'] = $this->model_sertifikat->get_one_pembeli($id)->row_array();

                $this->load->view('sertifikat/form_edit_pembeli', $data);
            }
        } else {
            redirect(base_url('index.php/welcome'));
        }
    }
    
    function check(){
        if ($this->session->userdata("status")=="login"){
            $id = $this->uri->segment(3);
            $data['record'] = $this->model_sertifikat->get_one($id)->row_array();
            //print_r($data);exit();
            $this->load->view('sertifikat/form_check', $data);
        } else {
            redirect(base_url('index.php/welcome'));
        }
        
    }
    function check_penjual(){
        if ($this->session->userdata("status")=="login"){
            $id = $this->uri->segment(3);
            $data['record'] = $this->model_sertifikat->get_one_penjual($id)->row_array();
            //print_r($data);exit();
            $this->load->view('sertifikat/form_check_penjual', $data);
        } else {
            redirect(base_url('index.php/welcome'));
        }
        
    }
    function check_pembeli(){
        if ($this->session->userdata("status")=="login"){
            $id = $this->uri->segment(3);
            $data['record'] = $this->model_sertifikat->get_one_pembeli($id)->row_array();
            //print_r($data);exit();
            $this->load->view('sertifikat/form_check_pembeli', $data);
        } else {
            redirect(base_url('index.php/welcome'));
        }
        
    }
    
    function delete(){
        if ($this->session->userdata("status")=="login"){
            $id = $this->uri->segment(3);
            $this->model_sertifikat->delete($id);
             $this->session->set_flashdata('hapus', 'Data Berhasil Dihapus');
            redirect('sertifikat/view');
        } else {
            redirect(base_url('index.php/welcome'));
        }
    }
    function delete_penjual(){
        if ($this->session->userdata("status")=="login"){
            $id = $this->uri->segment(3);
            $this->model_sertifikat->delete_penjual($id);
             $this->session->set_flashdata('hapus', 'Data Berhasil Dihapus');
            redirect('sertifikat/list_penjual');
        } else {
            redirect(base_url('index.php/welcome'));
        }
    }
    function delete_pembeli(){
        if ($this->session->userdata("status")=="login"){
            $id = $this->uri->segment(3);
            $this->model_sertifikat->delete_pembeli($id);
             $this->session->set_flashdata('hapus', 'Data Berhasil Dihapus');
            redirect('sertifikat/list_pembeli');
        } else {
            redirect(base_url('index.php/welcome'));
        }
    }

    public function valid_pajak(){

         if ($this->session->userdata("status")=="login"){
            $id = $this->uri->segment(3);
             $this->model_sertifikat->verifikasi_pajak($id);
             $input = array(
                'id_user' => $this->session->userdata('id_user'),
                'status' => "Validasi Pajak",
                'dokumen' => $id,
                'tgl_input' => date('Y-m-d')
            );
            $this->model_formulir->verified_monitoring($input);
              $data['record'] = $this->model_sertifikat->view_staff_progress();
            //print_r($data);exit();
            redirect(base_url('index.php/sertifikat/view_proses'));
        } else {
            redirect(base_url('index.php/welcome'));
        }

    }

    public function ttd_akta(){

         if ($this->session->userdata("status")=="login"){
            $id = $this->uri->segment(3);
             $this->model_sertifikat->ttd_akta($id);
             $input = array(
                'id_user' => $this->session->userdata('id_user'),
                'status' => "Tanda Tangan Akta",
                'dokumen' => $id,
                'tgl_input' => date('Y-m-d')
            );
            $this->model_formulir->verified_monitoring($input);
              $data['record'] = $this->model_sertifikat->view_notaris();
            //print_r($data);exit();
            redirect(base_url('index.php/sertifikat/view_proses'));
        } else {
            redirect(base_url('index.php/welcome'));
        }

    }

     public function balik_nama(){

         if ($this->session->userdata("status")=="login"){
            $id = $this->uri->segment(3);
             $this->model_sertifikat->balik_nama($id);
             $input = array(
                'id_user' => $this->session->userdata('id_user'),
                'status' => "Proses Balik Nama",
                'dokumen' => $id,
                'tgl_input' => date('Y-m-d')
            );
            $this->model_formulir->verified_monitoring($input);
              $data['record'] = $this->model_sertifikat->view_staff_progress();
            //print_r($data);exit();
            redirect(base_url('index.php/sertifikat/view_proses'));
        } else {
            redirect(base_url('index.php/welcome'));
        }

    }

     public function selesai(){

         if ($this->session->userdata("status")=="login"){
            $id = $this->uri->segment(3);
             $this->model_sertifikat->selesai($id);
             $input = array(
                'id_user' => $this->session->userdata('id_user'),
                'status' => "Selesai",
                'dokumen' => $id,
                'tgl_input' => date('Y-m-d')
            );
            $this->model_formulir->verified_monitoring($input);
              $data['record'] = $this->model_sertifikat->view_staff_progress();
            //print_r($data);exit();
            redirect(base_url('index.php/sertifikat/view_proses'));
        } else {
            redirect(base_url('index.php/welcome'));
        }

    }

    public function monitoring(){
$id = $this->uri->segment(3);
        $data['record'] = $this->model_sertifikat->view_history_sertifikat($id);
        $this->load->view('sertifikat/histori_berkas',$data);
    }
    

}