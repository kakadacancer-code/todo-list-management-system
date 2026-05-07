<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'user_id', 'title', 'description', 'due_date', 'status', 'priority_id'
    ];

    protected $casts = [
        'due_date' => 'date',
    ];

    public function priority()
    {
        return $this->belongsTo(Priority::class);
    }
}