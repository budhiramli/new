<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class coa_account_all_mdl extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    
    function getrecordcount()
    {
            $data = $this->db->count_all_results('coa_account');
            return $data;
    }
        
    function getdatalist()
    {
        $this->db->order_by('account_code asc');
        $query = $this->db->get('coa_account');
        $nomor = 1;
        foreach($query->result() as $row):
            $data[] = array(
                'nomor'             => $nomor,
                'account_code'      => $row->account_code,
                'account_name'      => $row->account_name,                                
            ); 
            $nomor++;
        endforeach;
        return $data;
    }
}