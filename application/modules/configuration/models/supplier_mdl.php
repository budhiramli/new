<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Supplier_mdl extends CI_Model {
    
    function __construct() {
        parent::__construct();
    }
    
     function getrecordcount()
    {
            $data = $this->db->count_all_results('mst_supplier');
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
            $query = $this->db->get('mst_supplier');
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
                'supplier_code',
                'supplier_name',
                'supplier_address',
                'supplier_address2',
                'country',
                'province',
                'state',
                'zip_code',
                'phone',
                'fax',
            );
            
            $this->db->select($fields);
            $this->db->where('supplier_code', $id);
            $query = $this->db->get('mst_supplier');
            if ($query->num_rows() > 0){
                $row = $query->row();
                    $data = array(
                        'supplier_code'         => $row->supplier_code,
                        'supplier_name'         => $row->supplier_name,
                        'supplier_address'      => $row->supplier_address,
                        'supplier_address2'     => $row->supplier_address2,
                        'country'               => $row->country,
                        'province'              => $row->province,
                        'state'                 => $row->state,
                        'zip_code'              => $row->zip_code,
                        'phone'                 => $row->phone,
                        'fax'                   => $row->fax,
                    );
            }
            return $data;
        }
}