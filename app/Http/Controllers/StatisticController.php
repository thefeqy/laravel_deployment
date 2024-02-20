<?php

namespace App\Http\Controllers;

use App\Models\Statistic;
use Illuminate\Http\Request;

class StatisticController extends Controller
{
    public function index()
    {
        $stats = Statistic::with('user')->orderBy('tasks_count', 'DESC')->limit(10)->get();
        return view('statistics.index', compact('stats'));   
    }
}
