<?php

namespace App\Http\Controllers;

use App\Enums\UserType;
use App\Http\Requests\TaskRequest;
use App\Models\Statistic;
use App\Models\Task;
use App\Models\User;
use App\Services\TaskService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    public function __construct(private TaskService $taskService)
    {
    }

    public function index()
    {
        $tasks = $this->taskService->get();
        return view('tasks.index', compact('tasks'));
    }

    public function create(Request $request)
    {
        if ($request->ajax()) {
            return $this->taskService->getUsersData($request->term, UserType::array()[$request->userType], $request->page);
        }
        return view('tasks.create');
    }

    public function store(TaskRequest $request)
    {
        return $this->taskService->create(
            title: $request->title,
            description: $request->description,
            adminID: $request->assigned_by_id,
            userID: $request->assigned_to_id
        );
    }
}
