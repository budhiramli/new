<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class bank_account_type_all_mdl extends CI_Model {
    function __construct() {
        parent::__construct();        
    }
    
    function getrecordcount()
    {
            $data = $this->db->count_all_results('bank_account_type');
            return $data;
    }
        
    function getdatalist()
    {
        $this->db->order_by('bank_account_type_name asc');
        $query = $this->db->get('bank_account_type');
        $nomor = 1;
        foreach($query->result() as $row):
            $data[] = array(
                'nomor'                     => $nomor,
                'bank_account_type_id'      => $row->bank_account_type_id,
                'bank_account_type_name'    => $row->bank_account_type_name,                
            ); 
            $nomor++;
        endforeach;
        return $data;
    }
}           