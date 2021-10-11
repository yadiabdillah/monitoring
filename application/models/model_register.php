<?php

class model_register extends CI_Model{
    
    
    function save($data){
        
            $this->db->insert('user', $data);
    }

    
}

