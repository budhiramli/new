<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class bank_account_mdl extends CI_Model {
    
    function __construct() {
        parent::__construct();
    }
    
     function getrecordcount()
    {
            $data = $this->db->count_all_results('bank_account');
            return $data;
    }
        
    function getdatalist()
        {
            $data = array();
            $fields = array(
                'bank_account_id', 
                'bank_account_name',
                'bank_account_type_name',                
                'bank_account_is_default',
                'currency',
                'bank_account.account_code',
                'account_name',
                'bank_account_bank_name',
                'bank_account_bank_number',
                'bank_account_bank_address',                
            );
            
            $this->db->select($fields);
            $this->db->join('bank_account_type', 'bank_account_type.bank_account_type_id=bank_account.bank_account_type_id', 'left');
            $this->db->join('coa_account', 'coa_account.account_code=bank_account.account_code', 'left');
            $query = $this->db->get('bank_account');
            $nomor = 1;
            foreach($query->result() as $row):
                $data[] = array(
                    'nomor'                     => $nomor,
                    'bank_account_id'           => $row->bank_account_id, 
                    'bank_account_name'         => $row->bank_account_name,
                    'bank_account_type_name'    => $row->bank_account_type_name,                
                    'bank_account_is_default'   => $row->bank_account_is_default,
                    'currency'                  => $row->currency,
                    'account_code'              => $row->account_code.' '.$row->account_name,
                    'bank_account_bank_name'    => $row->bank_account_bank_name,
                    'bank_account_bank_number'  => $row->bank_account_bank_number,
                    'bank_account_bank_address' => $row->bank_account_bank_address, 
                );
                $nomor++;
            endforeach;
            return $data;
        }
        
        function getdataid($id)
        {
            $data = array();
            $fields = array(
                'bank_account_id', 
                'bank_account_name',
                'bank_account_type_id',                
                'bank_account_is_default',
                'currency',
                'account_code',
                'account_name',
                'bank_account_bank_name',
                'bank_account_bank_number',
                'bank_account_bank_address',                
            );
            
            $this->db->select($fields);
            $this->db->where('bank_account_id', $id);
            $query = $this->db->get('bank_account');
            if ($query->num_rows() > 0){
                $row = $query->row();
                    $data = array(
                        'bank_account_id'           => $row->bank_account_id, 
                        'bank_account_name'         => $row->bank_account_name,
                        'bank_account_type_name'    => $row->bank_account_type_name,                
                        'bank_account_is_default'   => $row->bank_account_is_default,
                        'currency'                  => $row->currency,
                        'account_code'              => $row->account_code,
                        'account_name'              => $row->account_name,
                        'bank_account_bank_name'    => $row->bank_account_bank_name,
                        'bank_account_bank_number'  => $row->bank_account_bank_number,
                        'bank_account_bank_address' => $row->bank_account_bank_address, 
                    );
            }
            return $data;
        }
        
        function save($params)
        {
            return true;
        }
        
        function update($params, $id)
        {
            return true;
        }
        
        function delete($id)
        {
            return true;
        }
}        