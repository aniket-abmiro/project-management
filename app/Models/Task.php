<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function subTasks()
    {
        return $this->hasMany(SubTask::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'task_user');
    }
}
