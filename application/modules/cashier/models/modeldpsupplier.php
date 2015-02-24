<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class modeldpsupplier extends CI_Model {
	
	public function __construct(){
            parent::__construct();
            $this->load->model('logUpdate');
	}
        
        function getrecordcount()
        {
            $data = $this->db->count_all_results('dp_supplier');
            return $data;
        }
        
        function getdatalist()
        {
            $fields = array(
                'id_dp_supplier',
                'dp_number',
                'transaksi_no',
                'tanggal_transaksi',
                'kode_vendor',
                'cp',
                'lg_no',
                'amount',
                'note',
            );
            $this->db->select($fields);
            $this->db->order_by('id_dp_supplier desc');
            $query = $this->db->get('dp_supplier');
            $nomor = 1;
            foreach($query->result() as $row):
                $data[] = array(
                    'nomor'             => $nomor,
                    'DT_RowId'          => $row->id_dp_supplier,
                    'id_dp_supplier'    => $row->id_dp_supplier,
                    'dp_number'         => $row->dp_number,
                    'transaksi_no'      => $row->transaksi_no,
                    'tanggal_transaksi' => $row->tanggal_transaksi,
                    'kode_vendor'       => $row->kode_vendor,
                    'cp'                => $row->cp,
                    'lg_no'             => $row->lg_no,
                    'amount'            => $row->amount,
                    'note'              => $row->note,
                );
                $nomor++;
            endforeach;
            return $data;
        }
        
        function getdataid($id)
        {
            $data = array();
            $fields = array(
                'id_dp_supplier',
                'dp_number',
                'transaksi_no',
                'tanggal_transaksi',
                'kode_vendor',
                'cp',
                'lg_no',
                'amount',
                'note',
            );
            $this->db->select($fields);
            $this->db->where('id_dp_supplier', $id);
            $query = $this->db->get('dp_supplier');
            if ($query->num_rows>0){
                $row = $query->row();
                $data = array(
                    'id_dp_supplier'    => $row->id_dp_supplier,
                    'dp_number'         => $row->dp_number,
                    'transaksi_no'      => $row->transaksi_no,
                    'tanggal_transaksi' => $row->tanggal_transaksi,
                    'kode_vendor'       => $row->kode_vendor,
                    'cp'                => $row->cp,
                    'lg_no'             => $row->lg_no,
                    'amount'            => $row->amount,
                    'note'              => $row->note,
                );
            }
            return $data;
        }
        
        function save($params)
        {
            $valid = true;
            $fields = array(
                'dp_number'         => $params->dp_number,
                'transaksi_no'      => $params->transaksi_no,
                'tanggal_transaksi' => $params->tanggal_transaksi,
                'kode_vendor'       => $params->kode_vendor,
                'cp'                => $params->cp,
                'lg_no'             => $params->lg_no,
                'currency'          => $params->currency,
                'amount'            => $params->amount,
                'note'              => $params->note,
            );
            
            $this->db->set($fields);
            if (!empty($params->btnsave)){
                $valid = $this->db->insert('dp_supplier');
                $id = $this->db->insert_id();
            }
            
            if (!empty($params->btnupdate)){
                $id = $params->id_dp_supplier;
                $this->db->where('id_dp_supplier', $id);
                $valid = $this->db->update('dp_supplier');
            }
            return $valid;
        }
        
        function delete($id)
        {
            // remove detail transaksi 1
            $this->db->where('id_dp_supplier', $id);
            $valid = $this->db->delete('dp_supplier_detail');
            if ($valid) {
                $this->db->where('id_dp_supplier', $id);
                $valid = $this->db->delete('dp_supplier');
            }
            return $valid;
        }
}	