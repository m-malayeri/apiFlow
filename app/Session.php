<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
	public function store($data)
	{
		Session::insert($data);
		return Session::get()->last()->id;
	}
}
