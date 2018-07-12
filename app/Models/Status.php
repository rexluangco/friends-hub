<?php 

namespace Faf\Models;

use Faf\Models\User;
use Illuminate\Database\Eloquent\Model;

class Status extends  Model

{

	protected $table = 'statuses';

	protected $fillable = [

		'body',
		'statusImageUpload',
		

	];



	public function user()
	{
		return $this->belongsTo('Faf\Models\User', 'user_id');
	}

	public function scopeNotReply($query)
	{
		return $query->whereNull('parent_id');
	}

	public function replies()
	{
		return $this->hasMany('Faf\Models\Status', 'parent_id');
	}


	public function likes()
	{
		return $this->morphMany('Faf\Models\Like','likeable');
	}

	public function bans()
	{
		return $this->morphMany('Faf\Models\Ban','bannable');
	}

}