<?php

class model_user extends CI_Model{
    
    
    function save($data){
            $this->db->insert('user', $data);
    }
    
    function view(){
        $query = "SELECT * from user";
        return $this->db->query($query);
    }
    
    function get_one($id){
        $query = "SELECT * from user where id_user ='$id'";
        return $this->db->query($query);
    }
    
    function edit(){
        $data = array(
                    'username'=> $this->input->post('username'), 
                    'nama'=> $this->input->post('nama'),
                    'email'=> $this->input->post('email'),
                    'no_telp'=> $this->input->post('telp'),
                    'jabatan'=> $this->input->post('jabatan')
                );
        $this->db->where('id_user', $this->input->post('id_user'));
        $this->db->update('user', $data);
    }

    function delete($id){
        $this->db->where('id_user', $id);
        $this->db->delete('user');
    }
}

