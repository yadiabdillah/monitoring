<?php

class model_sertifikat extends CI_Model{
    
    
    function save($data){
        
            $this->db->insert('sertifikat', $data);
    }
    function save_penjual($data){
        
            $this->db->insert('penjual_sertifikat', $data);
    }
    function save_pembeli($data){
        
            $this->db->insert('pembeli_sertifikat', $data);
    }

    function get_penjual($id){
        $query = ("SELECT * from penjual_sertifikat where id_user = '$id'");
        return $this->db->query($query)->result();
    }
    function get_pembeli($id){
        $query = ("SELECT * from pembeli_sertifikat where id_user = '$id'");
        return $this->db->query($query)->result();
    }
    
    function view($id){
        $query = "SELECT * from sertifikat JOIN user ON sertifikat.id_user = user.id_user join penjual_sertifikat on sertifikat.id_penjual = penjual_sertifikat.id_penjual WHERE sertifikat.id_user = '$id'";
        return $this->db->query($query);
    }

    function view_staff(){
        $query = "SELECT * from sertifikat as a JOIN user as b ON a.id_user = b.id_user
        join penjual_sertifikat as c on a.id_penjual = c.id_penjual
         WHERE a.status_berkas = 'Submit'";
        return $this->db->query($query);
    }
    function view_notaris(){
        $query = "SELECT * from sertifikat JOIN user ON sertifikat.id_user = user.id_user WHERE sertifikat.status_berkas = 'Verified Admin'";
        return $this->db->query($query);
    }
    function view_list_penjual(){
        $query = "SELECT * from penjual_sertifikat";
        return $this->db->query($query);
    }
    function view_history_sertifikat($id){
        $query = "SELECT * from monitoring as a join user as b on a.id_user = b.id_user where a.dokumen='$id'";
        return $this->db->query($query);
    }
    function view_list_pembeli(){
        $query = "SELECT * from pembeli_sertifikat";
        return $this->db->query($query);
    }
    function view_staff_progress(){
        $query = "SELECT * from sertifikat JOIN user ON sertifikat.id_user = user.id_user join penjual_sertifikat as c on sertifikat.id_penjual = c.id_penjual WHERE sertifikat.status_berkas != 'Submit'";
        return $this->db->query($query);
    }
    
    function get_one($id){
        $query = "SELECT * from sertifikat as a join penjual_sertifikat as b on a.id_penjual = b.id_penjual join pembeli_sertifikat as c on a.id_pembeli = c.id_pembeli  where id_sertifikat ='$id'";
        return $this->db->query($query);
    }
    function get_one_penjual($id){
        $query = "SELECT * from penjual_sertifikat where id_penjual ='$id'";
        return $this->db->query($query);
    }
    function get_one_pembeli($id){
        $query = "SELECT * from pembeli_sertifikat where id_pembeli ='$id'";
        return $this->db->query($query);
    }

    function verifikasi($id){
        $query = "UPDATE sertifikat SET status_berkas = 'Verified Admin' where id_sertifikat ='$id'";
         return $this->db->query($query);
    }

     function ttd_akta($id){
        $query = "UPDATE sertifikat SET status_berkas = 'Tanda Tangan Notaris' where id_sertifikat ='$id'";
         return $this->db->query($query);
    }

    function verifikasi_pajak($id){
        $query = "UPDATE sertifikat SET status_berkas = 'Validasi Pajak' where id_sertifikat ='$id'";
         return $this->db->query($query);
    }

    function balik_nama($id){
        $query = "UPDATE sertifikat SET status_berkas = 'Proses Balik Nama' where id_sertifikat ='$id'";
         return $this->db->query($query);
    }

    function selesai($id){
        $query = "UPDATE sertifikat SET status_berkas = 'Selesai' where id_sertifikat ='$id'";
         return $this->db->query($query);
    }

    function get_id_sertifikat(){
        $q = $this->db->query("SELECT MAX(RIGHT(id_sertifikat,4)) AS kd_max FROM sertifikat WHERE DATE(tgl_input) = CURDATE()");
        $kd = "";
        $ser= "IDSER";
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
    function get_id_penjual(){
        $q = $this->db->query("SELECT MAX(RIGHT(id_penjual,4)) AS kd_max FROM penjual_sertifikat");
        $kd = "";
        $ser= "IDPNJL";
        if($q->num_rows()>0){
            //print_r($q->num_rows());exit();
            foreach($q->result() as $k){
                $tmp = ((int)$k->kd_max)+1;
                $kd = sprintf("%04s", $tmp);
               // print_r($k->kd_max);exit();
            }
        }else{
            $kd = "0001";
        }
        date_default_timezone_set('Asia/Jakarta');
        return $ser.date('dmy').$kd;
    }
    
    function edit($data){
        $this->db->where('id_sertifikat', $this->input->post('id_sertifikat'));
        $this->db->update('sertifikat', $data);
    }
    function edit_penjual($data){
        $this->db->where('id_penjual', $this->input->post('id_penjual'));
        $this->db->update('penjual_sertifikat', $data);
    }
    function edit_pembeli($data){
        $this->db->where('id_pembeli', $this->input->post('id_pembeli'));
        $this->db->update('pembeli_sertifikat', $data);
    }
    
    function delete($id){
        $this->db->where('id_sertifikat', $id);
        $this->db->delete('sertifikat');
    }
    function delete_penjual($id){
        $this->db->where('id_penjual', $id);
        $this->db->delete('penjual_sertifikat');
    }
    function delete_pembeli($id){
        $this->db->where('id_pembeli', $id);
        $this->db->delete('pembeli_sertifikat');
    }
}

