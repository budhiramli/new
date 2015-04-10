<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class modeltransfer extends CI_Model {
	
	public function __construct(){
            parent::__construct();
            $this->load->model('logUpdate');
	}
        
        function get_billno()
        {
            $tahun = date('Y');
            //check first from counter_log
            $this->db->where('counter_code', 'billing');
            $this->db->where('counter_year', $tahun);            
            $query = $this->db->get('counter_log');
            if ($query->num_rows() == 1){
                $row = $query->row();
                $dsno = $row->counter_no+1;
                
                $this->db->where('counter_code', 'billing');
                $this->db->where('counter_year', $tahun);
                $this->db->set('counter_no', $dsno);
                $this->db->update('counter_log');
            }
            else {
                //add new counter code
                $dsno = 1;
                $fields = array(
                    'counter_code'  => 'billing',
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
            $this->db->where('counter_code', 'billing_transno');
            $this->db->where('counter_year', $tahun);            
            $query = $this->db->get('counter_log');
            if ($query->num_rows() == 1){
                $row = $query->row();
                $transno = $row->counter_no+1;
                
                $this->db->where('counter_code', 'billing_transno');
                $this->db->where('counter_year', $tahun);
                $this->db->set('counter_no', $transno);
                $this->db->update('counter_log');
            }
            else {
                //add new counter code
                $transno = 1;
                $fields = array(
                    'counter_code'  => 'billing_transno',
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
            $data = $this->db->count_all_results('billing_transaction');
            return $data;
        }
        
        function getdatalist()
        {
            $fields = array(
                'bill_no',
                "(DATE_FORMAT(transaction_date, '%d-%m-%Y')) as transaction_date",
                "(DATE_FORMAT(due_date, '%d-%m-%Y')) as due_date",
                'b.company_name',
                'c.company_name as branch_name',
            );
            $this->db->select($fields);
            $this->db->join('mst_company b', 'b.company_code=a.company_code', 'left');
            $this->db->join('view_mst_branch c', 'c.company_code=a.branch_code', 'left');
            
            $this->db->order_by('bill_no desc');
            $query = $this->db->get('billing_transaction a');
            //echo $this->db->last_query();
            $nomor = 1;
            $data = array();
            foreach($query->result() as $row):
                $data[] = array(
                    'nomor'                 => $nomor,
                    'DT_RowId'              => $row->bill_no,
                    'bill_no'                 => $row->bill_no,
                    'transaction_date'      => $row->transaction_date,
                    'due_date'              => $row->due_date,                    
                    'company_name'          => $row->company_name,
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
                'bill_no',
                "(DATE_FORMAT(transaction_date, '%d-%m-%Y')) as transaction_date",
                "(DATE_FORMAT(due_date, '%d-%m-%Y')) as due_date",
                'company_code',
                'branch_code',
                
            );
            $this->db->select($fields);
            $this->db->where('bill_no', $id);
            $query = $this->db->get('billing_transaction');
            if ($query->num_rows>0){
                $row = $query->row();
                $data = array(
                    'bill_no'               => $row->bill_no,
                    'transaction_date'      => $row->transaction_date,
                    'due_date'              => $row->due_date,                    
                    'company_code'          => $row->company_code,
                    'branch_code'           => $row->branch_code,
                );
            }
            return $data;
        }
        
        function save($params)
        {
            $valid = true;
            
            $fields = array(
                'transaction_date'      => date('Y-m-d', strtotime($params->transaction_date)),
                'due_date'              => date('Y-m-d', strtotime($params->due_date)),
            );
            
            if (!empty($params->btnsave)){
                print_r($params);
                $billno  = $this->get_billno();
                $this->db->set($fields);            
                $this->db->set('bill_no', $billno);
                $valid = $this->db->insert('billing_transaction');
                
            }
            
            if (!empty($params->btnupdate)){
                $this->db->set($fields);            
                $id = $params->bill_no;
                $this->db->where('bill_no', $id);
                $valid = $this->db->update('billing_transaction');
            }
            
            
            return true;
        }
        
        function delete($id)
        {
            // remove detail transaksi 1
            $this->db->where('bill_no', $id);
            $valid = $this->db->delete('billing');
            if ($valid) {
                $this->db->where('billing', $id);
                $valid = $this->db->delete('billing_transaction');
            }
            return $valid;
        }
}	