<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Currency_all_mdl extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    
    function getrecordcount()
    {
            $data = $this->db->count_all_results('mst_currency');
            return $data;
    }
        
    function getdatalist()
    {
        $this->db->order_by('currency asc');
        $query = $this->db->get('mst_currency');
        $nomor = 1;
        foreach($query->result() as $row):
            $data[] = array(
                'nomor'     => $nomor,
                'currency'  => $row->currency,
                'symbol'    => $row->symbol,
                'currency_name'     => $row->currency_name,
                'currency_country'  => $row->currency_country,                
            ); 
            $nomor++;
        endforeach;
        return $data;
    }
}