<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ModelPv extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    
    
    function getrecordcount()
    {
            $data = $this->db->count_all_results('pv_transaction');
            return $data;
    }
        
    function getdatalist()
        {
            $data = array();
            $fields = array(
                'pv_no',
                'transaction_no',
                'transaction_type_id',
                'transaction_date',
                'lg_no',
                'due_date',                
                'receipt_by',
                'supplier_code',
            );
            
            $this->db->select($fields);
            $query = $this->db->get('pv_transaction');
            $nomor = 1;
            foreach($query->result() as $row):
                $data[] = array(
                    'nomor'                 => $nomor,
                    'pv_no'                 => $row->pv_no,
                    'transaction_no'        => $row->transaction_no,
                    'transaction_date'      => $row->transaction_date,
                    'transaction_type_id'   => $row->transaction_type_id,
                    'lg_no'                 => $row->lg_no,
                    'receipt_by'            => $row->receipt_by,
                    'supplier_code'         => $row->supplier_code,
                );
                $nomor++;
            endforeach;
            return $data;
        }
        
        function getdataid($id)
        {
            $data = array();
            $fields = array(
                'pv_no',
                'transaction_no',
                'transaction_type_id',
                'transaction_date',
                'due_date',               
                'receipt_by',
                'branch_code',
                'supplier_code',
            );
            $this->db->select($fields);
            $this->db->where('pv_no', $id);
            $query = $this->db->get('pv_transaction');
            if ($query->num_rows>0){
                $row = $query->row();
                $data = array(
                    'pv_no'                 => $row->pv_no,
                    'transaction_no'          => $row->transaction_no,
                    'transaction_date'     => $row->transaction_date,
                    'transaction_type_id'        => $row->transaction_type_id,                    
                    'receipt_by'            => $row->receipt_by,
                    'supplier_code'           => $row->supplier_code,
                );
            }
            return $data;
        }
        
        public function save($params)
	{	
		$log = $this->session->all_userdata();
		$valid = false;
		
                $fields = array(
                    'pv_no'                 => $params->pv_no,
                    'transaction_no'        => $params->transaction_no,
                    'transaction_date'      => $params->transaction_date,
                    'transaction_type_id' => $params->transaction_type_id,                    
                    'receipt_by'            => $params->receipt_by,
                    'supplier_code'         => $params->supplier_code,      
                );
		
                $this->db->set($fields);
		if (!empty($params->pv_no)) {
			$this->db->where("pv_no", $params->pv_no);
			$valid = $this->db->update("pv_transaction");
                        
			$valid = $this->logUpdate->addLog("update", "pv_transaction", $params);
		}
		else {
			$valid = $this->db->insert('pv_transaction');
			
                        $valid = $this->logUpdate->addLog("insert", "pv_transaction", $params);
                        
		}
		
		return true;		
	}
        
        public function delete($id)
	{	
		$log = $this->session->all_userdata();
		$valid = false;		
		$valid = $this->logUpdate->addLog("delete", "pv_transaction", array("pv_no" => $id));	
		
		if ($valid){
			$this->db->where('pv_no', $id);
			$valid = $this->db->delete('pv_transaction');
		}
		
		return $valid;		
	}
}    