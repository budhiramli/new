<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class classtype_all_mdl extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    
    function getrecordcount()
    {
            $data = $this->db->count_all_results('coa_class_type');
            return $data;
    }
        
    function getdatalist()
    {
        $this->db->order_by('class_type_id asc');
        $query = $this->db->get('coa_class_type');
        $nomor = 1;
        foreach($query->result() as $row):
            $data[] = array(
                'nomor'             => $nomor,
                'class_type_id'     => $row->class_type_id,
                'class_type_name'   => $row->class_type_name,                                
            ); 
            $nomor++;
        endforeach;
        return $data;
    }
}