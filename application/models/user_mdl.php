<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_mdl extends CI_Model {
        
    function __construct() {
        parent::__construct();
    }
    
    function checklogin($username, $password)
    {
        $data['valid'] = false;
        $this->db->where('user_login', $username);
        $this->db->where('user_password', md5($password));        
        $query = $this->db->get('user');
        if ($query->num_rows()==1){
            $row = $query->row();
            $data = array(
                'valid'                   => true,
                'user_id'               => $row->user_id,                
                'username'           => $row->user_login,
                'nama_lengkap'     => $row->user_name,
                'user_group_id'     => $row->user_group_id,                
            );
            $iduser = $row->user_id;
            // update last login
            $this->db->set('last_login', date('Y-m-d H:i:s'));
            $this->db->where('user_id', $iduser);
            $this->db->update('user');
        }
        return $data;
    }        
}    