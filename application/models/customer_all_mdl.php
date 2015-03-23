<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customer_all_mdl extends CI_Model {
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
                'company_code'     => $row->company_code,
                'company_name'     => $row->company_name,
                'company_address'  => $row->company_address,
                                
            ); 
            $nomor++;
        endforeach;
        return $data;
    }
}