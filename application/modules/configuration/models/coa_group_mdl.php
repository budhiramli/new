<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class coa_group_mdl extends CI_Model {
    
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
            $data = array();
            $fields = array(
                'a.coa_group_id', 
                'a.coa_group_name',
                'a.coa_parent_id',
                'a.class_id',
                'b.coa_group_name as coa_parent_name',
                'class_name'
            );
            
            $this->db->select($fields);
            $this->db->join('coa_class', 'coa_class.class_id=a.class_id', 'left');
            $this->db->join('coa_class_group b', 'b.coa_group_id=a.coa_parent_id', 'left');
            
            $query = $this->db->get('coa_class_group a');
            $nomor = 1;
            foreach($query->result() as $row):
                $data[] = array(
                    'nomor'                => $nomor,
                    'coa_group_id'         => $row->coa_group_id,
                    'coa_group_name'       => $row->coa_group_name,
                    'coa_parent_id'        => $row->coa_parent_id,
                    'coa_parent_name'        => $row->coa_parent_name,                    
                    'class_id'             => $row->class_id,
                    'class_name'             => $row->class_name,
                );
                $nomor++;
            endforeach;
            return $data;
        }
        
        function getdataid($id)
        {
            $data = array();
            $fields = array(
                'coa_group_id', 
                'coa_group_name',
                'coa_parent_id',
                'class_id'
            );
            
            $this->db->select($fields);
            $this->db->where('coa_group_id', $id);
            $query = $this->db->get('coa_class_group');
            if ($query->num_rows() > 0){
                $row = $query->row();
                    $data = array(
                        'coa_group_id'         => $row->coa_group_id,
                        'coa_group_name'       => $row->coa_group_name,
                        'coa_parent_id'        => $row->coa_parent_id,
                        'class_id'             => $row->class_id,
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