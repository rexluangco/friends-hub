<?php

namespace Faf\Models;

use Faf\Models\Status;
use Faf\Models\Like;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Admin extends Authenticatable
{
    use Notifiable;

    protected $table = 'admins';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'job_title', 
        'email', 
        'password',
        'first_name',
        'last_name',
        
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

//Get admin name

    public function getAdminName()
    {
        if ($this->first_name && $this->last_name) {
            return "{$this->first_name} {$this->last_name}";
        }

        if ($this->first_name) {
            return $this->first_name;
        }

        return null;
    }

    public function getAdminNameOrUsername()
    {
        return $this->getAdminName() ?: $this->username;
    }


    public function getAdminFirstNameOrUsername()
    {
        return $this->first_name ?: $this->username;
    }


}
