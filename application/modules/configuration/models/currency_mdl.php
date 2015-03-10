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
                'currency_id',
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
                    'currency_id'           => $row->currency_id,
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
                'currency_id', 
                'currency',
                'symbol',
                'currency_name',
                'currency_country',
            );
            
            $this->db->select($fields);
            $this->db->where('currency_id', $id);
            $query = $this->db->get('mst_currency');
            if ($query->num_rows() > 0){
                $row = $query->row();
                    $data = array(
                        'currency_id'          => $row->currency_id, 
                        'currency'             => $row->currency,
                        'symbol'               => $row->symbol,
                        'currency_name'        => $row->currency_name,
                        'currency_country'     => $row->currency_country,
                    );
            }
            return $data;
        }
        
        function save($params)
        {
            $fields = array(
                'currency'             => $params->currency,
                'symbol'               => $params->symbol,
                'currency_name'        => $params->currency_name,
                'currency_country'     => $params->currency_country,
            );
            $this->db->set($fields);
            
            if (!empty($params->btnsave)){
                $this->db->insert('mst_currency');
            }
            
            if (!empty($params->btnupdate)){
                $id = $params->currency_id;
                $this->db->where('currency_id', $id);
                $this->db->update('mst_currency');
            }
            return true;
        }
        
        function delete()
        {
            
        }
}