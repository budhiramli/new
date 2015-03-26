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
                'bank_account.bank_account_type_id',
                'bank_account_type_name',                
                'bank_account_is_default',
                'currency',
                'bank_account.account_code',
                'bank_account_bank_name',
                'bank_account_bank_number',
                'bank_account_bank_address',                
            );
            
            $this->db->select($fields);
            $this->db->join('bank_account_type', 'bank_account_type.bank_account_type_id=bank_account.bank_account_type_id', 'left');
            $this->db->join('coa_account', 'coa_account.account_code=bank_account.account_code', 'left');
            $this->db->where('bank_account_id', $id);
            $query = $this->db->get('bank_account');
            if ($query->num_rows() > 0){
                $row = $query->row();
                $status = '';
                if ($row->bank_account_is_default == 'TRUE'){
                    $status = 'checked="checked"';
                }
                    $data = array(
                        'bank_account_id'           => $row->bank_account_id, 
                        'bank_account_name'         => $row->bank_account_name,
                        'bank_account_type_id'      => $row->bank_account_type_name,                
                        'status'   => $status,
                        'currency'                  => $row->currency,
                        'account_code'              => $row->account_code,
                        'bank_account_bank_name'    => $row->bank_account_bank_name,
                        'bank_account_bank_number'  => $row->bank_account_bank_number,
                        'bank_account_bank_address' => $row->bank_account_bank_address, 
                    );
            }
            return $data;
        }
        
        function getbankaccounttype($name)
        {
            $this->db->where('UPPER(bank_account_type_name)', strtoupper(trim($name)));
            $query  = $this->db->get('bank_account_type');
            $row    = $query->row();
            $id     = $row->bank_account_type_id;
            return $id;
        }
        
        function add($params)
        {
            $bankaccounttypeid = $this->getbankaccounttype($params->bank_account_type_id);
            
            
            $status = 'FALSE';
            if (!empty($params->bank_account_is_default)){
                $status = 'TRUE';
            }
            
            
            $fields = array(
                'bank_account_name'         => trim($params->bank_account_name),
                'bank_account_type_id'      => trim($bankaccounttypeid),                
                'currency'                  => trim($params->currency),
                'bank_account_is_default'   => $status,
                'account_code'              => trim($params->account_code),
                'bank_account_bank_name'    => trim($params->bank_account_bank_name),
                'bank_account_bank_number'  => trim($params->bank_account_bank_number),
                'bank_account_bank_address' => trim($params->bank_account_bank_address),
            );
            $this->db->set($fields);
            $this->db->insert('bank_account');
            
            return true;
        }
        
        function edit($params, $id)
        {
            $bankaccounttypeid = $this->getbankaccounttype($params->bank_account_type_id);
            
            $status = 'FALSE';
            if (!empty($params->bank_account_is_default)){
                $status = 'TRUE';
            }
            
            
            $fields = array(
                'bank_account_name'         => trim($params->bank_account_name),
                'bank_account_type_id'      => trim($bankaccounttypeid),                
                'currency'                  => trim($params->currency),
                'bank_account_is_default'   => $status,
                'account_code'              => trim($params->account_code),
                'bank_account_bank_name'    => trim($params->bank_account_bank_name),
                'bank_account_bank_number'  => trim($params->bank_account_bank_number),
                'bank_account_bank_address' => trim($params->bank_account_bank_address),
            );
            $this->db->set($fields);
            $this->db->where('bank_account_id', trim($id));
            $this->db->update('bank_account');            
            return true;
        }
        
        function delete($id)
        {
            $this->db->where('bank_account_id', $id);            
            $this->db->delete('bank_account');            
            return true;
        }
        
        
}        