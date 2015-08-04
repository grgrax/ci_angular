<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Model extends CI_Model {

    const PENDING=0;
    const ACTIVE=1;
    const BLOCKED=2;
    const DELETED=3;

    static $param=array('status !='=>self::DELETED);

    //later
    function read_rows_by($param,$limit=null,$offset=null){
        try {
            if(!is_array($param)) throw new Exception("Error Processing Request, no array read_rows_by", 1);
            $this->db->order_by('id','desc');
            $rs = $this->db->get_where(static::$table, $param, $limit, $offset);
            // echo "<hr>".$this->db->last_query();
            return $rs->result_array();
        } catch (Exception $e) {
            $this->session->set_flashdata('error', $e->getMessage());
            redirect('dashboard');
        }
    }

    function read_row_by_n($param){
        try {
            if(!is_array($param)) throw new Exception("Error Processing Request, no array read_row_by_n", 1);
            $rs = $this->db->get_where(static::$table, $param);
            // echo "<hr>".$this->db->last_query();
            return $rs->first_row('array');
        } catch (Exception $e) {
            $this->session->set_flashdata('error', $e->getMessage());
            redirect('dashboard');
        }
    }

    public function create_row($data)
    {
        $this->db->insert(static::$table,$data);
    }
    public function update_row($id,$data)
    {
        $this->db->where('id',$id);
        $this->db->update(static::$table,$data);
    }
    // public function update_row_n($id,$data)
    // {
    //     $this->db->where('id',$id);
    //     $this->db->update(static::$table,$data);
    //     echo $this->db->last_query();
    //     die;
    //     return ($this->db->affected_rows() > 0) ? TRUE : FALSE; 
    // }
    public function read_row($id)
    {
        $this->db->select()
        ->from(static::$table)
        ->where('id',$id);
        $rs=$this->db->get();
        return ($rs->first_row('array'));
    }
    public function delete_row($id)
    {
        $this->db->where('id',$id);
        $this->db->update(static::$table,array('status' =>self::DELETED));
    }   

    static function get_rules(array $get_rules=NUll){
        if(!$get_rules){
            return static::$rules;
        }
        else{
            $applied_rules=[];
            foreach(static::$rules as $rule){
                if(in_array($rule['field'],$get_rules)){
                    $applied_rules[]=$rule;                 
                } 
            }
            return $applied_rules;
        }
    }

}

/* End of file mY_Model.php */
