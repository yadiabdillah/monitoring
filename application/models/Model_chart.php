<?php 
 
class Model_chart extends CI_Model{	

	public function jumlah_balik_nama()
	{
		$query = ("SELECT * FROM sertifikat");
		return $this->db->query($query);
	}

	public function jumlah_pendirian_bdn()
	{
		$query = ("SELECT * FROM perusahaan");
		return $this->db->query($query)->num_rows();
	}

	public function jumlah_pendirian_yayasan()
	{
		$query = ("SELECT * FROM yayasan");
		return $this->db->query($query)->num_rows();
	}

	public function jumlah_pendirian_bdn_bln_ini($bln,$thn)
	{
		$query = ("SELECT * FROM perusahaan WHERE  MONTH(tgl_input)='$bln' AND YEAR(tgl_input)='$thn'");
		return $this->db->query($query);
	}

	public function jumlah_pendirian_yayasan_bln_ini($bln,$thn)
	{
		$query = ("SELECT * FROM yayasan WHERE  MONTH(tgl_input)='$bln' AND YEAR(tgl_input)='$thn'");
		return $this->db->query($query);
	}

	public function jumlah_baliknama_bln_ini($bln,$thn)
	{
		$query = ("SELECT * FROM sertifikat WHERE MONTH(tgl_input)='$bln' AND YEAR(tgl_input)='$thn'");
		return $this->db->query($query);
	}

	public function view_baliknama($bln){
		 $query = "SELECT * from sertifikat JOIN user ON sertifikat.id_user = user.id_user join penjual_sertifikat as c on sertifikat.id_penjual = c.id_penjual WHERE MONTH(tgl_input)='$bln' ";
        return $this->db->query($query);
	}
	public function cari_baliknama($tgl_awal,$tgl_akhir){
		 $query = "SELECT * from sertifikat JOIN user  ON sertifikat.id_user = user.id_user join penjual_sertifikat as c on sertifikat.id_penjual = c.id_penjual WHERE tgl_input BETWEEN '$tgl_awal' AND '$tgl_akhir'  ";
        return $this->db->query($query);
	}

	public function view_yayasan($bln){
		 $query = "SELECT * from yayasan JOIN user ON yayasan.id_user = user.id_user join pimpinan as c on yayasan.id_pejabat = c.id_pimpinan WHERE MONTH(yayasan.tgl_input)='$bln' 
		  ";
        return $this->db->query($query);
	}
	public function cari_yayasan($tgl_awal,$tgl_akhir){
		 $query = "SELECT * from perusahaan JOIN user ON perusahaan.id_user = user.id_user WHERE tgl_input BETWEEN '$tgl_awal' AND '$tgl_akhir' 
		 AND tipe_form = 'Yayasan' ";
        return $this->db->query($query);
	}

	public function view_pt($bln){
		 $query = "SELECT * from perusahaan JOIN user ON perusahaan.id_user = user.id_user join pimpinan as c on perusahaan.id_direktur = c.id_pimpinan WHERE MONTH(perusahaan.tgl_input)='$bln'
		  ";
        return $this->db->query($query);
	}
	public function cari_pt($tgl_awal,$tgl_akhir){
		 $query = "SELECT * from perusahaan JOIN user ON perusahaan.id_user = user.id_user join pimpinan as c on perusahaan.id_direktur = c.id_pimpinan WHERE perusahaan.tgl_input BETWEEN '$tgl_awal' AND '$tgl_akhir' 
		 ";
        return $this->db->query($query);
	}

	
	
}

