<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Currency_mdl extends CI_Model {
    
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
            $data = array();
            $fields = array(
                'id_currency', 
                'currency',
                'symbol',
                'currency_name',
                'currency_country',
            );
            
            $this->db->select($fields);
            $query = $this->db->get('mst_currency');
            $nomor = 1;
            foreach($query->result() as $row):
                $data[] = array(
                    'nomor'                 => $nomor,
                    'id_currency'          => $row->id_currency, 
                    'currency'             => $row->currency,
                    'symbol'               => $row->symbol,
                    'currency_name'        => $row->currency_name,
                    'currency_country'     => $row->currency_country,
                );
                $nomor++;
            endforeach;
            return $data;
        }
        
        function getdataid($id)
        {
            $data = array();
            $fields = array(
                'id_currency', 
                'currency',
                'symbol',
                'currency_name',
                'currency_country',
            );
            
            $this->db->select($fields);
            $this->db->where('id_currency', $id);
            $query = $this->db->get('mst_currency');
            if ($query->num_rows() > 0){
                $row = $query->row();
                    $data = array(
                        'id_currency'          => $row->id_currency, 
                        'currency'             => $row->currency,
                        'symbol'               => $row->symbol,
                        'currency_name'        => $row->currency_name,
                        'currency_country'     => $row->currency_country,
                    );
            }
            return $data;
        }
}