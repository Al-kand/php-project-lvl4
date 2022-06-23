<?php

namespace App\Http\Controllers;

use App\Models\Label;
use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\QueryBuilder;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user, TaskStatus $taskStatus)
    {
        $tasks = QueryBuilder::for(Task::class)
            ->allowedFilters(['status_id', 'created_by_id', 'assigned_to_id'])
            ->paginate();
        $users = $user->getNames();
        $taskStatuses = $taskStatus->getNames();
        return view('task.index', compact('tasks', 'users', 'taskStatuses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Models\TaTaskStatussk  $taskStatus
     * @param  \App\Models\User  $user
     * @param  \App\Models\Label  $label
     * @return \Illuminate\Http\Response
     */
    public function create(TaskStatus $taskStatus, User $user, Label $label)
    {
        $task = new Task();
        $users = $user->getNames();
        $taskStatuses = $taskStatus->getNames();
        $labels = $label->getNames();

        return view('task.create', compact('task', 'users', 'taskStatuses', 'labels'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'name' => 'required|string|unique:tasks',
            'description' => 'nullable|string',
            'status_id' => 'required|exists:App\Models\TaskStatus,id',
            'assigned_to_id' => 'nullable|exists:App\Models\User,id',
            'labels[]' => 'nullable|exists:App\Models\Label,id'
        ]);

        $autor = Auth::user();
        $task = new Task($data);
        $task->createdBy()->associate($autor);
        $task->save();

        $labels = array_filter($request->input('labels') ?? []);
        $task->labels()->sync($labels);

        flash(__('Task created successfully'))->success();
        return redirect()->route('tasks.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        return view('task.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @param  \App\Models\TaskStatus  $taskStatus
     * @param  \App\Models\User  $user
     * @param  \App\Models\Label  $label
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task, TaskStatus $taskStatus, User $user, Label $label)
    {
        $users = $user->getNames();
        $taskStatuses = $taskStatus->getNames();
        $labels = $label->getNames();
        return view('task.edit', compact('task', 'users', 'taskStatuses', 'labels'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        $data = $this->validate($request, [
            'name' => 'required|unique:tasks,name,' . $task->id,
            'description' => 'nullable|string',
            'status_id' => 'required|exists:App\Models\TaskStatus,id',
            'assigned_to_id' => 'nullable|exists:App\Models\User,id',
            'labels[]' => 'nullable|exists:App\Models\Label,id'
        ]);

        $task->fill($data);
        $task->save();

        $labels = array_filter($request->input('labels') ?? []);
        $task->labels()->sync($labels);

        flash(__('Task changed successfully'))->success();
        return redirect()->route('tasks.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();
        flash(__('Task removed successfully'))->success();
        return redirect()->route('tasks.index');
    }
}
