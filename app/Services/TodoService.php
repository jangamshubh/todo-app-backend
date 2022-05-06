<?php

namespace App\Services;

use App\Models\Todo;
use Auth;
use App\Http\Requests\StoreTodoRequest;
use App\Http\Requests\UpdateTodoRequest;
use Carbon\Carbon;

class TodoService {

    public function getAllTodos() {
        $data = Todo::where('user_id',Auth::id())->get();
        return $this->retrieveSuccessMessage($data);
    }

    public function storeTodo($request) {
        $todo = new Todo;
        $todo->title = $request->title;
        $todo->description = $request->description;
        $todo->user_id = Auth::id();
        $todo->deadline = Carbon::parse($request->deadline)->format('d-m-Y H:i');
        $todo->priority = $request->priority;
        $todo->status = $request->status;
        $todo->save();
        return $this->storeSuccessMessage($todo);
    }

    public function editTodo($id) {
        $data = Todo::find($id);
        if($data->user_id = Auth::id()) {
            return $this->retrieveSuccessMessage($data);
        } else {
            return $this->addedByErrorMessage();
        }
    }

    public function updateTodo($request,$id) {
        $data = Todo::find($id);
        if($data->user_id = Auth::id()) {
            $data->title = $request->title;
            $data->description = $request->description;
            $data->deadline = Carbon::parse($request->deadline)->format('d-m-Y H:i');
            $data->priority = $request->priority;
            $data->status = $request->status;
            $data->update();
            return $this->updateSuccessMessage($data);
        } else {
            return $this->addedByErrorMessage();
        }
    }

    public function showTodo($id) {
        $data = Todo::find($id);
        if($data->user_id = Auth::id()) {
            return $this->retrieveSuccessMessage($data);
        } else {
            return $this->addedByErrorMessage();
        }
    }

    public function deleteTodo($id) {
        $data = Todo::find($id);
        if($data->user_id = Auth::id()) {
            $data->delete();
            return $this->deleteSuccessMessage();
        } else {
            return $this->addedByErrorMessage();
        }
    }

    protected function retrieveSuccessMessage($data) {
        $response['data'] = $data;
        $response['message'] = 'Data Retrieved Successfully';
        $response['status'] = 'success';
        return $response;
    }

    protected function storeSuccessMessage($todo) {
        $response['data'] = $todo;
        $response['message'] = 'Todo Added Successfully';
        $response['status'] = 'success';
        return $response;
    }

    protected function addedByErrorMessage() {
        $response['message'] = 'You have not added this todo!';
        $response['status'] = 'error';
        return $response;
    }

    protected function updateSuccessMessage($todo) {
        $response['data'] = $todo;
        $response['message'] = 'Todo Updated Successfully';
        $response['status'] = 'success';
        return $response;
    }

    protected function deleteSuccessMessage() {
        $response['message'] = 'Todo Deleted Successfully!';
        $response['status'] = 'success';
        return $response;
    }
}
