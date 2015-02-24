<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class modeldpsupplierdetail extends CI_Model {
	
	public function __construct(){
            parent::__construct();
            $this->load->model('logUpdate');
	}
        
        function getdatalist($id)
        {
            $fields = array(
                'id_dp_supplier_detail',
                'id_ref',
                'no_ref',
                'currency',
                'amount',
                'name', 
                'used_date',
            );
            $this->db->select($fields);
            $this->db->where('id_dp_supplier', $id);
            $query = $this->db->get('dp_supplier_detail');
            foreach($query->result() as $row):
                $data[] = array(
                    'nomor'         => $nomor, 
                    'DT_RowId'      => $row->id_dp_supplier_detail,
                    'id_dp_supplier_detail'      => $row->id_dp_supplier_detail,
                    'id_ref'        => $row->id_ref,
                    'no_ref'        => $row->no_ref,
                    'currency'      => $row->currency,
                    'amount'        => $row->amount,
                    'name'          => $row->nama, 
                    'used_date'     => $row->used_date,
                );
            endforeach;
            return $data;
        }

}	