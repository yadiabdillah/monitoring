<?php 
 
class M_login extends CI_Model{	
	function cek_login($table,$where){		
		return $this->db->get_where($table,$where);
	}	
        function get_one($id){
        $query = "SELECT * from user where username ='".$id."'";
        return $this->db->query($query);
    }
}

