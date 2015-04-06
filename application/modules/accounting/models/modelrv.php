<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ModelRv extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    
    function get_rvno()
        {
            $tahun = date('Y');
            //check first from counter_log
            $this->db->where('counter_code', 'rv_no');
            $this->db->where('counter_year', $tahun);            
            $query = $this->db->get('counter_log');
            if ($query->num_rows() == 1){
                $row = $query->row();
                $dsno = $row->counter_no+1;
                
                $this->db->where('counter_code', 'rv_no');
                $this->db->where('counter_year', $tahun);
                $this->db->set('counter_no', $dsno);
                $this->db->update('counter_log');
            }
            else {
                //add new counter code
                $dsno = 1;
                $fields = array(
                    'counter_code'  => 'rv_no',
                    'counter_year'  => $tahun,
                    'counter_no'    => $dsno,    
                );
                $this->db->set($fields);
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
            $this->db->where('counter_code', 'rv_transno');
            $this->db->where('counter_year', $tahun);            
            $query = $this->db->get('counter_log');
            if ($query->num_rows() == 1){
                $row = $query->row();
                $transno = $row->counter_no+1;
                
                $this->db->where('counter_code', 'rv_transno');
                $this->db->where('counter_year', $tahun);
                $this->db->set('counter_no', $transno);
                $this->db->update('counter_log');
            }
            else {
                //add new counter code
                $transno = 1;
                $fields = array(
                    'counter_code'  => 'rv_transno',
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
                'receipt_type_name',                
                'dept_name',
                'company_name as branch_name',
            );
            
            $this->db->select($fields);
            $this->db->join('receipt_type', 'receipt_type.receipt_type_id=rv_transaction.receipt_type_id', 'left');
            $this->db->join('mst_dept', 'mst_dept.dept_id=rv_transaction.dept_id', 'left');
            $this->db->join('mst_company', 'mst_company.company_code=rv_transaction.branch_code', 'left');
            $query = $this->db->get('rv_transaction');
            $nomor = 1;
            foreach($query->result() as $row):
                $data[] = array(
                    'nomor'                 => $nomor,
                    'rv_no'                 => $row->rv_no,
                    'transaction_no'        => $row->transaction_no,
                    'transaction_date'      => $row->transaction_date,
                    'receipt_type_name'       => $row->receipt_type_name,
                    'dept_name'             => $row->dept_name,
                    'branch_name'           => $row->branch_name,
                    
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
                'receipt_type_id',
                
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
                    'receipt_type_id'        => $row->receipt_type_id,
                    
                );
            }
            return $data;
        }
        
        public function save($params)
	{	
		$log = $this->session->all_userdata();
		$valid = false;
		
                $fields = array(
                    'transaction_date'  => date('Y-m-d', strtotime($params->transaction_date)),
                    'receipt_type_id'   => $params->receipt_type_id,
                    'dept_id'           => $params->dept_id,
                    'branch_code'       => $params->branch_code,
                    'rv_note'           => $params->rv_note,
                );
		
		if (!empty($params->rv_no)) {
                        $this->db->set($fields);
			$this->db->where("rv_no", $params->rv_no);
			$valid = $this->db->update("rv_transaction");
                        
			$valid = $this->logUpdate->addLog("update", "rv_transaction", $params);
		}
		else {
                        $rv_no = $this->get_rvno();
                        $trasno = $this->get_transno();
                        $this->db->set($fields);
                        $this->db->set('rv_no', $rv_no);
                        $this->db->set('transaction_no', $trasno); 
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