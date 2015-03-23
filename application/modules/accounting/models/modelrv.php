<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ModelRv extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    
    function getrecordcount()
    {
            $data = $this->db->count_all_results('rv_transaction');
            return $data;
    }
        
    function getdatalist()
        {
            $data = array();
            $fields = array(
                'rv_no',
                'transaction_no',
                'transaction_date',
                'transaction_type_id',
                'lg_no',
                'receipt_by',
                'supplier_code',
            );
            
            $this->db->select($fields);
            $query = $this->db->get('rv_transaction');
            $nomor = 1;
            foreach($query->result() as $row):
                $data[] = array(
                    'nomor'                 => $nomor,
                    'rv_no'                 => $row->rv_no,
                    'transaction_no'          => $row->transaction_no,
                    'transaction_date'     => $row->transaction_date,
                    'transaction_type_id'        => $row->transaction_type_id,
                    'lg_no'                 => $row->lg_no,
                    'receipt_by'            => $row->receipt_by,
                    'supplier_code'           => $row->supplier_code,
                );
                $nomor++;
            endforeach;
            return $data;
        }
        
        function getdataid($id)
        {
            $data = array();
            $fields = array(
                'rv_no',
                'transaction_no',
                'transaction_date',
                'transaction_type_id',
                'lg_no',
                'receipt_by',
                'supplier_code'
            );
            $this->db->select($fields);
            $this->db->where('rv_no', $id);
            $query = $this->db->get('rv_transaction');
            if ($query->num_rows>0){
                $row = $query->row();
                $data = array(
                    'rv_no'                 => $row->rv_no,
                    'transaction_no'          => $row->transaction_no,
                    'transaction_date'     => $row->transaction_date,
                    'transaction_type_id'        => $row->transaction_type_id,
                    'lg_no'                 => $row->lg_no,
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
                    'rv_no'                 => $params->rv_no,
                    'transaction_no'          => $params->transaction_no,
                    'transaction_date'     => $params->transaction_date,
                    'transaction_type_id'        => $params->transaction_type,
                    'lg_no'                 => $params->lg_no,
                    'receipt_by'            => $params->receipt_by,
                    'supplier_code'           => $params->supplier_code,      
                );
		
		if (!empty($params->id)) {
			$this->db->where("rv_no", $params->id);
			$valid = $this->db->update("rv_transaction");
                        
			$valid = $this->logUpdate->addLog("update", "rv_transaction", $params);
		}
		else {
			$valid = $this->db->insert('rv_transaction');
			
                        $valid = $this->logUpdate->addLog("insert", "rv_transaction", $params);
                        
		}
		
		return true;		
	}
        
        public function delete($id)
	{	
		$log = $this->session->all_userdata();
		$valid = false;		
		$valid = $this->logUpdate->addLog("delete", "pv_transaction", array("rv_no" => $id));	
		
		if ($valid){
			$this->db->where('rv_no', $id);
			$valid = $this->db->delete('pv_transaction');
		}
		
		return $valid;		
	}
    
}    