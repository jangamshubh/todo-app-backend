<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\TodoService;
use App\Http\Requests\StoreTodoRequest;
use App\Http\Requests\UpdateTodoRequest;

class TodoController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api');
    }

    public function index() {
        $service = new TodoService;
        $data = $service->getAllTodos();
        if($data['status'] == 'success') {
            return $this->successMessage($data);
        } else {
            return $this->errorMessage($data);
        }
    }

    public function store(StoreTodoRequest $request) {
        $service = new TodoService;
        $data = $service->storeTodo($request);
        if($data['status'] == 'success') {
            return $this->successMessage($data);
        } else {
            return $this->errorMessage($data);
        }
    }


    public function edit($id) {
        $service = new TodoService;
        $data = $service->editTodo($id);
        if($data['status'] == 'success') {
            return $this->successMessage($data);
        } else {
            return $this->errorMessage($data);
        }
    }

    public function update(UpdateTodoRequest $request,$id) {
        $service = new TodoService;
        $data = $service->updateTodo($request,$id);
        if($data['status'] == 'success') {
            return $this->successMessage($data);
        } else {
            return $this->errorMessage($data);
        }
    }

    public function delete($id) {
        $service = new TodoService;
        $data = $service->deleteTodo($id);
        if($data['status'] == 'success') {
            return $this->successMessage($data);
        } else {
            return $this->errorMessage($data);
        }
    }

    public function show($id) {
        $service = new TodoService;
        $data = $service->showTodo($id);
        if($data['status'] == 'success') {
            return $this->successMessage($data);
        } else {
            return $this->errorMessage($data);
        }
    }

    protected function successMessage($data) {
        return response()->json([
            'data' => $data['data'],
            'message' => $data['message'],
            'status' => $data['status'],
        ]);
    }

    protected function errorMessage($data) {
        return response()->json([
            'message' => $data['message'],
            'status' => $data['status'],
        ]);
    }
}
