<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Session extends Model
{
	public static function store($data)
	{
		DB::table('sessions')->insert($data);
		return DB::getPdo()->lastInsertId();
	}
}
