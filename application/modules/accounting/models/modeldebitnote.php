<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ModelDebitNote extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    
    function getrecordcount()
    {
            $data = $this->db->count_all_results('dn_transaction');
            return $data;
    }
        
    function getdatalist()
        {
            $data = array();
            $fields = array(
                'dn_no',
                'transaction_no',
                'transaction_date',
                'transaction_type_id',
                'branch_code',
                'dept_id',
                'supplier_code',                
                'used_sap_amount',
                'used_amount',
            );
            
            $this->db->select($fields);
            $query = $this->db->get('dn_transaction');
            $nomor = 1;
            foreach($query->result() as $row):
                $data[] = array(
                    'nomor'                 => $nomor,
                    'dn_no'                 => $row->dn_no,
                    'transaction_no'        => $row->transaction_no,
                    'transaction_date'      => $row->transaction_date,
                    'transaction_type_id'   => $row->transaction_type_id,
                    'branch_code'           => 'nama cabang',
                    'dept_id'               => 'nama dept',
                    'supplier_code'         => 'nama vendor',
                    'used_sap_amount'       => $row->used_sap_amount,
                    'used_amount'           => $row->used_amount,                    
                );
                $nomor++;
            endforeach;
            return $data;
        }
        
        function getdataid($id)
        {
            $data = array();
            $fields = array(
                'dn_no',
                'transaction_no',
                'transaction_date',
                'transaction_type',
                'branch_code',
                'dept_id',
                'supplier_code',
                'used_sap_amount',
                'used_amount',
            );
            $this->db->select($fields);
            $this->db->where('dn_no', $id);
            $query = $this->db->get('dn_transaction');
            if ($query->num_rows>0){
                $row = $query->row();
                $data = array(
                    'dn_no'                 => $row->dn_no,
                    'transaction_no'        => $row->transaction_no,
                    'transaction_date'      => $row->transaction_date,
                    'transaction_type_id'   => $row->transaction_type_id,
                    'branc_code'            => 'nama cabang',
                    'dept_id'               => 'nama dept',
                    'supplier_code'         => $row->supplier_code,
                    'used_sap_amount'       => $row->used_sap_amount,
                    'used_amount'           => $row->used_amount, 
                );
            }
            return $data;
        }
        
        public function save($params)
	{	
		$log = $this->session->all_userdata();
		$valid = false;
		
                $fields = array(
                    'dn_no'                 => $params->dn_no,
                    'transaction_no'          => $params->transaction_no,
                    'transaction_date'     => date('Y-m-d', strtotime($params->transaction_date)),
                    'transaction_type_id'        => $params->transaction_type_id,
                    'branch_code'             => $params->branch_code,
                    'dept_id'               => $params->dept_id,
                    'supplier_code'           => $params->supplier_code,
                                
                );
		
		if (!empty($params->dn_no)) {
			$this->db->where("dn_no", $params->id);
			$valid = $this->db->update("dn_transaction");                        
			$valid = $this->logUpdate->addLog("update", "dn_transaction", $params);
		}
		else {
			$valid = $this->db->insert('dn_transaction');			
                        $valid = $this->logUpdate->addLog("insert", "dn_transaction", $params);                        
		}
		
		return true;		
	}
        
        public function delete($id)
	{	
		$log = $this->session->all_userdata();
		$valid = false;		
		$valid = $this->logUpdate->addLog("delete", "dn_transaction", array("dn_no" => $id));	
		
		if ($valid){
			$this->db->where('dn_no', $id);
			$valid = $this->db->delete('dn_transaction');
		}
		
		return $valid;		
	}
    
}    