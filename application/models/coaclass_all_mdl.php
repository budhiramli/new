<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class coaclass_all_mdl extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    
    function getrecordcount()
    {
            $data = $this->db->count_all_results('coa_class');
            return $data;
    }
        
    function getdatalist()
    {
        $this->db->order_by('class_id asc');
        $query = $this->db->get('coa_class');
        $nomor = 1;
        foreach($query->result() as $row):
            $data[] = array(
                'nomor'             => $nomor,
                'class_id'     => $row->class_id,
                'class_name'   => $row->class_name,                                
            ); 
            $nomor++;
        endforeach;
        return $data;
    }
}