<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class branch_all_mdl extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    
    function getrecordcount()
    {
            $data = $this->db->count_all_results('mst_company');
            return $data;
    }
        
    function getdatalist()
    {
        $this->db->order_by('company_name asc');
        $query = $this->db->get('mst_company');
        $nomor = 1;
        foreach($query->result() as $row):
            $data[] = array(
                'nomor'             => $nomor,
                'branch_code'     => $row->company_code,
                'branch_name'     => $row->company_name,
                'branch_address'  => $row->company_address,
                                
            ); 
            $nomor++;
        endforeach;
        return $data;
    }
}