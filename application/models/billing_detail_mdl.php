<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class billing_detail_mdl extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    
    function getrecordcount()
    {
            $data = $this->db->count_all_results('billing_transaction_detail');
            return $data;
    }
        
    function getdatalist()
    {
        $this->db->order_by('bill_detail_id asc');
        $query = $this->db->get('billing_transaction_detail');
        $nomor = 1;
        foreach($query->result() as $row):
            $data[] = array(
                'nomor'                 => $nomor,
                'invoice_no'            => $row->invoice_no,                
                'currency'              => $row->currency,                
                'amount'               => $row->amount,                
            ); 
            $nomor++;
        endforeach;
        return $data;
    }
    
     function save($params, $billno)
     {
         echo $billno;
         print_r($params);
          
     }       
}