<?php

class model_formulir extends CI_Model{
    
    
    function save($data){
        
            $this->db->insert('perusahaan', $data);
    }
    function save_yayasan($data){
        
            $this->db->insert('yayasan', $data);
    }
    function save_direktur($data){
        
            $this->db->insert('pimpinan', $data);
    }

    function get_no_formulir(){
        $q = $this->db->query("SELECT MAX(RIGHT(id_formulir,4)) AS kd_max FROM perusahaan WHERE DATE(tgl_input) = CURDATE()");
        $kd = "";
        $ser= "IDFOR";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->kd_max)+1;
                $kd = sprintf("%04s", $tmp);
            }
        }else{
            $kd = "0001";
        }
        date_default_timezone_set('Asia/Jakarta');
        return $ser.date('dmy').$kd;
    }
    function get_no_formulir_yys(){
        $q = $this->db->query("SELECT MAX(RIGHT(id_formulir,4)) AS kd_max FROM yayasan WHERE DATE(tgl_input) = CURDATE()");
        $kd = "";
        $ser= "IDYYS";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->kd_max)+1;
                $kd = sprintf("%04s", $tmp);
            }
        }else{
            $kd = "0001";
        }
        date_default_timezone_set('Asia/Jakarta');
        return $ser.date('dmy').$kd;
    }
    function get_id_direktur(){
        $q = $this->db->query("SELECT MAX(RIGHT(id_pimpinan,4)) AS kd_max FROM pimpinan WHERE DATE(tgl_input) = CURDATE()");
        $kd = "";
        $ser= "DIRID";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->kd_max)+1;
                $kd = sprintf("%04s", $tmp);
            }
        }else{
            $kd = "0001";
        }
        date_default_timezone_set('Asia/Jakarta');
        return $ser.date('dmy').$kd;
    }

    function get_direktur(){
        $id = $this->session->userdata("id_user");
        $query = ("SELECT * FROM pimpinan where id_user = '$id'");
        return $this->db->query($query)->result();
    }

    
    function view($id){
        $query = "
        SELECT * from 
            perusahaan 
                JOIN user 
                    ON perusahaan.id_user = user.id_user 
                join pimpinan 
                    on perusahaan.id_direktur = pimpinan.id_pimpinan 
                WHERE perusahaan.id_user = '$id' ";
        return $this->db->query($query);
    }

    function view_yayasan($id){
        $query = "SELECT * from yayasan as a JOIN user as b ON a.id_user = b.id_user join pimpinan as c on a.id_pejabat = c.id_pimpinan WHERE a.id_user = '$id'";
        return $this->db->query($query);
    }
    function view_list_direktur($id){
        $query = "SELECT * from pimpinan JOIN user ON pimpinan.id_user = user.id_user WHERE pimpinan.id_user = '$id' ";
        return $this->db->query($query);
    }

    function verifikasi($id){
        $query = "UPDATE perusahaan SET status_berkas = 'Verified Admin' where id_formulir ='$id'";
         return $this->db->query($query);
    }
    function verified_monitoring($input){
        $this->db->insert('monitoring', $input);
    }

    function verifikasi_yys($id){
        $query = "UPDATE yayasan SET status_berkas = 'Verified Admin' where id_formulir ='$id'";
         return $this->db->query($query);
    }

    function ttd_akta($id){
        $query = "UPDATE perusahaan SET status_berkas = 'Tanda Tangan Notaris' where id_formulir ='$id'";
         return $this->db->query($query);
    }
    function ttd_akta_yys($id){
        $query = "UPDATE yayasan SET status_berkas = 'Tanda Tangan Notaris' where id_formulir ='$id'";
         return $this->db->query($query);
    }

     function proses_domisili($id){
        $query = "UPDATE perusahaan SET status_berkas = 'Proses Surat Keterangan Domisili' where id_formulir ='$id'";
         return $this->db->query($query);
    }
     function proses_domisili_yys($id){
        $query = "UPDATE yayasan SET status_berkas = 'Proses Surat Keterangan Domisili' where id_formulir ='$id'";
         return $this->db->query($query);
    }

     function proses_npwp($id){
        $query = "UPDATE perusahaan SET status_berkas = 'Proses Pembuatan NPWP' where id_formulir ='$id'";
         return $this->db->query($query);
    }
     function proses_npwp_yys($id){
        $query = "UPDATE yayasan SET status_berkas = 'Proses Pembuatan NPWP' where id_formulir ='$id'";
         return $this->db->query($query);
    }

    function proses_siup($id){
        $query = "UPDATE perusahaan SET status_berkas = 'Proses SIUP/TDP' where id_formulir ='$id'";
         return $this->db->query($query);
    }
    function proses_siup_yys($id){
        $query = "UPDATE yayasan SET status_berkas = 'Proses SIUP/TDP' where id_formulir ='$id'";
         return $this->db->query($query);
    }

    function selesai($id){
        $query = "UPDATE perusahaan SET status_berkas = 'Selesai' where id_formulir ='$id'";
         return $this->db->query($query);
    }
    function selesai_yys($id){
        $query = "UPDATE yayasan SET status_berkas = 'Selesai' where id_formulir ='$id'";
         return $this->db->query($query);
    }

   /* function view_staff(){
        $query = "SELECT * from perusahaan JOIN user ON perusahaan.id_user = user.id_user join direktur_pp as c on perusahaan.id_direktur = c.id_direktur WHERE perusahaan.status_berkas = 'Submit'";
        return $this->db->query($query);
    } */

    function view_staff(){
        $query = "
        SELECT 
                id_formulir as no_formulir,
                nama, 
                nama_pimpinan,
                nama_perusahaan,
                bidang_usaha,
                modal_dasar,
                no_telp_perusahaan,
                status_berkas
        from perusahaan 
            JOIN user 
                ON perusahaan.id_user = user.id_user 
            join pimpinan as c 
                on perusahaan.id_direktur = c.id_pimpinan 
        WHERE perusahaan.status_berkas = 'Submit'
        UNION
        SELECT 
                id_formulir as no_formulir,
                nama,
                nama_pimpinan,
                nama_yayasan as nama_perusahaan,
                yayasan as bidang_usaha,
                kekayaan_awal as modal_dasar,
                no_telp_yayasan as no_telp_perusahaan,
                status_berkas
        from yayasan 
            JOIN user 
                ON yayasan.id_user = user.id_user 
            join pimpinan as c 
                on yayasan.id_pejabat = c.id_pimpinan 
        WHERE yayasan.status_berkas = 'Submit'
        ";
        return $this->db->query($query);
    }

     function view_notaris(){
        $query = "
        SELECT 
        id_formulir ,
        nama, 
        nama_pimpinan,
        nama_perusahaan,
        bidang_usaha,
        modal_dasar,
        penanggung_jawab,
        no_telp_perusahaan,
        status_berkas
from perusahaan 
    JOIN user 
        ON perusahaan.id_user = user.id_user 
    join pimpinan as c 
        on perusahaan.id_direktur = c.id_pimpinan 
WHERE perusahaan.status_berkas = 'Verified Admin'
UNION
SELECT 
        id_formulir ,
        nama,
        nama_pimpinan,
        nama_yayasan as nama_perusahaan,
        yayasan as bidang_usaha,
        kekayaan_awal as modal_dasar,
        pembina as penanggung_jawab,
        no_telp_yayasan as no_telp_perusahaan,
        status_berkas
from yayasan 
    JOIN user 
        ON yayasan.id_user = user.id_user 
    join pimpinan as c 
        on yayasan.id_pejabat = c.id_pimpinan 
WHERE yayasan.status_berkas = 'Verified Admin'
";
        return $this->db->query($query);
    }

    function view_staff_progress(){
        $query = "
        SELECT 
        id_formulir,
        nama, 
        nama_pimpinan,
        nama_perusahaan,
        bidang_usaha,
        modal_dasar,
        no_telp_perusahaan,
        penanggung_jawab,
        status_berkas
from perusahaan 
    JOIN user 
        ON perusahaan.id_user = user.id_user 
    join pimpinan as c 
        on perusahaan.id_direktur = c.id_pimpinan 
WHERE perusahaan.status_berkas != 'Submit'
UNION
SELECT 
        id_formulir,
        nama,
        nama_pimpinan,
        nama_yayasan as nama_perusahaan,
        yayasan as bidang_usaha,
        kekayaan_awal as modal_dasar,
        no_telp_yayasan as no_telp_perusahaan,
        pembina as penanggung_jawab,
        status_berkas
from yayasan 
    JOIN user 
        ON yayasan.id_user = user.id_user 
    join pimpinan as c 
        on yayasan.id_pejabat = c.id_pimpinan 
WHERE yayasan.status_berkas != 'Submit'
        ";
        return $this->db->query($query);
    }
    
    function get_one($id){
        $queryasal = "SELECT * from perusahaan as a join pimpinan as b on a.id_direktur = b.id_pimpinan  where id_formulir ='".$id."'";
       
         $hasil = $this->db->query($queryasal);
          //  $aa = $hasil->num_rows();
            //print_r($aa);exit();
      //   if ($aa > 0 ){
             return $hasil;
        // }else{
          //  $query = "SELECT * from yayasan as a join direktur_pp as b on a.id_pejabat = b.id_direktur where id_formulir ='".$id."'";
            //return $this->db->query($query);
       // }
    }
    function get_one_yys($id){
        $query = "SELECT * from yayasan as a join pimpinan as b on a.id_pejabat = b.id_pimpinan where id_formulir ='".$id."'";
        return $this->db->query($query);
    }
    function get_one_direktur($id){
        $id_user = $this->session->userdata("id_user");
        $query = "SELECT * from pimpinan where id_pimpinan ='".$id."' and id_user = '$id_user'";
        return $this->db->query($query);
    }
    
    function edit($data){
        
        $this->db->where('id_formulir', $this->input->post('no_formulir'));
        $this->db->update('perusahaan', $data);
    }
    function edit_yys($data){
        
        $this->db->where('id_formulir', $this->input->post('no_formulir'));
        $this->db->update('yayasan', $data);
    }
    function edit_direktur($data){
        
        $this->db->where('id_pimpinan', $this->input->post('id_direktur'));
        $this->db->update('pimpinan', $data);
    }
    
    function delete($id){
        $this->db->where('id_formulir', $id);
        $this->db->delete('perusahaan');
    }
    function delete_yys($id){
        $this->db->where('id_formulir', $id);
        $this->db->delete('yayasan');
    }
    function delete_direktur($id){
        $this->db->where('id_pimpinan', $id);
        $this->db->delete('pimpinan');
    }
}

