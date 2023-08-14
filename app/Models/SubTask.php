<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubTask extends Model
{
    use HasFactory;

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function users()
    {
        return $this->hasManyThrough(User::class, TaskUser::class, 'task_id', 'id', 'task_id', 'task_id');
    }
}
