<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Task;

/**
 * App\Models\Label
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|Task[] $tasks
 */
class Label extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    public function tasks()
    {
        return $this->belongsToMany(Task::class);
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
