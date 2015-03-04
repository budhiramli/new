<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Supplier_all_mdl extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    
    function getrecordcount()
    {
            $data = $this->db->count_all_results('supplier');
            return $data;
    }
        
    function getdatalist()
    {
        $this->db->order_by('supplier_name asc');
        $query = $this->db->get('supplier');
        $nomor = 1;
        foreach($query->result() as $row):
            $data[] = array(
                'nomor'             => $nomor,
                'supplier_code'     => $row->supplier_code,
                'supplier_name'     => $row->supplier_name,
                'supplier_address'  => $row->supplier_address,
                                
            ); 
            $nomor++;
        endforeach;
        return $data;
    }
}