<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ModelPvtrans extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    
    
    function get_pvno()
        {
            $tahun = date('Y');
            //check first from counter_log
            $this->db->where('counter_code', 'pv_no');
            $this->db->where('counter_year', $tahun);            
            $query = $this->db->get('counter_log');
            if ($query->num_rows() == 1){
                $row = $query->row();
                $dsno = $row->counter_no+1;
                
                $this->db->where('counter_code', 'pv_no');
                $this->db->where('counter_year', $tahun);
                $this->db->set('counter_no', $dsno);
                $this->db->update('counter_log');
            }
            else {
                //add new counter code
                $dsno = 1;
                $fields = array(
                    'counter_code'  => 'pv_no',
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
            $this->db->where('counter_code', 'pv_transno');
            $this->db->where('counter_year', $tahun);            
            $query = $this->db->get('counter_log');
            if ($query->num_rows() == 1){
                $row = $query->row();
                $transno = $row->counter_no+1;
                
                $this->db->where('counter_code', 'pv_transno');
                $this->db->where('counter_year', $tahun);
                $this->db->set('counter_no', $transno);
                $this->db->update('counter_log');
            }
            else {
                //add new counter code
                $transno = 1;
                $fields = array(
                    'counter_code'  => 'pv_transno',
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
            $data = $this->db->count_all_results('pv_transaction');
            return $data;
    }
        
    function getdatalist()
        {
            $data = array();
            $fields = array(
                'pv_no',
                'transaction_no',
                'payment_type_name',
                "(DATE_FORMAT(transaction_date, '%d-%m-%Y')) as transaction_date",
                "(DATE_FORMAT(due_date, '%d-%m-%Y')) as due_date",                
                'lg_no',
                'receipt_by',
                'supplier_name',
            );
            
            $this->db->select($fields);
            $this->db->join('payment_type', 'payment_type.payment_type_id=pv_transaction.payment_type_id', 'left');
            $this->db->join('mst_supplier', 'mst_supplier.supplier_code=pv_transaction.supplier_code', 'left');
            
            $query = $this->db->get('pv_transaction');
            $nomor = 1;
            foreach($query->result() as $row):
                $data[] = array(
                    'nomor'                 => $nomor,
                    'pv_no'                 => $row->pv_no,
                    'transaction_no'        => $row->transaction_no,
                    'transaction_date'      => $row->transaction_date,
                    'payment_type_name'   => $row->payment_type_name,
                    'lg_no'                 => $row->lg_no,
                    'receipt_by'            => $row->receipt_by,
                    'supplier_name'         => $row->supplier_name,
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
                'payment_type_id',
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
                    'payment_type_id'        => $row->payment_type_id,                    
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
                $supplier_code = explode(' ',trim($params->supplier_code));
                $fields = array(
                    'transaction_date'      => date('Y-m-d', strtotime($params->transaction_date)),
                    'due_date'              => date('Y-m-d', strtotime($params->due_date)),                    
                    'payment_type_id'       => trim($params->payment_type_id),                    
                    'payment_method_id'     => trim($params->payment_method_id),                                        
                    'receipt_by'            => $params->receipt_by,
                    'supplier_code'         => $supplier_code[0],      
                );
		
                if (!empty($params->pv_no)) {
                        $this->db->set($fields);
			$this->db->where("pv_no", $params->pv_no);
			$valid = $this->db->update("pv_transaction");                        
			$valid = $this->logUpdate->addLog("update", "pv_transaction", $params);
		}
		else {
                        $pv_no = $this->get_pvno();
                        $trasno = $this->get_transno();
                        $this->db->set($fields);
                        $this->db->set('pv_no', $pv_no);
                        $this->db->set('transaction_no', $trasno);                        
			$valid = $this->db->insert('pv_transaction');
			
                        $valid = $this->logUpdate->addLog("insert", "pv_transaction", $params);
                        
		}
		
		return true;		
	}
        
        public function delete($id)
	{	
		$log = $this->session->all_userdata();
		$valid = false;		
                $this->db->where('pv_no', $id);
                $valid = $this->db->delete('pv_transaction');
                        
		if ($valid){
			
                        $valid = $this->logUpdate->addLog("delete", "pv_transaction", $id);	
		}
		
		return $valid;		
	}
}    