<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ModelDebitNote extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    
    function get_dnno()
        {
            $tahun = date('Y');
            //check first from counter_log
            $this->db->where('counter_code', 'dn_no');
            $this->db->where('counter_year', $tahun);            
            $query = $this->db->get('counter_log');
            if ($query->num_rows() == 1){
                $row = $query->row();
                $dsno = $row->counter_no+1;
                
                $this->db->where('counter_code', 'dn_no');
                $this->db->where('counter_year', $tahun);
                $this->db->set('counter_no', $dsno);
                $this->db->update('counter_log');
            }
            else {
                //add new counter code
                $dsno = 1;
                $fields = array(
                    'counter_code'  => 'dn_no',
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
            $this->db->where('counter_code', 'dn_transno');
            $this->db->where('counter_year', $tahun);            
            $query = $this->db->get('counter_log');
            if ($query->num_rows() == 1){
                $row = $query->row();
                $transno = $row->counter_no+1;
                
                $this->db->where('counter_code', 'dn_transno');
                $this->db->where('counter_year', $tahun);
                $this->db->set('counter_no', $transno);
                $this->db->update('counter_log');
            }
            else {
                //add new counter code
                $transno = 1;
                $fields = array(
                    'counter_code'  => 'dn_transno',
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
                'b.company_name as branch_name',
                'dept_name',
                'supplier_name',
                'used_sap_amount',
                'used_amount',
            );
            
            $this->db->select($fields);
            $this->db->join('view_mst_branch b', 'b.company_code=a.branch_code', 'left');
            $this->db->join('mst_dept c', 'c.dept_id=a.dept_id', 'left');
            $this->db->join('mst_supplier d', 'd.supplier_code=a.supplier_code', 'left');
            $query = $this->db->get('dn_transaction a');
            $nomor = 1;
            foreach($query->result() as $row):
                $data[] = array(
                    'nomor'                 => $nomor,
                    'dn_no'                 => $row->dn_no,
                    'transaction_no'        => $row->transaction_no,
                    'transaction_date'      => $row->transaction_date,
                    'transaction_type_id'   => $row->transaction_type_id,
                    'branch'                => $row->branch_name,
                    'dept_name'             => $row->dept_name,
                    'supplier_name'         => $row->supplier_name,
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
                    'transaction_date'     => date('Y-m-d', strtotime($params->transaction_date)),
                    'transaction_type_id'  => $params->transaction_type_id,
                    'branch_code'          => $params->branch_code,
                    'dept_id'              => $params->dept_id,
                    'supplier_code'        => $params->supplier_code,
                                
                );
		
		if (!empty($params->dn_no)) {
                        $this->db->set($fields);
			$this->db->where("dn_no", $params->id);
			$valid = $this->db->update("dn_transaction");                        
			$valid = $this->logUpdate->addLog("update", "dn_transaction", $params);
		}
		else {
                    $dn_no = $this->get_dnno();
                    $trans_no = $this->get_transno();
                    
                    $this->db->set($fields);
                    $this->db->set('dn_no', $dn_no);
                    $this->db->set('transaction_no', $trans_no);
                    
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