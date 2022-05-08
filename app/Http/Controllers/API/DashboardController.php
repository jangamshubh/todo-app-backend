<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Todo;
use Auth;
class DashboardController extends Controller
{
    public function index() {
        if(Auth::user()) {
            $todos = Todo::where('user_id',Auth::id());
            $total_todos = $todos->count();
            $pending_todos = Todo::where('user_id',Auth::id())->where('status','Pending')->count();
            $in_progress_todos = Todo::where('user_id',Auth::id())->where('status','In Progress')->count();
            $done_todos = Todo::where('user_id',Auth::id())->where('status','Done')->count();
            return response()->json([
                'status' => 'success',
                'message' => 'Retrieved Successfully',
                'total_todos' => $total_todos,
                'pending_todos' => $pending_todos,
                'in_progress_todos' => $in_progress_todos,
                'done_todos' => $done_todos,
            ]);
        }
    }
}
