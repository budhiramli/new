<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class modeldpcustomer extends CI_Model {
	
	public function __construct(){
            parent::__construct();
            $this->load->model('logUpdate');
	}
        
        function get_dsno()
        {
            $tahun = date('Y');
            //check first from counter_log
            $this->db->where('counter_code', 'dp_customer');
            $this->db->where('counter_year', $tahun);            
            $query = $this->db->get('counter_log');
            if ($query->num_rows() == 1){
                $row = $query->row();
                $dsno = $row->counter_no+1;
                
                $this->db->where('counter_code', 'dp_customer');
                $this->db->where('counter_year', $tahun);
                $this->db->set('counter_no', $dsno);
                $this->db->update('counter_log');
            }
            else {
                //add new counter code
                $dsno = 1;
                $fields_counter = array(
                    'counter_code'  => 'dp_customer',
                    'counter_year'  => $tahun,
                    'counter_no'    => $dsno,    
                );
                $this->db->set($fields_counter);
                $this->db->insert('counter_log');
                
            }
            $pnj = strlen($dsno);
            $panjang = ($pnj*-1);
            $dsno = substr('00000', 0, $panjang) . $dsno;
            return $dsno;
        }
        
        function get_transno()
        {
            $tahun = date('Y');
            //check first from counter_log
            $this->db->where('counter_code', 'dc_transno');
            $this->db->where('counter_year', $tahun);            
            $query = $this->db->get('counter_log');
            if ($query->num_rows() == 1){
                $row = $query->row();
                $transno = $row->counter_no+1;
                
                $this->db->where('counter_code', 'dc_transno');
                $this->db->where('counter_year', $tahun);
                $this->db->set('counter_no', $transno);
                $this->db->update('counter_log');
            }
            else {
                //add new counter code
                $transno = 1;
                $fields = array(
                    'counter_code'  => 'dc_transno',
                    'counter_year'  => $tahun,
                    'counter_no'    => $transno,    
                );
                $this->db->set($fields);
                $this->db->insert('counter_log');                
            }
            $pnj = strlen($transno);
            $panjang = ($pnj*-1);
            $transno = substr('00000', 0, $panjang) . $transno;
            return $transno;
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
            $this->db->where('dc_no', $id);
            $query = $this->db->get('dp_customer');
            if ($query->num_rows>0){
                $row = $query->row();
                $data = array(
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
                $amount = str_replace(',','', $params->amount);            
                $used_amount = str_replace(',','', $params->used_amount);
                $customer_code = explode(' ',trim($params->company_code));
            
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
                        $dc_no = $this->get_dsno();
                        $trans_no = $this->get_transno();
                        $this->db->set($fields);
                        $this->db->set('dc_no', $dc_no);
                        $this->db->set('transaction_no', $trans_no);
                        
                        $valid = $this->db->insert('dp_customer');
                        //echo $this->db->last_query();
                        
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
			$this->db->where('dc_no', $id);
			$valid = $this->db->delete('dp_customer');
                        //echo $this->db->last_query();
		}
		
		return $valid;		
	}
}	