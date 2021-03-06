<?php

class api extends CI_Controller
{
	public function _construct()
	{
		$this->load->modal('todo_modal');
	}

	public function get_task()
	{
    	if(! $this->get('id'))	{

        	$tasks = $this->task_modal->get_all(); // return all record
    	} else {

        	$tasks = $this->task_modal->get_task($this->get('id')); // return a record based on id
 
    	if($tasks)	{

        $this->response($tasks, 200); // return success code if record exist
    	} else 	{
        $this->response([], 404); // return empty
    	}
	}
}
	
	public function tasks_post()
	{
    	if(! $this->post('title'))
    	{
        $this->response(array('error' => 'Missing post data: title'), 400);
    	}

    	else 
    	{
         $data = array('title' => $this->post('title'));
    	}

    		$this->db->insert('task',$data);
    		if($this->db->insert_id() > 0)
    	{
        $message = array('id' => $this->db->insert_id(), 'title' => $this->post('title'));
        $this->response($message, 200);
    	}
}
public function tasks_put()
{
    if(! $this->put('title'))
    {
        $this->response(array('error' => 'Task title is required'), 400);
    }
 
    $data = array(
        'title'     => $this->put('title'),
        'status'    => $this->put('status')
    );
    $this->task_modal->update_task($this->put('id'), $data);
    $message = array('success' => $this->put('title').' Updated!');
    $this->response($message, 200);
}

public function tasks_delete($id=NULL)
{
    if($id == NULL)
    {
        $message = array('error' => 'Missing delete data: id');
        $this->response($message, 400);
    } else {
        $this->task_modal->delete_task($id);
        $message = array('id' => $id, 'message' => 'DELETED!');
        $this->response($message, 200);
    }
}

?>