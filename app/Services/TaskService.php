<?php

namespace App\Services;

use App\Enums\UserType;
use App\Models\Statistic;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class TaskService
{
  /**
   * Retrieve Paginated tasks
   */
  public function get()
  {
    return Task::with('admin', 'user')->paginate(10);
  }
  /**
   * Create task module with dedicated statistics
   *
   * @param string $title
   * @param string $description
   * @param integer $adminID
   * @param integer $userID
   * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
   */
  public function create(string $title, string $description, int $adminID, int $userID): RedirectResponse
  {
    try {
      DB::transaction(function () use ($title, $description, $adminID, $userID) {
        $task = Task::create([
          'assigned_to_id' => $userID,
          'assigned_by_id' => $adminID,
          'title' => $title,
          'description' => $description
        ]);

        $userTasks = Task::where('assigned_to_id', $userID)->count();

        // Update users tasks
        Statistic::updateOrCreate(['user_id' => $userID], ['tasks_count' => $userTasks]);
        DB::commit();
        flash()->addSuccess("Task created successfully for user: {$task->user->name}");
      });
      return redirect()->route('tasks.index');
    } catch (\Exception $e) {
      return redirect()->back()->withInput();
    }
  }

  /**
   * Retrieve users depends on search criteria (Select2)
   * @param string $term
   * @param string $userType
   * @param integer|null $page
   * @return \Illuminate\Http\JsonResponse
   */
  public function getUsersData(string $term, string $userType, int | null $page)
  {
    $users = User::select('name', 'id')->userType($userType)->where('name', 'LIKE', "%$term%")->paginate(5, ['*'], 'page', $page);

    return response()->json($users);
  }
}
