<?php

class Model_invoice extends CI_Model{
    
    
    function save($data){
            $this->db->insert('invoice', $data);
    }
    
    function view_sertifikat(){
        $query = "SELECT * from invoice as a right join sertifikat as b on   a.id_sertifikat  = b.id_sertifikat
        join penjual_sertifikat as c on b.id_penjual = c.id_penjual where 
        a.id_invoice is null";
        return $this->db->query($query);
    }

     function view_sertifikat_user($id){
        $query = "SELECT * from invoice right join sertifikat on   invoice.id_sertifikat  = sertifikat.id_sertifikat
         join penjual_sertifikat as c on sertifikat.id_penjual = c.id_penjual where 
        invoice.id_invoice is not null AND invoice.id_user = '$id' AND id_jenis=1";
        return $this->db->query($query);
    }

    function view_formulir(){
        $query = "SELECT id_formulir,nama_pimpinan,penanggung_jawab,nama_perusahaan,bidang_usaha,modal_dasar,perusahaan.id_user from invoice right join perusahaan on   invoice.id_sertifikat  = perusahaan.id_formulir
        join pimpinan on perusahaan.id_direktur = pimpinan.id_pimpinan where 
        invoice.id_invoice is null
        union
        SELECT id_formulir,nama_pimpinan,nama_yayasan as nama_perusahaan,pembina as penanggung_jawab,yayasan as bidang_usaha,kekayaan_awal as modal_dasar,yayasan.id_user from invoice right join yayasan on   invoice.id_sertifikat  = yayasan.id_formulir
        join pimpinan on yayasan.id_pejabat = pimpinan.id_pimpinan where 
        invoice.id_invoice is null ";
        //$query = "SELECT * from invoice right join perusahaan on   invoice.id_sertifikat  = perusahaan.id_formulir
       // join pimpinan on perusahaan.id_pimpinan = pimpinan.id_pimpinan where 
        //invoice.id_invoice is null ";
        return $this->db->query($query);
    }

    function view_formulir_user($id){
        $query ="SELECT id_invoice,no_invoice,nama_pimpinan,penanggung_jawab,nama_perusahaan,bidang_usaha,modal_dasar,total_biaya,status_bayar
        from invoice right join perusahaan on   invoice.id_sertifikat  = perusahaan.id_formulir 
         join pimpinan on perusahaan.id_direktur = pimpinan.id_pimpinan where 
        invoice.id_invoice is not null AND invoice.id_user = '$id' AND id_jenis=2 
        union 
        SELECT id_invoice,no_invoice,nama_pimpinan,pembina as penanggung_jawab,nama_yayasan as nama_perusahaan,yayasan as bidang_usaha,kekayaan_awal as modal_dasar,total_biaya,status_bayar
        from invoice right join yayasan on   invoice.id_sertifikat  = yayasan.id_formulir 
         join pimpinan on yayasan.id_pejabat = pimpinan.id_pimpinan where 
        invoice.id_invoice is not null AND invoice.id_user = '$id' AND id_jenis=2 ";
       /* $query = "SELECT * from invoice right join perusahaan on   invoice.id_sertifikat  = perusahaan.id_formulir 
         join pimpinan on perusahaan.id_pimpinan = pimpinan.id_pimpinan where 
        invoice.id_invoice is not null AND invoice.id_user = '$id' AND id_jenis=2  ";*/
        return $this->db->query($query);
    }

    function get_one($id){
        $query = "SELECT * from sertifikat join penjual_sertifikat on sertifikat.id_penjual = penjual_sertifikat.id_penjual where id_sertifikat ='$id' ";
        return $this->db->query($query);
    }

     function get_one_invoice($id){
        $query = "SELECT * from invoice where id_invoice ='$id'";
        return $this->db->query($query);
    }

    function get_one_formulir($id){
        $query = "SELECT * from perusahaan as a join pimpinan as b on a.id_direktur = b.id_pimpinan   where id_formulir ='$id'";
        return $this->db->query($query);
    }
    function get_one_formulir_yys($id){
        $query = "SELECT *, a.nama_yayasan as perusahaan from yayasan as a join pimpinan as b on a.id_pejabat = b.id_pimpinan where id_formulir ='$id'";
        return $this->db->query($query);
    }
    
    function edit(){
        $data = array(
                'nama_pimpinan'=> $this->input->post('nama_direktur'),
                'penanggung_jwb'=> $this->input->post('penanggung_jwb'),
                'tmp_lahir'=> $this->input->post('tmp_lahir'),
                'tgl_lahir'=> $this->input->post('tgl_lahir'),
                'alamat'=> $this->input->post('alamat'),
                'pekerjaan'=> $this->input->post('pekerjaan'),
                'nik'=> $this->input->post('nik'),
                'npwp'=> $this->input->post('npwp'),
                'kewarganegaraan'=> $this->input->post('kewarganegaraan'),
                'no_telp_direktur'=> $this->input->post('no_telp_direktur'),
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
        $this->db->where('id_formulir', $this->input->post('no_formulir'));
        $this->db->update('perusahaan', $data);
    }
    
    function delete($id){
        $this->db->where('id_formulir', $id);
        $this->db->delete('formulir');
    }
}

