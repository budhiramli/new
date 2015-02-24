<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class modelcheque extends CI_Model {
	
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
                'id_cheque', 
                'bg_prefix',
                'bg_no',
                'transaksi_no', 
                'tanggal_transaksi', 
                'due_date',
                'ref_prefix', 
                'ref_type', 
                'cp', 
                'bank_nama', 
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
                    'id_cheque'             => $row->id_cheque,
                    'branch'                => 'nama_cabang',
                    'bg_no'                 => $row->bg_no, 
                    'transaksi_no'          => $row->transaksi_no, 
                    'tanggal_transaksi'     => $row->tanggal_transaksi,
                    'due_date'              => $row->due_date,
                    'ref_type'              => $row->ref_type, 
                    'cp'                    => $row->cp, 
                    'bank_nama'             => $row->bank_nama,
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
                'id_cheque', 
                'bg_prefix',
                'bg_no',
                'transaksi_no', 
                'tanggal_transaksi', 
                'due_date',
                'ref_prefix', 
                'ref_type', 
                'cp', 
                'bank_nama', 
                'currency', 
                'amount', 
                'is_balance',
            );
            $this->db->select($fields);
            $this->db->where('id_cheque', $id);
            $query = $this->db->get('cheque_transaction');
            if ($query->num_rows>0){
                $row = $query->row();
                $data = array(
                    'id_cheque'             => $row->id_cheque,
                    'branch'                => '',
                    'bg_no'                 => $row->bg_no, 
                    'transaksi_no'          => $row->transaksi_no, 
                    'tanggal_transaksi'     => $row->tanggal_transaksi,
                    'due_date'              => $row->due_date,
                    'ref_type'              => $row->ref_type, 
                    'cp'                    => $row->cp, 
                    'bank_nama'             => $row->bank_nama,
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
		
		$this->db->set("id_cabang", $params->id_cabang );
		$this->db->set("ref_no", $params->ref_no );
		$this->db->set("transaksi_no", $params->transaksi_no );
		$this->db->set("tanggal_transaksi", $params->tanggal_transaksi );		
		$this->db->set("id_customer", $params->id_customer );
		$this->db->set("cp", $params->cp );		
		$this->db->set("nama_bank", $params->nama_bank );
		$this->db->set("amount", $params->amount );
		$this->db->set("note", $params->note );
                
		if (!empty($params->id)) {
			$this->db->where("id_cc", $params->id);
			$valid = $this->db->update("cc_transaction");
                        
			$valid = $this->logUpdate->addLog("update", "cc_transaction", $params);
		}
		else {
			$valid = $this->db->insert('cc_transaction');
			
                        $valid = $this->logUpdate->addLog("insert", "cc_transaction", $params);
                        
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
		$valid = $this->logUpdate->addLog("delete", "cc_transaction", array("id_cc_transaction" => $id));	
		
		if ($valid){
			$this->db->where('id_cc_transaction', $id);
			$valid = $this->db->delete('cc_transaction');
		}
		
		return $valid;		
	}
}	