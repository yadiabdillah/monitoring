<?php

class Model_payment extends CI_Model{
    
    
    function save($data){
            $this->db->insert('payment', $data);
    }

    function save_dp($data){
            $this->db->insert('payment', $data);
    }
    
    function view_sertifikat(){
        $query = "SELECT * from invoice right join sertifikat on   invoice.id_sertifikat  = sertifikat.id_sertifikat join penjual_sertifikat as c on sertifikat.id_penjual = c.id_penjual where 
        invoice.id_invoice is not null and id_jenis = 1";
        return $this->db->query($query);
    }

    function view_formulir(){
        $query ="SELECT id_invoice,no_invoice,perusahaan,nama_pimpinan,tgl_invoice,status_bayar,total_biaya from invoice right join perusahaan on   invoice.id_sertifikat  = perusahaan.id_formulir 
        join pimpinan as c on perusahaan.id_direktur = c.id_pimpinan where 
        invoice.id_invoice is not null and id_jenis = 2
        union 
        SELECT id_invoice,no_invoice,nama_yayasan as perusahaan,nama_pimpinan,tgl_invoice,status_bayar,total_biaya from invoice right join yayasan on   invoice.id_sertifikat  = yayasan.id_formulir 
        join pimpinan as c on yayasan.id_pejabat = c.id_pimpinan where 
        invoice.id_invoice is not null and id_jenis = 2";
       /* $query = "SELECT * from invoice right join perusahaan on   invoice.id_sertifikat  = perusahaan.id_formulir 
        join pimpinan as c on perusahaan.id_direktur = c.id_direktur where 
        invoice.id_invoice is not null and id_jenis = 2 ";*/
        return $this->db->query($query);
    }

    function view_detail_transaksi($id){
         
        $query = "SELECT * FROM `invoice`  JOIN `payment` ON invoice.id_invoice = payment.id_invoice WHERE invoice.id_invoice = '$id'";
        return $this->db->query($query);
    }
    
    function get_one($id){
        $query = "SELECT * from sertifikat where id_sertifikat =".$id;
        return $this->db->query($query);
    }

    function get_one_formulir($id){
        $query = "SELECT * from perusahaan where no_formulir =".$id;
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
        $this->db->where('no_formulir', $this->input->post('no_formulir'));
        $this->db->update('perusahaan', $data);
    }
    
    function delete($id){
        $this->db->where('no_formulir', $id);
        $this->db->delete('formulir');
    }
    
    function save_payment($data_payment){
            $this->db->insert('payment', $data_payment);
    }
    
    function update_status($id){
        $data_status  = array('status_bayar' => 'Bayar DP');
        $this->db->where('id_invoice', $id);
        $this->db->update('invoice', $data_status);
    }

     function update_status_uploaddp($id_invoice){
        $data_status  = array('status_bayar' => 'Menunggu Konfirmasi Finance');
        $this->db->where('id_invoice', $id_invoice);
        $this->db->update('invoice', $data_status);
    }
    
    function update_status_lunas($id){
        $data_status  = array('status_bayar' => 'Bayar lunas');
        $this->db->where('id_invoice', $id);
        $this->db->update('invoice', $data_status);
    }
}

