<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class modelbillingdetail extends CI_Model {
	
	public function __construct(){
            parent::__construct();
            $this->load->model('logUpdate');
	}
        
        function getrecordcount($billno)
        {
            $this->db->where('bill_no', $billno);            
            $data = $this->db->count_all_results('billing_transaction_detail');
            return $data;
        }
        
        function getdatalist($billno)
        {
            $fields = array(
                'bill_no',
                'currency',
                'amount',
                "(IF(is_paid ='TRUE', 'PAID', 'UNPAID')) as is_paid"
                
            );
            $this->db->select($fields);
            $this->db->where('bill_no', $billno);
            $this->db->order_by('bill_detail_id');
            $query = $this->db->get('billing_transaction_detail');
            
            //echo $this->db->last_query();
            $nomor = 1;
            $data = array();
            foreach($query->result() as $row):
                $data[] = array(
                    'nomor'                 => $nomor,
                    'DT_RowId'            => $row->bill_detail_id,
                    'bill_detail_id'         => $row->bill_detail_id,
                    'currency'             => $row->currency,
                    'amount'              => $row->amount,
                    'is_paid'               => $row->is_paid,
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
                 'currency',
                "amount",
                'is_paid'
            );
            $this->db->select($fields);
            $this->db->where('bill_no', $id);
            $query = $this->db->get('billing_transaction_detail');
            if ($query->num_rows>0){
                $row = $query->row();
                $data = array(
                    'bill_no'                   => $row->bill_no,
                    'bill_detail_id'         => $row->bill_detail_id,
                    'currency'             => $row->currency,
                    'amount'              => $row->amount,
                    'is_paid'               => $row->is_paid
                );
            }
            return $data;
        }
        
        function save($params, $billno)
        {
            $valid = true;
            
            $fields = array(
                'bill_no'       => $billno,
                
            );
            
            if (!empty($params->btnsave)){
                $this->db->set($fields);            
                $valid = $this->db->insert('billing_transaction_detail');
            }
            
            if (!empty($params->btnupdate)){
                $this->db->set($fields);            
                $id = $params->bill_detail_id;
                $this->db->where('bill_detail_id', $id);
                $valid = $this->db->update('billing_transaction_detail');
            }
            return true;
        }
        
        function delete($id)
        {
            // remove detail transaksi 1
            $this->db->where('bill_detail_id', $id);
            
            //$valid = $this->db->delete('billing');
            //if ($valid) {
            //    $this->db->where('billing', $id);
            //    $valid = $this->db->delete('billing_transaction');
            //}
            return $valid;
        }
}	