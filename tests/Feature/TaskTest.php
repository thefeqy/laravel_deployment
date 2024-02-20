<?php

namespace Tests\Feature;

use App\Enums\UserType;
use App\Models\Statistic;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Str;
use Tests\TestCase;

class TaskTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->setBaseRoute('tasks');
        $this->setBaseModel(Task::class);
    }

    /**
     * @test
     */
    public function test_user_cannot_access_tasks_page(): void
    {
        $this->signIn();
        $response = $this->get('/tasks');

        $response->assertStatus(403);
    }

    /**
     * @test
     */
    public function test_admin_can_access_tasks_page(): void
    {
        $this->signIn(userType: UserType::ADMIN);

        $response = $this->get('/tasks');
        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function test_admin_can_create_task(): void
    {
        $this->signIn(userType: UserType::ADMIN);

        $this->create();
    }

    /**
     * @test
     */
    public function test_user_cannot_assign_tasks(): void
    {
        $this->signIn(userType: UserType::ADMIN);

        $data = Task::factory()->raw([
            'assigned_by_id' => User::factory()->create(['user_type' => UserType::USER])
        ]);

        $response = $this->postJson(route('tasks.store'), $data);

        $response->assertUnprocessable()
            ->assertInvalid('assigned_by_id');
    }

    /**
     * @test
     */
    public function test_title_limit_cannot_exceed_30_char(): void
    {
        $this->signIn(userType: UserType::ADMIN);

        $data = Task::factory()->raw([
            'title' => Str::random(40),
        ]);

        $response = $this->postJson(route('tasks.store'), $data);

        $response->assertUnprocessable()
            ->assertInvalid('title');
    }

    /**
     * @test
     */
    public function test_tasks_page_returns_tasks_in_pagination_form(): void
    {
        $this->signIn(userType: UserType::ADMIN);

        Task::factory(50)->create();

        $seenTask = Task::find(5);
        $unSeenTask = Task::find(15);

        $response = $this->get('/tasks');

        $response->assertOk();

        $response->assertSee($seenTask->title);
        $response->assertDontSee($unSeenTask->title);
    }

    /**
     * @test
     */
    public function test_updates_user_statistics_after_task_creation() {
        $this->signIn(userType: UserType::ADMIN);
        
        $user = User::factory()->create(['user_type' => UserType::USER]);

        $statsBeforeCreating = Statistic::count();
        
        Task::factory()->create(['assigned_to_id' => $user->id]);        
        
        $statsAfterCreating = Statistic::where('user_id', $user->id)->count();

        $this->assertGreaterThan($statsBeforeCreating, $statsAfterCreating);
    }
}
