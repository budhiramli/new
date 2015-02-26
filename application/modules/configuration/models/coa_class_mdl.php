<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class coa_class_mdl extends CI_Model {
    
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
            $data = array();
            $fields = array(
                'class_id', 
                'class_name',
                'class_type_name',
            );
            
            $this->db->select($fields);
            $this->db->join('coa_class_type', 'coa_class_type.class_type_id=coa_class.class_type_id', 'left');
            $query = $this->db->get('coa_class');
            $nomor = 1;
            foreach($query->result() as $row):
                $data[] = array(
                    'nomor'                 => $nomor,
                    'class_id'              => $row->class_id, 
                    'class_name'            => $row->class_name,
                    'class_type_name'       => $row->class_type_name,
                );
                $nomor++;
            endforeach;
            return $data;
        }
        
        function getdataid($id)
        {
            $data = array();
            $fields = array(
                'class_id', 
                'class_name',
                'coa_class.class_type_id',
                'class_type_name',
            );
            
            $this->db->select($fields);
            $this->db->join('coa_class_type', 'coa_class_type.class_type_id=coa_class.class_type_id', 'left');
            
            $this->db->where('class_id', $id);
            $query = $this->db->get('coa_class');
            if ($query->num_rows() > 0){
                $row = $query->row();
                    $data = array(
                        'class_id'              => $row->class_id, 
                        'class_name'            => $row->class_name,
                        'class_type_id'         => $row->class_type_id,
                        'class_type_name'       => $row->class_type_name,
                    );
            }
            return $data;
        }
        
        function save($params)
        {
            return true;
        }
        
        function update($params, $id)
        {
            return true;
        }
        
        function delete($id)
        {
            return true;
        }
}        