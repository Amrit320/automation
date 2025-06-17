<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSubmission extends Model
{
    protected $table = 'submissions'; // Binding to existing table

    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'Invite_Sent',
        'calendar_response',
        'calendly_event_id',
        'reminder_sent',
        'attendance_status',
        'calendar_sync_status',
        'last_updated',
        'meeting_datetime',
        'webinar_id',
        'synced',
    ];
}
