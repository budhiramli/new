<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_group_mdl extends CI_Model {
        
    function __construct() {
        parent::__construct();
    }
    
    function getrecordcount()
    {
            $data = $this->db->count_all_results('user_group');
            return $data;
    }
        
    function getdatalist()
    {
        $this->db->order_by('group_name asc');
        $query = $this->db->get('user_group');
        $nomor = 1;
        foreach($query->result() as $row):
            $data[] = array(
                'nomor'             => $nomor,
                'user_group_id'     => $row->user_group_id,
                'group_name'     => $row->group_name,
            ); 
            $nomor++;
        endforeach;
        return $data;
    }
}    