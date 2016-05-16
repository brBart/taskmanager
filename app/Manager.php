<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Manager extends Model
{
    //

    public static function all($columns = array('*'))
	{
		$instance = new static;

		return $instance->newQuery()->get($columns);
	}

	public static function serialized()
	{
		$this->toArray();
	}
}
