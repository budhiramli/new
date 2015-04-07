<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ModelCreditNote extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    
    function get_cnno()
        {
            $tahun = date('Y');
            //check first from counter_log
            $this->db->where('counter_code', 'cn_no');
            $this->db->where('counter_year', $tahun);            
            $query = $this->db->get('counter_log');
            if ($query->num_rows() == 1){
                $row = $query->row();
                $dsno = $row->counter_no+1;
                
                $this->db->where('counter_code', 'cn_no');
                $this->db->where('counter_year', $tahun);
                $this->db->set('counter_no', $dsno);
                $this->db->update('counter_log');
            }
            else {
                //add new counter code
                $dsno = 1;
                $fields = array(
                    'counter_code'  => 'cn_no',
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
            $this->db->where('counter_code', 'cn_transno');
            $this->db->where('counter_year', $tahun);            
            $query = $this->db->get('counter_log');
            if ($query->num_rows() == 1){
                $row = $query->row();
                $transno = $row->counter_no+1;
                
                $this->db->where('counter_code', 'cn_transno');
                $this->db->where('counter_year', $tahun);
                $this->db->set('counter_no', $transno);
                $this->db->update('counter_log');
            }
            else {
                //add new counter code
                $transno = 1;
                $fields = array(
                    'counter_code'  => 'cn_transno',
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
                'b.company_name as branch_name',
                "(DATE_FORMAT(transaction_date, '%d-%m-%Y')) as transaction_date",
                'c.dept_name',
                'd.company_name',
                'cp',
                'is_add_manual',
                'used_amount',
            );
            
            $this->db->select($fields);
            $this->db->join('view_mst_branch b', 'b.company_code=a.branch_code', 'left');
            $this->db->join('mst_dept c', 'c.dept_id=a.dept_id', 'left');
            $this->db->join('mst_company d', 'd.company_code=a.company_code', 'left');            
            $query = $this->db->get('cn_transaction a');
            //echo $this->db->last_query();
            $nomor = 1;
            foreach($query->result() as $row):
                $data[] = array(
                    'nomor'              => $nomor,
                    'cn_no'              => $row->cn_no,
                    'transaction_no'     => $row->transaction_no,                    
                    'branch'             => $row->branch_name,                    
                    'transaction_date'   => $row->transaction_date,
                    'dept_id'            => $row->dept_name,
                    'company_code'       => $row->company_name,
                    'cp'                 => $row->cp,
                    'is_add_manual'      => $row->is_add_manual,
                    'used_amount'        => $row->used_amount
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
                    'cn_no'                => $row->cn_no,
                    'transaction_no'       => $row->transaction_no,                    
                    'branch_code'          => 'nama branch',
                    'transaction_date'     => $row->transaction_date,
                    'transaction_type_id'  => $row->transaction_type_id,
                    'dept_id'              => $row->dept_id,
                    'supplier_code'        => $row->supplier_code,
                    'cp'                   => $row->cp,
                    'is_add_manual'        => $row->is_add_manual,
                    'used_amount'          => $row->used_amount
                );
            }
            return $data;
        }
        
        public function save($params)
	{	
		$log = $this->session->all_userdata();
		$valid = false;
		
                $fields = array(
                    'branch_code'           => $params->branch_code,
                    'transaction_date'      => date('Y-m-d', strtotime($params->transaction_date)),
                    'dept_id'               => $params->dept_id,
                    'customer_code'         => $params->customer_code,
                    
                    //'transaction_type_id'   => $params->transaction_type_id,                    
                    //'cp'                    => $params->cp,
                    //'is_add_manual'         => $params->is_add_manual,
                    //'used_amount'           => $params->used_amount         
                );
		
		if (!empty($params->cn_no)) {
                    $this->db->set($fields);
                    $this->db->where("cn_no", $params->cn_no);
                    $valid = $this->db->update("cn_transaction");
                        
                    $valid = $this->logUpdate->addLog("update", "cn_transaction", $params);
		}
		else {
                    $cnno       = $this->get_cnno();
                    $trans_no   = $this->get_transno();
                    
                    $this->db->set($fields);
                    $this->db->set('cn_no', $cnno);
                    $this->db->set('transaction_no', $trans_no);
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