<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'start_datetime',
        'end_datetime',
        'status',
        'organizer_id',
        'venue_id'
    ];

    public function organizer(){
        return $this->belongsTo(User::class, 'organizer_id');
    }

    public function venue(){
        return $this->belongsTo(Venue::class, 'venue_id');
    }

    public function attendees(){
        return $this->belongsToMany(User::class, 'attendees', 'event_id', 'user_id')
                    ->withTimestamps();
    }

    public function attendeeRecords(){
        return $this->hasMany(Attendee::class, 'event_id');
    }
}
