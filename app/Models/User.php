<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{


	protected $table = "users";
	public $primaryKey = 'id';

	protected $fillable = [
            'name', 'password',
    ];

	protected $hidden = [
            'password', 'remember_token',
        ];
}
