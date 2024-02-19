<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function admin() {
        return $this->hasOne(User::class, 'id', 'assigned_by_id');
    }

    public function user() {
        return $this->hasOne(User::class, 'id', 'assigned_to_id');
    }
}
