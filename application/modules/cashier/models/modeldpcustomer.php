<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class modeldpcustomer extends CI_Model {
	
	public function __construct(){
            parent::__construct();
            $this->load->model('logUpdate');
	}
        
        function getrecordcount()
        {
            $data = $this->db->count_all_results('dp_customer');
            return $data;
        }
        
        function getdatalist()
        {
            $data = array();
            $fields = array(
                'dc_no', 
                'transaction_no', 
                "(DATE_FORMAT(transaction_date, '%d-%m-%Y')) as transaction_date" ,
                'dept_id',                
                'company_code', 
                'cp', 
                'currency',
                'amount',
                'note',
            );
            $this->db->select($fields);
            $query = $this->db->get('dp_customer');
            $nomor = 1;
            foreach($query->result() as $row):                
                $data[] = array(
                    'nomor'                     => $nomor,
                    'dc_no'                     => $row->dc_no, 
                    'transaction_no'            => $row->transaction_no, 
                    'transaction_date'          => $row->transaction_date,
                    'dept_id'                   => $row->dept_id,                     
                    'company_code'              => $row->company_code, 
                    'cp'                        => $row->cp, 
                    'currency'                  => $row->currency,
                    'amount'                    => number_format($row->amount, 2, '.', ','),
                    'note'                      => $row->note,
                );
                $nomor++;
            endforeach;
            
            return $data;
        }
        
        function getdataid($id)
        {
            $data = array();
            $fields = array(
                'dc_transaction_id',
                'dc_no', 
                'transaction_no', 
                "transaction_date" ,
                'dept_id',                
                'company_code', 
                'cp', 
                'currency',
                'amount',
                'note',
            );
            $this->db->select($fields);
            $this->db->where('dc_transaction_id', $id);
            $query = $this->db->get('dp_customer');
            if ($query->num_rows>0){
                $row = $query->row();
                $data = array(
                    'dc_transaction_id'         => $row->dc_transaction_id, 
                    'dc_no'                     => $row->dc_no, 
                    'transaction_no'            => $row->transaction_no, 
                    'transaction_date'          => $row->transaction_date,
                    'dept_id'                   => $row->dept_id,                     
                    'company_code'              => $row->company_code, 
                    'cp'                        => $row->cp, 
                    'currency'                  => $row->currency,
                    'amount'                    => number_format($row->amount, 2, '.', ','),
                    'note'                      => $row->note,
                );
            }
            return $data;
        }
        
        public function save($params)
	{	
		$log = $this->session->all_userdata();
		$valid = false;
                
                $fields = array(
                    'dc_no'                     => trim($params->dc_no), 
                    'transaction_no'            => trim($params->transaction_no), 
                    'transaction_date'          => $params->transaction_date,
                    'dept_id'                   => $params->dept_id,                     
                    'company_code'              => trim($params->company_code), 
                    'cp'                        => trim($params->cp), 
                    'currency'                  => trim($params->currency),
                    'amount'                    => $params->amount,
                    'note'                      => $params->note,
                );
                        
		if (!empty($params->id_dp_customer)) {
			$this->db->where("dc_transaction_id", $params->id);
                        $this->db->set($fields);
			$valid = $this->db->update("dp_customer");
                        
			$valid = $this->logUpdate->addLog("update", "dp_customer", $params);
		}
		else {
                        $this->db->set($fields);
                        $valid = $this->db->insert('dp_customer');
                        
                        $valid = $this->logUpdate->addLog("insert", "dp_customer", $params);
		}
		
		return true;		
	}
        
        public function delete($id)
	{	
		$log = $this->session->all_userdata();
                $valid = true;
		//$valid = $this->logUpdate->addLog("delete", "dp_customer", array("dc_transaction_id" => $id, $log));	
		
		if ($valid){
			$this->db->where('dc_transaction_id', $id);
			$valid = $this->db->delete('dp_customer');
                        //echo $this->db->last_query();
		}
		
		return $valid;		
	}
}	