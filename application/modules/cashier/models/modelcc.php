<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class modelcc extends CI_Model {
	
	public function __construct(){
            parent::__construct();
            $this->load->model('logUpdate');
	}
        
        function getrecordcount()
        {
            $data = $this->db->count_all_results('cc_transaction');
            return $data;
        }
        
        function getdatalist()
        {
            $data = array();
            $fields = array(
                'cc_id',
                'cc_no', 
                'ref_id',
                'transaction_date',
                'company_code', 
                'cp', 
                'bank_name', 
                'currency',
                'amount', 
                'charges_currency', 
                'charges_amount', 
                'note',
            );
            
            $this->db->select($fields);
            $query = $this->db->get('cc_transaction');
            $nomor = 1;
            foreach($query->result() as $row):
                $data[] = array(
                    'nomor'             => $nomor,
                    'cc_id'             => $row->cc_id,                     
                    'cc_no'             => $row->cc_no, 
                    'ref_id'            => $row->ref_id,                     
                    'transaction_date'  => $row->transaction_date,                     
                    'branch'            => 'nama_cabang',                    
                    'customer'          => 'nama_customer', 
                    'cp'                => $row->cp, 
                    'bank_name'         => $row->bank_name,
                    'currency'          => $row->currency,
                    'amount'            => $row->amount, 
                    'charges_currency'  => $row->charges_currency, 
                    'charges'           => $row->charges_amount, 
                    'note'              => $row->note,
                );
                $nomor++;
            endforeach;
            return $data;
        }
        
        function getdataid($id)
        {
            $data = array();
            $fields = array(
                'cc_id',
                'cc_no',
                'ref_id', 
                'transaction_date', 
                'company_code', 
                'cp', 
                'bank_name', 
                'currency',
                'amount', 
                'charges_currency', 
                'charges_amount', 
                'note',
            );
            $this->db->select($fields);
            $this->db->where('cc_no', $id);
            $query = $this->db->get('cc_transaction');
            if ($query->num_rows>0){
                $row = $query->row();
                $data = array(
                    'branch'            => 'nama_cabang',
                    'cc_id'            => $row->cc_id, 
                    'cc_no'            => $row->cc_no,                     
                    'ref_id'            => $row->ref_id, 
                    'transaction_date' => $row->transaction_date, 
                    'customer'          => 'nama_customer', 
                    'cp'                => $row->cp, 
                    'bank_name'         => $row->bank_name,
                    'currency'          => $row->currency,
                    'amount'            => $row->amount, 
                    'charges_currency'  => $row->charges_currency, 
                    'charges'           => $row->charges_amount, 
                    'note'              => $row->note,
                );
            }
            return $data;
        }
        
        public function save($params)
	{	
		$log = $this->session->all_userdata();
		$valid = false;
		
                $fields = array(
                    "transaction_date" => date('Y-m-d', strtotime($params->transaction_date)),	
                    "company_code"       => $params->company_code,
                    "cp"                => $params->cp,
                    "bank_name"         => $params->bank_name,
                    "currency"          => $params->currency,                    
                    "amount"            => $params->amount,
                    "charges_currency"  => $params->currency,                    
                    "charges_amount"    => $params->amount,                    
                    "note"              => $params->note,                
                );
		
		if (!empty($params->id)) {
			$this->db->set($fields);
                    
                        $this->db->where("cc_no", $params->cc_no);
			$valid = $this->db->update("cc_transaction");
                        
			$valid = $this->logUpdate->addLog("update", "cc_transaction", $params);
		}
		else {
                    $this->db->set($fields);
                    $valid = $this->db->insert('cc_transaction');
                    
                    $valid = $this->logUpdate->addLog("insert", "cc_transaction", $params);
                        
		}
		
		return true;		
	}
        
        public function delete($id)
	{	
		$log = $this->session->all_userdata();
		$valid = false;		
		$valid = $this->logUpdate->addLog("delete", "cc_transaction", array("cc_id" => $id));	
		
		if ($valid){
			$this->db->where('cc_id', $id);
			$valid = $this->db->delete('cc_transaction');
		}
		
		return $valid;		
	}
}	