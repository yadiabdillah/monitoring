<?php
class m_profile extends CI_Model{
 
    function get_one($id){
        $query = "SELECT * from user where username ='".$id."'";
        return $this->db->query($query);
    }
    
    function edit($id){
        $data = array('password'=> md5($this->input->post('password')));
        $this->db->where('username', $id);
        $this->db->update('user', $data);
    }
}