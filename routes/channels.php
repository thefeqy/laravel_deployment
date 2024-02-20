<?php

use App\Enums\UserType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('stats-updates', function () {
    return Auth::user()->user_type == UserType::ADMIN;
});
