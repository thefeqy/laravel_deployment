<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function admin()
    {
        return $this->hasOne(User::class, 'id', 'assigned_by_id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'assigned_to_id');
    }

    public static function boot()
    {
        parent::boot();
        self::created(function ($model) {
            $userTasks = self::where('assigned_to_id', $model->user->id)->count();
            Statistic::updateOrCreate(['user_id' => $model->user->id], ['tasks_count' => $userTasks]);
        });
    }
}
