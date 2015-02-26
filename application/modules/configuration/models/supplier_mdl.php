<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Supplier_mdl extends CI_Model {
    
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
            $data = array();
            $fields = array(
                'supplier_code',
                'supplier_name',
            );
            
            $this->db->select($fields);
            $query = $this->db->get('supplier');
            $nomor = 1;
            foreach($query->result() as $row):
                $data[] = array(
                    'nomor'                => $nomor,
                    'supplier_code'        => $row->supplier_code, 
                    'supplier_name'             => $row->supplier_name,
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