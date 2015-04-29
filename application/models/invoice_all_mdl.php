<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Invoice_all_mdl extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    
    function getrecordcount()
    {
            $data = $this->db->count_all_results('invoice_transaction');
            return $data;
    }
        
    function getdatalist()
    {
        $this->db->order_by('invoice_no asc');
        $query = $this->db->get('invoice_transaction');
        $nomor = 1;
        foreach($query->result() as $row):
            $data[] = array(
                'nomor'                 => $nomor,
                'invoice_no'            => $row->invoice_no,
                'customer_code'    => $row->company_code,                
                'amount'               => $row->amount,                
            ); 
            $nomor++;
        endforeach;
        return $data;
    }
}