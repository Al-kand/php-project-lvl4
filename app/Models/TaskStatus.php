<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Task;

/**
 * App\Models\TaskStatus
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|Task[] $tasks
 */
class TaskStatus extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function tasks()
    {
        return $this->hasMany(Task::class, 'status_id');
    }

    public function getNames()
    {
        return $this->select('id', 'name')
            ->get()
            ->mapWithKeys(function ($item) {
                return [$item['id'] => $item['name']];
            });
    }
}
