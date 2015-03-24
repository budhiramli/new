<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class coaclassgroup_all_mdl extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    
    function getrecordcount()
    {
            $data = $this->db->count_all_results('coa_class_group');
            return $data;
    }
        
    function getdatalist()
    {
        $this->db->order_by('coa_group_id asc');
        $query = $this->db->get('coa_class_group');
        $nomor = 1;
        foreach($query->result() as $row):
            $data[] = array(
                'nomor'             => $nomor,
                'coa_group_id'     => $row->coa_group_id,
                'coa_group_name'   => $row->coa_group_name,                                
            ); 
            $nomor++;
        endforeach;
        return $data;
    }
}