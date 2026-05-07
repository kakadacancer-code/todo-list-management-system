<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\Task;

class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        View::composer('layouts.app', function ($view) {
            $today     = now()->toDateString();
            $all       = Task::count();
            $completed = Task::where('status', 'completed')->count();

            $counts = [
                'all'       => $all,
                'today'     => Task::whereDate('due_date', $today)->count(),
                'upcoming'  => Task::whereDate('due_date', '>', $today)->where('status', '!=', 'completed')->count(),
                'completed' => $completed,
                'overdue'   => Task::whereDate('due_date', '<', $today)->where('status', '!=', 'completed')->count(),
            ];

            $productivity = $all > 0 ? round(($completed / $all) * 100) : 0;

            $view->with('counts', $counts)
                 ->with('productivity', $productivity);
        });
    }
}