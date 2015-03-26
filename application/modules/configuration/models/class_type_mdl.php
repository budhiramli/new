<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Class_type_mdl extends CI_Model {
    
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
            $data = array();
            $fields = array(
                'class_type_id', 
                'class_type_name',                
            );
            
            $this->db->select($fields);
            $this->db->order_by('class_type_id asc');            
            $query = $this->db->get('coa_class_type');
            $nomor = 1;
            foreach($query->result() as $row):
                $data[] = array(
                    'nomor'                 => $nomor,
                    'class_type_id'              => $row->class_type_id, 
                    'class_type_name'            => $row->class_type_name,
                );
                $nomor++;
            endforeach;
            return $data;
        }
        
        function getdataid($id)
        {
            $data = array();
            $fields = array(
                'class_type_id', 
                'class_type_name',
            );
            
            $this->db->select($fields);
            $this->db->where('class_type_id', $id);
            $query = $this->db->get('coa_class_type');
            if ($query->num_rows() > 0){
                $row = $query->row();
                    $data = array(
                        'class_type_id'              => $row->class_type_id, 
                        'class_type_name'            => $row->class_type_name,
                    );
            }
            return $data;
        }
        
        function add($params)
        {
            $fields = array(
                'class_type_id'     => $params->class_type_id, 
                'class_type_name'   => $params->class_type_name,
            );
            $this->db->set($fields);
            $this->db->insert('coa_class_type');
            return true;
        }
        
        function update($params, $id)
        {
            $fields = array(
                'class_type_id'     => $params->class_type_id, 
                'class_type_name'   => $params->class_type_name,
            );
            $this->db->set($fields);
            $this->db->where('class_type_id', $id);
            $this->db->update('coa_class_type');
            return true;
        }
        
        function del($id)
        {
            $this->db->where('class_type_id', $id);
            $this->db->delete('coa_class_type');
            return true;
        }
}        