<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class modelcheque extends CI_Model {
	
	public function __construct(){
            parent::__construct();
            $this->load->model('logUpdate');
	}
        
        function getrecordcount()
        {
            $data = $this->db->count_all_results('cheque_transaction');
            return $data;
        }
        
        function getdatalist()
        {
            $data = array();
            $fields = array(
                'bg_prefix',
                'bg_no',
                'transaction_date', 
                'due_date',
                'ref_prefix', 
                'ref_type', 
                'cp', 
                'bank_name', 
                'currency', 
                'amount', 
                'is_balance',
            );            
            $this->db->select($fields);
            $query = $this->db->get('cheque_transaction');
            $nomor = 1;
            foreach($query->result() as $row):
                $data[] = array(
                    'nomor'                 => $nomor,
                    'branch'                => 'nama_cabang',
                    'bg_no'                 => $row->bg_no, 
                    'transaction_date'     => $row->transaction_date,
                    'due_date'              => $row->due_date,
                    'ref_type'              => $row->ref_type, 
                    'cp'                    => $row->cp, 
                    'bank_name'             => $row->bank_name,
                    'currency'              => $row->currency,
                    'amount'                => $row->amount,                    
                );
                $nomor++;
            endforeach;
            
            return $data;
        }
        
        function getdataid($id)
        {
            $data = array();
            $fields = array(
                'bg_prefix',
                'bg_no',
                'transaction_date', 
                'due_date',
                'ref_prefix', 
                'ref_type', 
                'cp', 
                'bank_name', 
                'currency', 
                'amount', 
                'is_balance',
            );
            $this->db->select($fields);
            $this->db->where('bg_no', $id);
            $query = $this->db->get('cheque_transaction');
            if ($query->num_rows>0){
                $row = $query->row();
                $data = array(
                    'branch'                => '',
                    'bg_no'                 => $row->bg_no, 
                    'transaction_date'     => $row->transaction_date,
                    'due_date'              => $row->due_date,
                    'ref_type'              => $row->ref_type, 
                    'cp'                    => $row->cp, 
                    'bank_name'             => $row->bank_name,
                    'currency'              => $row->currency,
                    'amount'                => $row->amount,    
                );
            }
            return $data;
        }
        
        public function save($params)
	{	
		$log = $this->session->all_userdata();
		$valid = false;
                $fields = array(
                    'branch_code'       => $params->branch_code,
                    'transaction_date'  => date('Y-m-d', strtotime($params->transaction_date)),
                    'bg_no'             => $params->bg_no,
                );
		
		
		if (!empty($params->id)) {
                        $this->db->set($fields);
			$this->db->where("cheque_id", $params->cheque_id);
			$valid = $this->db->update("cheque_transaction");
                        
			$valid = $this->logUpdate->addLog("update", "cheque_transaction", $params);
		}
		else {
                        $this->db->set($fields);
			$valid = $this->db->insert('cheque_transaction');
			
                        $valid = $this->logUpdate->addLog("insert", "cheque_transaction", $params);
                        
			//$valid = $this->modelNumbertrans->updatePVNumber();
			
			//$this->db2->set("status", 1);
			//$this->db2->where("id_invoice", $params->id_invoice);
			//$this->db2->update("trans_ticketinvoice");
		}
		
		return true;		
	}
        
        public function delete($id)
	{	
		$log = $this->session->all_userdata();
		$valid = false;		
		$valid = $this->logUpdate->addLog("delete", "cheque_transaction", array("cheque_id" => $id));	
		
		if ($valid){
			$this->db->where('cheque_id', $id);
			$valid = $this->db->delete('cheque_transaction');
		}
		
		return $valid;		
	}
}	