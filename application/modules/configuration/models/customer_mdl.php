<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customer_mdl extends CI_Model {
    
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
            $data = array();
            $fields = array(
                'company_code',
                
            );
            
            $this->db->select($fields);
            $query = $this->db->get('mst_company');
            $nomor = 1;
            foreach($query->result() as $row):
                $data[] = array(
                    'nomor'                => $nomor,
                    'company_code'        => $row->company_code, 
                    
                );
                $nomor++;
            endforeach;
            return $data;
        }
        
        function getdataid($id)
        {
            $data = array();
            $fields = array(
                
            );
            
            $this->db->select($fields);
            $this->db->where('supplier_code', $id);
            $query = $this->db->get('supplier');
            if ($query->num_rows() > 0){
                $row = $query->row();
                    $data = array(
                        'supplier_code'          => $row->supplier_code,
                    );
            }
            return $data;
        }
}