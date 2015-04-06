<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ModelRefund extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    
    function getrecordcount()
    {
            $data = $this->db->count_all_results('refund_transaction');
            return $data;
    }
        
    function getdatalist()
        {
            $data = array();
            $fields = array(
                'refund_no', 
                'branch_code', 
                'transaction_no',
                'transaction_date',
                'collect_date', 
                'dept_id',
                
            );
            
            $this->db->select($fields);
            $query = $this->db->get('refund_transaction');
            $nomor = 1;
            foreach($query->result() as $row):
                $data[] = array(
                    'nomor'                 => $nomor,
                    'branch'                => 'nama cabang', 
                    'refund_no'             => $row->refund_no, 
                    'transaction_no'        => $row->transaction_no, 
                    'collect_date'          => $row->collect_date, 
                    'transaction_date'      => $row->transaction_date, 
                    
                );
                $nomor++;
            endforeach;
            return $data;
        }
        
        function getdataid($id)
        {
            $data = array();
            $fields = array(
                'refund_no', 
                'branch_code', 
                'transaction_no',
                'transaction_date',
                'collect_date', 
                'dept_id',
            );
            $this->db->select($fields);
            $this->db->where('refund_no', $id);
            $query = $this->db->get('dn_transaction');
            if ($query->num_rows>0){
                $row = $query->row();
                $data = array(
                    'refund_no'             => $row->refund_no, 
                    'transaction_no'        => $row->transaction_no, 
                    'collect_date'          => $row->collect_date, 
                    'transaction_date'      => $row->transaction_date,
                );
            }
            return $data;
        }
        
        public function save($params)
	{	
		$log = $this->session->all_userdata();
		$valid = false;
		
                $fields = array(
                    'refund_no'           => $params->refund_no,
                    'transaction_no'      => $params->transaction_no,
                    'transaction_date'    => date('Y-m-d', strtotime($params->transaction_date)),
                    'collect_date'        => date('Y-m-d', strtotime($params->collect_date)),
                                
                );
		
		if (!empty($params->id)) {
			$this->db->where("refund_no", $params->id);
			$valid = $this->db->update("refund_transaction");
                        
			$valid = $this->logUpdate->addLog("update", "refund_transaction", $params);
		}
		else {
			$valid = $this->db->insert('refund_transaction');
			
                        $valid = $this->logUpdate->addLog("insert", "refund_transaction", $params);
                        
		}
		
		return true;		
	}
        
        public function delete($id)
	{	
		$log = $this->session->all_userdata();
		$valid = false;		
		$valid = $this->logUpdate->addLog("delete", "refund_transaction", array("refund_no" => $id));	
		
		if ($valid){
			$this->db->where('refund_no', $id);
			$valid = $this->db->delete('refund_transaction');
		}
		
		return $valid;		
	}
    
}    