<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class coa_account_mdl extends CI_Model {
    
    function __construct() {
        parent::__construct();
    }
    
     function getrecordcount()
    {
            $data = $this->db->count_all_results('coa_account');
            return $data;
    }
        
    function getdatalist()
        {
            $data = array();
            $fields = array(
                'account_code', 
                'account_name',
                'coa_group_name',
                'account_is_active'
            );
            
            $this->db->select($fields);
            $this->db->join('coa_class_group', 'coa_class_group.coa_group_id=coa_account.coa_group_id', 'left');
            $query = $this->db->get('coa_account');
            $nomor = 1;
            foreach($query->result() as $row):
                $data[] = array(
                    'nomor'                => $nomor,
                    'account_code'         => $row->account_code, 
                    'account_name'         => $row->account_name,
                    'coa_group_name'       => $row->coa_group_name,
                    'account_is_active'    => $row->account_is_active,
                );
                $nomor++;
            endforeach;
            return $data;
        }
        
        function getdataid($id)
        {
            $data = array();
            $fields = array(
                'account_code', 
                'account_name',
                'coa_account.coa_group_id',
                'coa_group_name',                
                'account_is_active'
            );
            
            $this->db->select($fields);
            $this->db->join('coa_class_group', 'coa_class_group.coa_group_id=coa_account.coa_group_id', 'left');
            
            $this->db->where('account_code', $id);
            $query = $this->db->get('coa_account');
            if ($query->num_rows() > 0){
                $row = $query->row();
                $status = '';
                if ($row->account_is_active == 'TRUE'){
                    $status = 'checked="checked"';
                }
                    $data = array(
                        'account_code'         => $row->account_code, 
                        'account_name'         => $row->account_name,
                        'coa_group_id'         => $row->coa_group_name,
                        'status'               => $status,
                    );
            }
            return $data;
        }
        
        function add($params)
        {
            $coagroupid = $this->getaccountgroup($params->coa_group_id);
            
            $status = 'FALSE';
            if (!empty($params->account_is_active)){
                $status = 'TRUE';            
            }
            
            $fields = array(
                'account_code'  => strtoupper(trim($params->account_code)), 
                'account_name'  => strtoupper(trim($params->account_name)),
                'coa_group_id'      => $coagroupid,
                'account_is_active' => $status
            );
            $this->db->set($fields);
            $this->db->insert('coa_account');
            return true;
        }
        
        function edit($params, $id)
        {
           
            $coagroupid = $this->getaccountgroup($params->coa_group_id);
            
            $status = 'FALSE';
            if (!empty($params->account_is_active)){
                $status = 'TRUE';
            }
            
            $fields = array(
                'account_code'  => strtoupper(trim($params->account_code)), 
                'account_name'  => strtoupper(trim($params->account_name)),
                'coa_group_id'  => $coagroupid,
                'account_is_active'  => $status
            );
            $this->db->set($fields);
            $this->db->where('account_code', $id);
            $this->db->update('coa_account');
            
            return true;
        }
        
        
        function getaccountgroup($name)
        {
            $this->db->where('UPPER(coa_group_name)', strtoupper(trim($name)));
            $query = $this->db->get('coa_class_group');
            $row = $query->row();
            $id = $row->coa_group_id;
            return $id;
        }
        
        function delete($id)
        {
            $this->db->where('account_code', $id);
            $this->db->delete('coa_account');
            
            return true;
        }
}        