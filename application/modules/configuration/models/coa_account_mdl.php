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
                'coa_group_id',
                'account_is_active'
            );
            
            $this->db->select($fields);
            $this->db->where('account_code', $id);
            $query = $this->db->get('coa_account');
            if ($query->num_rows() > 0){
                $row = $query->row();
                    $data = array(
                        'account_code'         => $row->account_code, 
                        'account_name'         => $row->account_name,
                        'coa_group_id'         => $row->coa_group_id,
                        'account_is_active'    => $row->account_is_active,
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