<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EditTask extends Model
{
    protected $table = 'tasks'; // important (table name)

    protected $fillable = [
        'title',
        'description',
        'due_date',
        'priority',
        'category',
        'reminder'
    ];
}