<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    protected $table = 'todos';
    protected $fillable = ['user_id','title','description','deadline','status','priority'];

    public function todos_get_user() {
        return $this->belongsTo('App\Models\User','user_id');
    }
}
