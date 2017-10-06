<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'name',
        'description',
        'date',
        'hour',
        'deadline',
        'attenders',
        'attender_limit',
        'price',
        'phone',
        'phone_alternative',
        'poster',
        'ended',
    ];

    protected $hidden = [

    ];

    public function clubs()
    {
        return $this->belongsTo('App\Club', 'club_id');
    }

    public function attenders()
    {
        return $this->belongsToMany('App\User', 'attenders', 'event_id', 'user_id');
    }

    public function confirm(User $user)
    {
        return $this->attenders()->where('user_id', $user->id)->first()->pivot->update(['confirmed' => true]);
    }

    public function makeAdmin(User $user)
    {
        return $this->attenders()->where('user_id', $user->id)->first()->pivot->update(['admin' => true]);
    }

    public function admins()
    {
        return $this->attenders()->where('admin', true)->get();
    }

    public function shortenDescript()
    {
        if (strlen($this->description) > 150) {
            $this->description = substr($this->description, 0, 150);
            $this->description = substr($this->description, 0, strrpos($this->description, ' '));
            $this->description = substr($this->description, 0, strrpos($this->description, ' '));
            $this->description = $this->description.'<a class="link extend-desc" data-event-id="'.$this->id.'">  <i class="fa fa-chevron-down" aria-hidden="true"></i> Genişlet</a>';
            return $this->description;
        }
        return $this->description;
    }

    public function isFree()
    {
        return (bool) $this->where('price', null)->count();
    }
}