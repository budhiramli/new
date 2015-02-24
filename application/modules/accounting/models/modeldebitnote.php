<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ModelDebitNote extends CI_Model {
    function __construct() {
        parent::__construct();
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
                'id_dn', 
                'dn_no',
                'transaksi_no',
                'tanggal_transaksi',
                'transaksi_type',
                'id_cabang',
                'id_dept',
                'kode_vendor',                
                'used_sap_amount',
                'used_amount',
            );
            
            $this->db->select($fields);
            $query = $this->db->get('dn_transaction');
            $nomor = 1;
            foreach($query->result() as $row):
                $data[] = array(
                    'nomor'              => $nomor,
                    'id_dn'                 => $row->id_dn, 
                    'dn_no'                 => $row->dn_no,
                    'transaksi_no'          => $row->transaksi_no,
                    'tanggal_transaksi'     => $row->tanggal_transaksi,
                    'transaksi_type'        => $row->transaksi_type,
                    'branch'                => 'nama cabang',
                    'dept'                  => 'nama dept',
                    'vendor'                => 'nama vendor',
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
                'id_dn', 
                'dn_no',
                'transaksi_no',
                'tanggal_transaksi',
                'transaksi_type',
                'id_cabang',
                'id_dept',
                'kode_vendor',
                'used_sap_amount',
                'used_amount',
            );
            $this->db->select($fields);
            $this->db->where('id_cc', $id);
            $query = $this->db->get('dn_transaction');
            if ($query->num_rows>0){
                $row = $query->row();
                $data = array(
                    'id_dn'                 => $row->id_dn, 
                    'dn_no'                 => $row->dn_no,
                    'transaksi_no'          => $row->transaksi_no,
                    'tanggal_transaksi'     => $row->tanggal_transaksi,
                    'transaksi_type'        => $row->transaksi_type,
                    'branch'                => 'nama cabang',
                    'dept'                  => 'nama dept',
                    'kode_vendor'           => $row->kode_vendor,
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
                    'dn_no'                 => $params->dn_no,
                    'transaksi_no'          => $params->transaksi_no,
                    'tanggal_transaksi'     => $params->tanggal_transaksi,
                    'transaksi_type'        => $params->transaksi_type,
                    'id_cabang'             => $params->id_cabang,
                    'id_dept'               => $params->id_dept,
                    'kode_vendor'           => $params->kode_vendor,
                                
                );
		
		if (!empty($params->id)) {
			$this->db->where("id_dn", $params->id);
			$valid = $this->db->update("dn_transaction");
                        
			$valid = $this->logUpdate->addLog("update", "dn_transaction", $params);
		}
		else {
			$valid = $this->db->insert('dn_transaction');
			
                        $valid = $this->logUpdate->addLog("insert", "dn_transaction", $params);
                        
		}
		
		return true;		
	}
        
        public function delete($id)
	{	
		$log = $this->session->all_userdata();
		$valid = false;		
		$valid = $this->logUpdate->addLog("delete", "dn_transaction", array("id_dn" => $id));	
		
		if ($valid){
			$this->db->where('id_dn', $id);
			$valid = $this->db->delete('dn_transaction');
		}
		
		return $valid;		
	}
    
}    