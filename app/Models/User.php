<?php

namespace Faf\Models;

use Faf\Models\Status;
use Faf\Models\Like;
use Faf\Models\Ban;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'civil_status',
        'intro', 
        'avatar',
        'cover_image',
        'email', 
        'password',
        'first_name',
        'last_name',
        'location',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function getName()
    {
        if ($this->first_name && $this->last_name) {
            return "{$this->first_name} {$this->last_name}";
        }

        if ($this->first_name) {
            return $this->first_name;
        }

        return null;
    }



    public function getNameOrUsername()
    {
        return $this->getName() ?: $this->username;
    }


    public function getFirstNameOrUsername()
    {
        return $this->first_name ?: $this->username;
    }


    public function getCivilStatus()
    {
        if ($this->civil_status) {
            return $this->civil_status;
        }
        return "Not set yet.";
    }

    public function getIntro()
    {
        if ($this->intro) {
            return $this->intro;
        }
        return null;
    }


    public function getLocation()   
    {
        if ($this->location) {
            return $this->location;
        }
        return null;
    }

// you may need to visit gravatar where you can get avatar

    public function getAvatarUrl()
    {
        
       return "https://www.gravatar.com/avatar/{{ md5($this->email)}}?d=mm&s=50";



    }


    public function statuses()
    {
        return $this->hasMany('Faf\Models\Status', 'user_id');
    }

    public function bans()
    {
        return $this->hasMany('Faf\Models\Ban','user_id');
    }


    public function likes()
    {
        return $this->hasMany('Faf\Models\Like','user_id');
    }

    public function friendsOfMine()
    {

        return $this->belongsToMany('Faf\Models\User' ,'friends', 'user_id','friend_id');
    }


    public function friendOf()
    {
        return $this->belongsToMany('Faf\Models\User' ,'friends', 'friend_id','user_id');
    }


    public function friends()
    {

        return $this->friendsOfMine()->wherePivot('accepted', true)->get()->merge($this->friendOf()->wherePivot('accepted', true)->get());
    }




    public function friendRequests()
    {
        return $this->friendsOfMine()->wherePivot('accepted', false)->get();

    }



    public function friendRequestsPending()
    {
        return $this->friendOf()->wherePivot('accepted', false)->get();
    }


    public function hasFriendRequestPending(User $user)
    {

        return (bool) $this->friendRequestsPending()->where('id', $user->id)->count();

    }


    public function hasFriendRequestReceived(User $user)
    {

        return (bool) $this->friendRequests()->where('id', $user->id)->count();

    }

    public function addFriend(User $user)
    {
        $this->friendOf()->attach($user->id);
    }

    public function deleteFriend(User $user)
    {
        $this->friendOf()->detach($user->id);
        $this->friendsOfMine()->detach($user->id);
    }


    public function acceptFriendRequest(User $user)
    {
        $this->friendRequests()->where('id',$user->id)->first()->pivot->update([

            'accepted'=> true,
        ]);
    }

    public function isFriendsWith(User $user)
    {
       return (bool)$this->friends()->where('id',$user->id)->count();

    }



    public function hasLikedStatus(Status $status)
    {

        return $status->likes->where('user_id', $this->id)->count();
    }


    public function hasBannedStatus(Ban $ban)
    {
        return $status->bans->where('user_id', $this->id)->count();
    }


}
