<?php

namespace Tests;

use App\Enums\UserType;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, LazilyRefreshDatabase;

    protected $base_route, $base_model;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutVite();
    }

    protected function signIn(User|null $user = null, UserType $userType = UserType::USER)
    {
        $user = $user ?? create(User::class, [
            'user_type' => $userType
        ]);
        $this->actingAs($user);
    }

    protected function setBaseRoute($route)
    {
        $this->base_route = $route;
    }

    protected function setBaseModel($model)
    {
        $this->base_model = $model;
    }

    protected function create($data = [], $model = '', $route = '')
    {
        $this->withoutExceptionHandling();

        $route = $this->base_route ? "{$this->base_route}.store" : $route;
        $model = $this->base_model ?? $model;

        $data = raw($model, $data);

        if (!auth()->user()) {
            $this->expectException(AuthenticationException::class);
        }

        $response = $this->postJson(route($route), $data)->assertRedirect(route("{$this->base_route}.index"));

        $model = new $model;

        $this->assertDatabaseHas($model->getTable(), $data);

        return $response;
    }
}
