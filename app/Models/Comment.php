<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

	protected $table = 'comments';

	public $primaryKey = 'id';

	public function post()
	{
		return $this->belongsTo("App\Models\Post",'post_id','id');
	}

	public function user()
	{
		return $this->belongsTo("App\Models\User",'user_id','id');
	}
}
