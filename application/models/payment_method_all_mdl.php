<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Payment_method_all_mdl extends CI_Model {
    function __construct() {
        parent::__construct();        
    }
    
    function getrecordcount()
    {
            $data = $this->db->count_all_results('payment_method');
            return $data;
    }
        
    function getdatalist()
    {
        $this->db->order_by('payment_method_name asc');
        $query = $this->db->get('payment_method');
        $nomor = 1;
        foreach($query->result() as $row):
            $data[] = array(
                'nomor'         => $nomor,
                'payment_method_id'       => $row->payment_method_id,
                'payment_method_name'     => $row->payment_method_name,
                'payment_method_desc'    => $row->payment_method_desc,
            ); 
            $nomor++;
        endforeach;
        return $data;
    }
}           