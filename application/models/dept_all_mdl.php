<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class dept_all_mdl extends CI_Model {
    function __construct() {
        parent::__construct();        
    }
    
    function getrecordcount()
    {
            $data = $this->db->count_all_results('mst_dept');
            return $data;
    }
        
    function getdatalist()
    {
        $this->db->order_by('dept_name asc');
        $query = $this->db->get('mst_dept');
        $nomor = 1;
        foreach($query->result() as $row):
            $data[] = array(
                'nomor'         => $nomor,
                'dept_id'       => $row->dept_id,
                'dept_name'     => $row->dept_name,                
            ); 
            $nomor++;
        endforeach;
        return $data;
    }
}           