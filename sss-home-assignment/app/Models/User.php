<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'surname',
        'email',
        'role'
    ];

    public function organizedEvents(){
        return $this->hasMany(Event::class, 'organizer_id');
    }

    public function attendingEvents(){
        return $this->belongsToMany(Event::class, 'attendees', 'user_id', 'event_id')
                    ->withTimestamps();
    }

    public function attendeeRecords(){
        return $this->hasMany(Attendee::class, 'user_id');
    }
}
