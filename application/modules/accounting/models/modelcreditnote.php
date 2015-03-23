<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ModelCreditNote extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    
    function getrecordcount()
    {
            $data = $this->db->count_all_results('cn_transaction');
            return $data;
    }
        
    function getdatalist()
        {
            $data = array();
            $fields = array(
                'cn_no',
                'transaction_no',                
                'branch_code',
                'transaction_date',
                'transaction_type_id',
                'dept_id',
                'company_code',
                'supplier_code',
                'cp',
                'is_add_manual',
                'used_amount',
            );
            
            $this->db->select($fields);
            $query = $this->db->get('cn_transaction');
            $nomor = 1;
            foreach($query->result() as $row):
                $data[] = array(
                    'nomor'              => $nomor,
                    'cn_no'                 => $row->cn_no,
                    'transaction_no'          => $row->transaction_no,                    
                    'branch'                => 'nama branch',
                    'transaction_date'     => $row->transaction_date,
                    'transaction_type_id'        => $row->transaction_type_id,
                    'dept_id'                  => 'nama dept',
                    'company_code'              => $row->company_code,
                    'cp'                    => $row->cp,
                    'is_add_manual'         => $row->is_add_manual,
                    'used_amount'           => $row->used_amount
                );
                $nomor++;
            endforeach;
            return $data;
        }
        
        function getdataid($id)
        {
            $data = array();
            $fields = array(
                'cn_no',
                'transaction_no',                
                'branch_code',
                'transaction_date',
                'transaction_type_id',
                'dept_id',
                'supplier_code',
                'cp',
                'is_add_manual',
                'used_amount',
            );
            $this->db->select($fields);
            $this->db->where('cn_no', $id);
            $query = $this->db->get('cn_transaction');
            if ($query->num_rows>0){
                $row = $query->row();
                $data = array(
                    'cn_no'                 => $row->cn_no,
                    'transaction_no'          => $row->transaction_no,                    
                    'branch_code'                => 'nama branch',
                    'transaction_date'     => $row->transaction_date,
                    'transaction_type_id'        => $row->transaction_type_id,
                    'dept_id'               => $row->dept_id,
                    'supplier_code'           => $row->supplier_code,
                    'cp'                    => $row->cp,
                    'is_add_manual'         => $row->is_add_manual,
                    'used_amount'           => $row->used_amount
                );
            }
            return $data;
        }
        
        public function save($params)
	{	
		$log = $this->session->all_userdata();
		$valid = false;
		
                $fields = array(
                    'cn_no'                 => $params->cn_no,
                    'transaction_no'          => $params->transaction_no,
                    'branch_code'           => 'nama branch',
                    'transaction_date'     => $params->transaction_date,
                    'transaction_type_id'        => $params->transaction_type_id,
                    'dept_id'               => $params->dept_id,
                    'supplier_code'           => $params->supplier_code,
                    'cp'                    => $params->cp,
                    'is_add_manual'         => $params->is_add_manual,
                    'used_amount'           => $params->used_amount         
                );
		
		if (!empty($params->id)) {
			$this->db->where("cn_no", $params->id);
			$valid = $this->db->update("cn_transaction");
                        
			$valid = $this->logUpdate->addLog("update", "cn_transaction", $params);
		}
		else {
			$valid = $this->db->insert('cn_transaction');
			
                        $valid = $this->logUpdate->addLog("insert", "cn_transaction", $params);
                        
		}
		
		return true;		
	}
        
        public function delete($id)
	{	
		$log = $this->session->all_userdata();
		$valid = false;		
		$valid = $this->logUpdate->addLog("delete", "dn_transaction", array("cn_no" => $id));	
		
		if ($valid){
			$this->db->where('cn_no', $id);
			$valid = $this->db->delete('dn_transaction');
		}		
		return $valid;		
	}
    
    
}    