<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Todo extends MY_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model('Todo_task_model');
    }

    public function index(){
		$data['status_code'] = 200;
		$data['status_msg'] = "This is test index method, please user another method";
		$this->response($data);
	}

    public function addTask(){
        $param = $this->input->post();
        $inserted = $this->Todo_task_model->insertTask($param['task']);
        if($inserted){
            $result = array(
                'status_code'=>200,
                'status_msg'=>"task inserted"
            );
        }
        else{
            $result = array(
                'status_code'=>400,
                'status_msg'=>"task not inserted"
            );
        }

        $this->response($result);
    }

    public function deleteTask(){
        $param = $this->input->post();
        $deleted = $this->Todo_task_model->deleteTask($param['id']);
        if($deleted){
            $result = array(
                'status_code'=>200,
                'status_msg'=>"task Deleted"
            );
        }
        else{
            $result = array(
                'status_code'=>400,
                'status_msg'=>"task not deleted"
            );
        }
        $this->response($result);
    }

    public function updateTask(){
        $param = $this->input->post();
        $deleted = $this->Todo_task_model->update($param['id'], $param['task']);
        if($deleted){
            $result = array(
                'status_code'=>200,
                'status_msg'=>"task Updated"
            );
        }
        else{
            $result = array(
                'status_code'=>400,
                'status_msg'=>"task not updated"
            );
        }
        $this->response($result);
    }

    public function markDone(){
        $param = $this->input->post();
        $deleted = $this->Todo_task_model->done($param['id']);
        if($deleted){
            $result = array(
                'status_code'=>200,
                'status_msg'=>"task mark as done"
            );
        }
        else{
            $result = array(
                'status_code'=>400,
                'status_msg'=>"task can not be mark as done"
            );
        }
        $this->response($result);
    }

    public function undoTask(){
        $param = $this->input->post();
        $deleted = $this->Todo_task_model->undo($param['id']);
        if($deleted){
            $result = array(
                'status_code'=>200,
                'status_msg'=>"task undo"
            );
        }
        else{
            $result = array(
                'status_code'=>400,
                'status_msg'=>"task can not undo"
            );
        }
        $this->response($result);
    }

    public function refreshTask(){
        $pendingTask = $this->Todo_task_model->getPendingTasks();
        $doneTask = $this->Todo_task_model->getDoneTasks();
        $result = array('pending_task'=>$pendingTask, 'done_task'=>$doneTask);
        $this->response($result);
    }
}
