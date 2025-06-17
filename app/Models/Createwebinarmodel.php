<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Createwebinarmodel extends Model
{
    // Define the table name explicitly if it doesn't follow Laravel's naming convention
    protected $table = 'createwebinarmodels';

    // Allow mass assignment on these fields
    protected $fillable = [
        'title',
        'description',
        'topic',
        'date',
        'time',
        'reminder_reminder_time',
        'status',
        'speakers',
        'speakers_designation',
        'zoom_meeting_id',
        'zoom_meeting_url',
        'banner',
    ];

    // Optionally cast fields to appropriate data types
    protected $casts = [
        'date' => 'date',
        'time' => 'datetime:H:i',
        'status' => 'string',
    ];
}
