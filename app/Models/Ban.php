<?php 

namespace Faf\Models;

use Illuminate\Database\Eloquent\Model;


class Ban extends Model

{

	protected $table = 'bannable';


	protected $fillable = [

		'reportedFor',
		'reportedBy',
		'reportedDate'

	];


	public function bannable()
	{
		return $this->morphTo();
	}


	public function user()
	{
		return $this->belongsTo('Faf\Models\User','user_id');
	}



	

}