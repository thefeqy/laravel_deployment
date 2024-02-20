<?php

namespace Tests\Feature;

use App\Enums\UserType;
use App\Models\Statistic;
use Tests\TestCase;

class StatisticTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->setBaseRoute('statistics');
        $this->setBaseModel(Statistic::class);
    }

    /**
     * @test
     */
    public function test_user_cannot_access_statistics_page()
    {
        $this->signIn();
        $response = $this->get('/statistics');

        $response->assertStatus(403);
    }

    /**
     * @test
     */
    public function test_admin_can_access_statistics_page()
    {
        $this->signIn(userType: UserType::ADMIN);
        $response = $this->get('/statistics');

        $response->assertStatus(200);
        $response->assertSee("Top 10 Users with heights number of tasks");
    }
}
