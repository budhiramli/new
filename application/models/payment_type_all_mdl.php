<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Payment_type_all_mdl extends CI_Model {
    function __construct() {
        parent::__construct();        
    }
    
    function getrecordcount()
    {
            $data = $this->db->count_all_results('payment_type');
            return $data;
    }
        
    function getdatalist()
    {
        $this->db->order_by('payment_type_name asc');
        $query = $this->db->get('payment_type');
        $nomor = 1;
        foreach($query->result() as $row):
            $data[] = array(
                'nomor'         => $nomor,
                'payment_type_id'       => $row->payment_type_id,
                'payment_type_name'     => $row->payment_type_name,
                'payment_type_desc'    => $row->payment_type_desc,
            ); 
            $nomor++;
        endforeach;
        return $data;
    }
}           