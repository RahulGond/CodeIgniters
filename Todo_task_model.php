<?php 

/**
* 
*/
class Todo_task_model extends CI_Model{
    function __construct() {
        parent::__construct();
    }

	public function insertTask($task){
        try{
            $now = date_ind('Y-m-d H:i:s');
            $data = array(
                'task'=>"$task",
                'created_datetime'=>"$now",
                'modified_datetime'=>"$now",
                'author'=>"ADMIN",
                'status'=>"pending"
            );
            $query = $this->db->insert('todo_task', $data);
            return $query;
        }
        catch(Exception $e){
            return false;
        }
    }

    public function deleteTask($id){
        try{
            $this->db->where('seq_no', $id);
            $result = $this->db->delete('todo_task');
            return $result;
        }
        catch(Exception $e){
            return false;
        }
    }

    public function update($id, $new_task){
        try{
            $this->db->where('seq_no', $id);
            $data = array(
                'task'=>"$new_task",
                'modified_datetime'=>date_ind('Y-m-d H:i:s'),
            );
            $result = $this->db->update('todo_task', $data);
            return $result;
        }
        catch(Exception $e){
            return false;
        }
    }

    public function done($id){
        try{
            $this->db->where('seq_no', $id);
            $data = array(
                'modified_datetime'=>date_ind('Y-m-d H:i:s'),
                'status'=>"done"
            );
            $result = $this->db->update('todo_task', $data);
            return $result;
        }
        catch(Exception $e){
            return false;
        }
    }

    public function undo($id){
        try{
            $this->db->where('seq_no', $id);
            $data = array(
                'modified_datetime'=>date_ind('Y-m-d H:i:s'),
                'status'=>"pending"
            );
            $result = $this->db->update('todo_task', $data);
            return $result;
        }
        catch(Exception $e){
            return false;
        }
    }

    public function getPendingTasks(){
        try{
            $query = $this->db->get_where('todo_task', array('status'=>"pending"));
            if($query)
                return $query->result();//->result_array();
            else
                return array();
        }
        catch(Exception $ci){
            return array();
        }
    }

    public function getDoneTasks(){
        try{
            $query = $this->db->get_where('todo_task', array('status'=>"done"));
            if($query)
                return $query->result();//->result_array();
            else
                return array();
        }
        catch(Exception $ci){
            return array();
        }
    }
}