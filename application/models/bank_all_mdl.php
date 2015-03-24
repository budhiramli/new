<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class bank_all_mdl extends CI_Model {
    function __construct() {
        parent::__construct();        
    }
    
    function getrecordcount()
    {
            $data = $this->db->count_all_results('mst_bank');
            return $data;
    }
        
    function getdatalist()
    {
        $this->db->order_by('bank_name asc');
        $query = $this->db->get('mst_bank');
        $nomor = 1;
        foreach($query->result() as $row):
            $data[] = array(
                'nomor'         => $nomor,
                'bank_id'       => $row->bank_id,
                'bank_name'     => $row->bank_name,
                'bank_alias'    => $row->bank_desc,
            ); 
            $nomor++;
        endforeach;
        return $data;
    }
}           