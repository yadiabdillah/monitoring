<?php
Class Formulir extends CI_Controller{
    
    function __construct() {
        parent::__construct();
        $this->load->model('model_formulir');
        $this->load->model('model_sertifikat');
    }
    
    function index(){
        if ($this->session->userdata("status")=="login"){
            $tipe = $this->input->get('tipe');
            $data['tipe_form'] = $this->input->get('tipe');
            if ($tipe == 'Yayasan') {
            $data['no_formulir']=$this->model_formulir->get_no_formulir_yys();
            $data['direktur'] = $this->model_formulir->get_direktur();
            $this->load->view('formulir/form_input_yayasan',$data);
            }else{
                $data['direktur'] = $this->model_formulir->get_direktur();
           
                $data['no_formulir']=$this->model_formulir->get_no_formulir();
            $this->load->view('formulir/form_input',$data);
        
            }
            } else {
                redirect(base_url('index.php/welcome'));
            }
    }
    function list_direktur(){
        if ($this->session->userdata("status")=="login"){
            $id = $this->session->userdata("id_user");
            $data['record'] = $this->model_formulir->view_list_direktur($id);
            $this->load->view('formulir/list_direktur', $data);
          } else {
                  redirect(base_url('index.php/welcome'));
              }
    }
    function add_direktur(){
        if ($this->session->userdata("status")=="login"){
            $data['no_direktur']=$this->model_formulir->get_id_direktur();
            $this->load->view('formulir/form_direktur',$data);
          } else {
                  redirect(base_url('index.php/welcome'));
              }
    }

    function yayasan(){
        if ($this->session->userdata("status")=="login"){
          $data['no_formulir']=$this->model_formulir->get_no_formulir();
            $this->load->view('formulir/form_input_yayasan',$data);
        } else {
                redirect(base_url('index.php/welcome'));
            }
    }
    
    function save(){
        if ($this->session->userdata("status")=="login"){
            if(isset($_POST['submit'])){
               $this->load->library('upload');
                $dataInfo   = array();
                $files      = $_FILES;
                $cpt        = count($_FILES['userfile']['name']);
               // print_r($cpt);exit();
                for($i=0; $i<$cpt; $i++)
                {           
                    $_FILES['userfile']['name']     = $files['userfile']['name'][$i];
                    $_FILES['userfile']['type']     = $files['userfile']['type'][$i];
                    $_FILES['userfile']['tmp_name'] = $files['userfile']['tmp_name'][$i];
                    $_FILES['userfile']['error']    = $files['userfile']['error'][$i];
                    $_FILES['userfile']['size']     = $files['userfile']['size'][$i];    

                    $this->upload->initialize($this->set_upload_options());
                    $this->upload->do_upload();
                    $dataInfo[] = $this->upload->data();
                }

                $data = array(
                'id_formulir'=> $this->input->post('no_formulir'),
                'tgl_input'         => $this->input->post('tgl_input'), 
                'id_direktur'     => $this->input->post('id_direktur'),
                'nama_perusahaan'   => $this->input->post('nama_perusahaan'),
                'penanggung_jawab'   => $this->input->post('penanggung_jwb'),
                'alamat_perusahaan' => $this->input->post('alamat_perusahaan'),
                'perusahaan'        => $this->input->post('perusahaan'),
                'email_perusahaan'  => $this->input->post('email_perusahaan'),
                'no_telp_perusahaan'=> $this->input->post('no_telp_perusahaan'),
                'modal_dasar'       => $this->input->post('modal_dasar'),
                'modal_ditempatkan' => $this->input->post('modal_ditempatkan'),
                'bidang_usaha'      => $this->input->post('bidang_usaha'),
                'kegiatan_usaha'    => $this->input->post('kegiatan_usaha'),
                'komposisi_saham'   => $this->input->post('komposisi_saham'),
                'direktur_perusahaan'=> $this->input->post('direktur_perusahaan'),
                'wakil_direktur'    => $this->input->post('wakil_direktur'),
                'komisaris1'        => $this->input->post('komisaris1'),
                'komisaris2'        => $this->input->post('komisaris2'),
                 'id_user'          => $this->input->post('id_user'),
                 'ktp_pendiri'      =>$dataInfo[0]['file_name'],
                 'copy_pbb'         =>$dataInfo[1]['file_name'],
                 'sk_rtrw'          =>$dataInfo[2]['file_name'],
                 'status_berkas'        => "Submit"
            );

               $this->model_formulir->save($data);
             redirect('Formulir/view');
            } else {

                $this->load->view('formulir/view');
            }
        } else {
            redirect(base_url('index.php/welcome'));
        }
    }
    function save_direktur(){
        if ($this->session->userdata("status")=="login"){
            if(isset($_POST['submit'])){
               $this->load->library('upload');
                $dataInfo   = array();
                $files      = $_FILES;
                $cpt        = count($_FILES['userfile']['name']);
               // print_r($cpt);exit();
                for($i=0; $i<$cpt; $i++)
                {           
                    $_FILES['userfile']['name']     = $files['userfile']['name'][$i];
                    $_FILES['userfile']['type']     = $files['userfile']['type'][$i];
                    $_FILES['userfile']['tmp_name'] = $files['userfile']['tmp_name'][$i];
                    $_FILES['userfile']['error']    = $files['userfile']['error'][$i];
                    $_FILES['userfile']['size']     = $files['userfile']['size'][$i];    

                    $this->upload->initialize($this->set_upload_options());
                    $this->upload->do_upload();
                    $dataInfo[] = $this->upload->data();
                }

                $data = array('id_pimpinan'=> $this->input->post('no_formulir'),
                'tgl_input'         => $this->input->post('tgl_input'), 
                'nama_pimpinan'     => $this->input->post('nama_direktur'),
                //'penanggung_jwb'  => $this->input->post('penanggung_jwb'),
                'tempat_lahir'      => $this->input->post('tmp_lahir'),
                'tgl_lahir'         => $this->input->post('tgl_lahir'),
                'alamat'            => $this->input->post('alamat'),
                'pekerjaan'         => $this->input->post('pekerjaan'),
                'nik'               => $this->input->post('nik'),
                'npwp'              => $this->input->post('npwp'),
                'kewarganegaraan'   => $this->input->post('kewarganegaraan'),
                'no_telp'  => $this->input->post('no_telp_direktur'),
                 'id_user'          => $this->input->post('id_user'),
                // 'ktp_pendiri'      =>$dataInfo[0]['file_name'],
                 'foto_npwp'    => $dataInfo[0]['file_name'],

            );

               $this->model_formulir->save_direktur($data);
             redirect('Formulir/list_direktur');
            } else {
                $this->load->view('list_direktur/view');
            }
        } else {
            redirect(base_url('index.php/welcome'));
        }
    }

    function save_yayasan(){
        if ($this->session->userdata("status")=="login"){
            if(isset($_POST['submit'])){
               $this->load->library('upload');
                $dataInfo = array();
                $files = $_FILES;
                $cpt = count($_FILES['userfile']['name']);
               // print_r($cpt);exit();
                for($i=0; $i<$cpt; $i++)
                {           
                    $_FILES['userfile']['name']      = $files['userfile']['name'][$i];
                    $_FILES['userfile']['type']      = $files['userfile']['type'][$i];
                    $_FILES['userfile']['tmp_name']  = $files['userfile']['tmp_name'][$i];
                    $_FILES['userfile']['error']     = $files['userfile']['error'][$i];
                    $_FILES['userfile']['size']      = $files['userfile']['size'][$i];    

                    $this->upload->initialize($this->set_upload_options());
                    $this->upload->do_upload();
                    $dataInfo[] = $this->upload->data();
                }

                $data = array(
                'id_formulir'    => $this->input->post('no_formulir'),
                'tgl_input'      => $this->input->post('tgl_input'), 
                'id_pejabat'     => $this->input->post('id_direktur'),
                'nama_yayasan'   => $this->input->post('nama_perusahaan'),
                'alamat_yayasan' => $this->input->post('alamat_perusahaan'),
                'yayasan'        => $this->input->post('perusahaan'),
                'email_yayasan'  => $this->input->post('email_perusahaan'),
                'no_telp_yayasan'=> $this->input->post('no_telp_perusahaan'),
                'kekayaan_awal'       => $this->input->post('modal_dasar'),
                'bidang_sosial'      => $this->input->post('bidang_usaha'),
                'bidang_agama'    => $this->input->post('kegiatan_usaha'),
                'bidang_pendidikan'   => $this->input->post('komposisi_saham'),
                'pembina'=> $this->input->post('direktur_perusahaan'),
                'wakil_ketua'    => $this->input->post('wakil_direktur'),
                'bendahara'        => $this->input->post('komisaris1'),
                'sekretaris'        => $this->input->post('komisaris2'),
                'pengawas'          => $this->input->post('pengawas'),
                 'id_user'          => $this->input->post('id_user'),
                 'ktp_pendiri'      =>$dataInfo[0]['file_name'],
                 'copy_pbb'         =>$dataInfo[1]['file_name'],
                 'sk_rtrw'          =>$dataInfo[2]['file_name'],
                 'status_berkas'    => "Submit"
            );

               $this->model_formulir->save_yayasan($data);
               $this->session->set_flashdata('success', 'Data Berhasil disimpan');
             redirect('Formulir/view_yayasan');
            } else {
                  $this->session->set_flashdata('failed', 'Data Gagal disimpan');
                $this->load->view('formulir/view_yayasan');
            }
        } else {
            redirect(base_url('index.php/welcome'));
        }
    }

     private function set_upload_options()
{   
    //upload an image options
    $config = array();
    $config['upload_path'] = './images/formulir/';
    $config['allowed_types'] = 'jpeg|gif|jpg|png|pdf';
    $config['max_size']      = '0';
   // $config['overwrite']     = FALSE;

    return $config;
}
    
    function view(){
        if ($this->session->userdata("status")=="login"){
            if ($this->session->userdata("role")=="user") {
                $id = $this->session->userdata("id_user");
              //  print_r($id);
              $data['record'] = $this->model_formulir->view($id);
           $this->load->view('formulir/view', $data);
            }

             if ($this->session->userdata("role")=="staff"){
                $id = $this->session->userdata("id_user");
                $data['record'] = $this->model_formulir->view_staff();
            $this->load->view('staff/list_formulir_masuk', $data);
            }
           

        } else {
            redirect(base_url('index.php/welcome'));
        }


    }

    function view_yayasan(){
        if ($this->session->userdata("status")=="login"){
            if ($this->session->userdata("role")=="user") {
            $id = $this->session->userdata("id_user");
              //  print_r($id);
            $data['record'] = $this->model_formulir->view_yayasan($id);
           $this->load->view('formulir/view_yayasan', $data);
            }

             if ($this->session->userdata("role")=="staff"){
                $id = $this->session->userdata("id_user");
                $data['record'] = $this->model_formulir->view_staff();
            $this->load->view('staff/list_formulir_masuk', $data);
            }
           

        } else {
            redirect(base_url('index.php/welcome'));
        }


    }

    public function view_notaris(){
       $id = $this->session->userdata("id_user");
                $data['record'] = $this->model_formulir->view_notaris();
            $this->load->view('notaris/list_data_formulir', $data);
    }

    public function view_proses(){
        $id = $this->session->userdata("id_user");
                $data['record'] = $this->model_formulir->view_staff_progress();
            $this->load->view('staff/list_formulir_proses', $data);
    }

     public function lolos () {
         if ($this->session->userdata("status")=="login"){
            $id = $this->uri->segment(3);
            $tes = $this->model_formulir->get_one($id)->num_rows();
            if($tes>0){
                $input = array(
                    'id_user' => $this->session->userdata('id_user'),
                    'status' => "Verified Admin",
                    'dokumen' => $id,
                    'tgl_input' => date('Y-m-d')
                );
                $this->model_formulir->verified_monitoring($input);
                $this->model_formulir->verifikasi($id);
                $data['record'] = $this->model_formulir->view_staff();
              //print_r($data);exit();
              $this->load->view('staff/list_formulir_masuk', $data);
          
            }else {
                $this->model_formulir->verifikasi_yys($id);
                $data['record'] = $this->model_formulir->view_staff();
              //print_r($data);exit();
              $this->load->view('staff/list_formulir_masuk', $data);
          
            }
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
                'id_direktur'=> $this->input->post('id_direktur'),
                'penanggung_jawab'=> $this->input->post('penanggung_jwb'),
                'nama_perusahaan'=> $this->input->post('nama_perusahaan'),
                'alamat_perusahaan'=> $this->input->post('alamat_perusahaan'),
                'perusahaan'=> $this->input->post('perusahaan'),
                'email_perusahaan'=> $this->input->post('email_perusahaan'),
                'no_telp_perusahaan'=> $this->input->post('no_telp_perusahaan'),
                'modal_dasar'=> $this->input->post('modal_dasar'),
                'modal_ditempatkan'=> $this->input->post('modal_ditempatkan'),
                'bidang_usaha'=> $this->input->post('bidang_usaha'),
                'kegiatan_usaha'=> $this->input->post('kegiatan_usaha'),
                'komposisi_saham'=> $this->input->post('komposisi_saham'),
                'direktur_perusahaan'=> $this->input->post('direktur_perusahaan'),
                'wakil_direktur'=> $this->input->post('wakil_direktur'),
                'komisaris1'=> $this->input->post('komisaris1'),
                'komisaris2'=> $this->input->post('komisaris2')
            );
                 if ($this->upload->do_upload('userfile1')) {
                    $dataInfo = $this->upload->data();
                    $data['ktp_pendiri'] = $dataInfo['file_name'];
                }
                if ($this->upload->do_upload('userfile3')) {
                    $dataInfo = $this->upload->data();
                    $data['copy_pbb'] = $dataInfo['file_name'];
                }
                if ($this->upload->do_upload('userfile4')) {
                    $dataInfo = $this->upload->data();
                    $data['sk_rtrw'] = $dataInfo['file_name'];
                }
               
                $this->model_formulir->edit($data);
                redirect('formulir/view');
            } else {
                $id = $this->uri->segment(3);
                $data['direktur'] = $this->model_formulir->get_direktur();
                $data['record'] = $this->model_formulir->get_one($id)->row_array();

                $this->load->view('formulir/form_edit', $data);
            }
        } else {
            redirect(base_url('index.php/welcome'));
        }
    }
    function edit_direktur(){
        if ($this->session->userdata("status")=="login"){
            if(isset($_POST['submit'])){
                $this->load->library('upload');
                $this->upload->initialize($this->set_upload_options());
                $dataInfo = array();
                $files = $_FILES;
                

                $data = array(
                
                'nama_pimpinan'=> $this->input->post('nama_direktur'),
                'tempat_lahir'=> $this->input->post('tmp_lahir'),
                'tgl_lahir'=> $this->input->post('tgl_lahir'),
                'alamat'=> $this->input->post('alamat'),
                'pekerjaan'=> $this->input->post('pekerjaan'),
                'nik'=> $this->input->post('nik'),
                'npwp'=> $this->input->post('npwp'),
                'kewarganegaraan'=> $this->input->post('kewarganegaraan'),
                'no_telp'=> $this->input->post('no_telp_direktur')
              );
                
                if ($this->upload->do_upload('userfile2')) {
                    $dataInfo = $this->upload->data();
                    $data['npwp_direktur'] = $dataInfo['file_name'];
                }
             
               
                $this->model_formulir->edit_direktur($data);
                redirect('formulir/list_direktur');
            } else {
                $id = $this->uri->segment(3);
                $data['record'] = $this->model_formulir->get_one_direktur($id)->row_array();

                $this->load->view('formulir/form_edit_direktur', $data);
            }
        } else {
            redirect(base_url('index.php/welcome'));
        }
    }

    function edit_yayasan(){
        if ($this->session->userdata("status")=="login"){
            if(isset($_POST['submit'])){
                $this->load->library('upload');
                $this->upload->initialize($this->set_upload_options());
                $dataInfo = array();
                $files = $_FILES;
                

                $data = array(

                'id_pejabat'     => $this->input->post('id_direktur'),
                'nama_yayasan'   => $this->input->post('nama_perusahaan'),
                'alamat_yayasan' => $this->input->post('alamat_perusahaan'),
                'yayasan'        => $this->input->post('perusahaan'),
                'email_yayasan'  => $this->input->post('email_perusahaan'),
                'no_telp_yayasan'=> $this->input->post('no_telp_perusahaan'),
                'kekayaan_awal'  => $this->input->post('modal_dasar'),
                'bidang_sosial'  => $this->input->post('bidang_usaha'),
                'bidang_agama'    => $this->input->post('kegiatan_usaha'),
                'bidang_pendidikan'   => $this->input->post('komposisi_saham'),
                'pembina'=> $this->input->post('direktur_perusahaan'),
                'wakil_ketua'    => $this->input->post('wakil_direktur'),
                'bendahara'        => $this->input->post('komisaris1'),
                'sekretaris'        => $this->input->post('komisaris2'),
                'pengawas'          => $this->input->post('pengawas'),
                    
              
            );
                //print_r($data);exit();
                 if ($this->upload->do_upload('userfile1')) {
                    $dataInfo = $this->upload->data();
                    $data['ktp_pendiri'] = $dataInfo['file_name'];
                }
                if ($this->upload->do_upload('userfile3')) {
                    $dataInfo = $this->upload->data();
                    $data['copy_pbb'] = $dataInfo['file_name'];
                }
                if ($this->upload->do_upload('userfile4')) {
                    $dataInfo = $this->upload->data();
                    $data['sk_rtrw'] = $dataInfo['file_name'];
                }
               
                $this->model_formulir->edit_yys($data);
                redirect('formulir/view_yayasan');
            } else {
                $id = $this->uri->segment(3);
                $data['direktur'] = $this->model_formulir->get_direktur();
                $data['record'] = $this->model_formulir->get_one_yys($id)->row_array();

                $this->load->view('formulir/form_edit_yayasan', $data);
            }
        } else {
            redirect(base_url('index.php/welcome'));
        }
    }
    
    function check(){
        if ($this->session->userdata("status")=="login"){
            $id = $this->uri->segment(3);
            $tes = $this->model_formulir->get_one($id)->num_rows();
            if ($tes > 0){
                $data['record'] = $this->model_formulir->get_one($id)->row_array();
                $this->load->view('formulir/form_check', $data);
            }else{
                $data['record'] = $this->model_formulir->get_one_yys($id)->row_array();
            
                $this->load->view('formulir/form_check_yayasan', $data);
            }
          //  $data['record'] = $this->model_formulir->get_one($id)->row_array();
            //$this->load->view('formulir/form_check', $data);
            
        } else {
            redirect(base_url('index.php/welcome'));
        }
        
    }
    
    function check_yys(){
        if ($this->session->userdata("status")=="login"){
            $id = $this->uri->segment(3);
            $data['record'] = $this->model_formulir->get_one_yys($id)->row_array();
            
                $this->load->view('formulir/form_check_yayasan', $data);
           
            
        } else {
            redirect(base_url('index.php/welcome'));
        }
        
    }
    function check_direktur(){
        if ($this->session->userdata("status")=="login"){
            $id = $this->uri->segment(3);
            $data['record'] = $this->model_formulir->get_one_direktur($id)->row_array();
           
                $this->load->view('formulir/form_check_direktur', $data);
          
            
        } else {
            redirect(base_url('index.php/welcome'));
        }
        
    }
    
    function delete(){
        if ($this->session->userdata("status")=="login"){
            $id = $this->uri->segment(3);
            $this->model_formulir->delete($id);
             $this->session->set_flashdata('hapus', 'Data Berhasil Dihapus');
            redirect('formulir/view');
        } else {
            redirect(base_url('index.php/welcome'));
        }
    }
    function delete_yys(){
        if ($this->session->userdata("status")=="login"){
            $id = $this->uri->segment(3);
            $this->model_formulir->delete_yys($id);
             $this->session->set_flashdata('hapus', 'Data Berhasil Dihapus');
            redirect('formulir/view_yayasan');
        } else {
            redirect(base_url('index.php/welcome'));
        }
    }
    function delete_direktur(){
        if ($this->session->userdata("status")=="login"){
            $id = $this->uri->segment(3);
            $this->model_formulir->delete_direktur($id);
             $this->session->set_flashdata('hapus', 'Data Berhasil Dihapus');
            redirect('formulir/list_direktur');
        } else {
            redirect(base_url('index.php/welcome'));
        }
    }

    public function proses_domisili(){

         if ($this->session->userdata("status")=="login"){
            $id = $this->uri->segment(3);
            $tes = $this->model_formulir->get_one($id)->num_rows();
            if($tes>0){

                $this->model_formulir->proses_domisili($id);
                $input = array(
                    'id_user' => $this->session->userdata('id_user'),
                    'status' => "Proses Domisili Usaha",
                    'dokumen' => $id,
                    'tgl_input' => date('Y-m-d')
                );
                $this->model_formulir->verified_monitoring($input);
                $data['record'] = $this->model_formulir->view_staff_progress();
              //print_r($data);exit();
              redirect(base_url('index.php/formulir/view_proses'));
     
            } else {
                $this->model_formulir->proses_domisili_yys($id);
                $input = array(
                    'id_user' => $this->session->userdata('id_user'),
                    'status' => "Proses Domisili Usaha",
                    'dokumen' => $id,
                    'tgl_input' => date('Y-m-d')
                );
                $this->model_formulir->verified_monitoring($input);
                $data['record'] = $this->model_formulir->view_staff_progress();
              //print_r($data);exit();
              redirect(base_url('index.php/formulir/view_proses'));
     
            }
        } else {
            redirect(base_url('index.php/welcome'));
        }

    }

    public function ttd_akta(){

         if ($this->session->userdata("status")=="login"){
            $id = $this->uri->segment(3);
            $tes = $this->model_formulir->get_one($id)->num_rows();
            if($tes>0){
                $input = array(
                    'id_user' => $this->session->userdata('id_user'),
                    'status' => "Tanda Tangan Akta",
                    'dokumen' => $id,
                    'tgl_input' => date('Y-m-d')
                );
                $this->model_formulir->verified_monitoring($input);
                $this->model_formulir->ttd_akta($id);
                //$data['record'] = $this->model_formulir->view_notaris();
                $data['record'] = $this->model_formulir->view_staff_progress();
              //print_r($data);exit();
              redirect(base_url('index.php/formulir/view_proses'));
              //$this->load->view('staff/list_formulir_proses', $data);
            }else {
                $this->model_formulir->ttd_akta_yys($id);
                $input = array(
                    'id_user' => $this->session->userdata('id_user'),
                    'status' => "Tanda Tangan Akta",
                    'dokumen' => $id,
                    'tgl_input' => date('Y-m-d')
                );
                $this->model_formulir->verified_monitoring($input);
              //  $data['record'] = $this->model_formulir->view_notaris();
              $data['record'] = $this->model_formulir->view_staff_progress();
           
              //print_r($data);exit();
              redirect(base_url('index.php/formulir/view_proses'));
              //$this->load->view('staff/list_formulir_proses', $data);
            
           
            }
       
        } else {
            redirect(base_url('index.php/welcome'));
        }

    }

    public function proses_npwp(){

         if ($this->session->userdata("status")=="login"){
            $id = $this->uri->segment(3);
            $tes = $this->model_formulir->get_one($id)->num_rows();
            if($tes>0){
                $this->model_formulir->proses_npwp($id);
                $input = array(
                    'id_user' => $this->session->userdata('id_user'),
                    'status' => "Proses Pembuatan NPWP",
                    'dokumen' => $id,
                    'tgl_input' => date('Y-m-d')
                );
                $this->model_formulir->verified_monitoring($input);
               
                $data['record'] = $this->model_formulir->view_staff_progress();
              //print_r($data);exit();
              redirect(base_url('index.php/formulir/view_proses'));
            }else {
                $this->model_formulir->proses_npwp_yys($id);
                $input = array(
                    'id_user' => $this->session->userdata('id_user'),
                    'status' => "Proses Pembuatan NPWP",
                    'dokumen' => $id,
                    'tgl_input' => date('Y-m-d')
                );
                $this->model_formulir->verified_monitoring($input);
                $data['record'] = $this->model_formulir->view_staff_progress();
              //print_r($data);exit();
              redirect(base_url('index.php/formulir/view_proses'));
            }

        
        } else {
            redirect(base_url('index.php/welcome'));
        }

    }

    public function proses_siup(){

         if ($this->session->userdata("status")=="login"){
            $id = $this->uri->segment(3);
            $tes = $this->model_formulir->get_one($id)->num_rows();
            if($tes>0){
                $this->model_formulir->proses_siup($id);
                $input = array(
                    'id_user' => $this->session->userdata('id_user'),
                    'status' => "Proses SIUP TDP",
                    'dokumen' => $id,
                    'tgl_input' => date('Y-m-d')
                );
                $this->model_formulir->verified_monitoring($input);
                $data['record'] = $this->model_formulir->view_staff_progress();
              //print_r($data);exit();
              redirect(base_url('index.php/formulir/view_proses'));
          
            } else {
                $this->model_formulir->proses_siup_yys($id);
                $input = array(
                    'id_user' => $this->session->userdata('id_user'),
                    'status' => "Proses SIUP TDP",
                    'dokumen' => $id,
                    'tgl_input' => date('Y-m-d')
                );
                $this->model_formulir->verified_monitoring($input);
                $data['record'] = $this->model_formulir->view_staff_progress();
              //print_r($data);exit();
              redirect(base_url('index.php/formulir/view_proses'));
          
            }
           } else {
            redirect(base_url('index.php/welcome'));
        }

    }

      public function selesai(){

         if ($this->session->userdata("status")=="login"){
            $id = $this->uri->segment(3);
            $tes = $this->model_formulir->get_one($id)->num_rows();
            if($tes>0){
                $this->model_formulir->selesai($id);
                $input = array(
                    'id_user' => $this->session->userdata('id_user'),
                    'status' => "Selesai",
                    'dokumen' => $id,
                    'tgl_input' => date('Y-m-d')
                );
                $this->model_formulir->verified_monitoring($input);
                $data['record'] = $this->model_formulir->view_staff_progress();
              //print_r($data);exit();
              redirect(base_url('index.php/formulir/view_proses'));
        
            } else {
                $this->model_formulir->selesai_yys($id);
                $input = array(
                    'id_user' => $this->session->userdata('id_user'),
                    'status' => "Selesai",
                    'dokumen' => $id,
                    'tgl_input' => date('Y-m-d')
                );
                $this->model_formulir->verified_monitoring($input);
                $data['record'] = $this->model_formulir->view_staff_progress();
              //print_r($data);exit();
              redirect(base_url('index.php/formulir/view_proses'));
        
            }
        } else {
            redirect(base_url('index.php/welcome'));
        }


    }
    public function monitoring(){
        $id = $this->uri->segment(3);
                $data['record'] = $this->model_sertifikat->view_history_sertifikat($id);
                $this->load->view('formulir/histori_berkas',$data);
            }
    
}