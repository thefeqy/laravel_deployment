<?php

namespace App\Models;

use App\Events\StatisticUpdatedEvent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statistic extends Model
{
    use HasFactory;

    protected $guarded = [];
    
    protected $dispatchesEvents = [
        'created' => StatisticUpdatedEvent::class,
        'updated' => StatisticUpdatedEvent::class
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
