<?php

namespace Faf\Models;

use Faf\Models\Status;
use Faf\Models\Like;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Country extends Authenticatable
{
    use Notifiable;

    protected $table = 'countries';


}
