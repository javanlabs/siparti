<?php namespace Siparti\UjiPublik;

use Illuminate\Database\Eloquent\Model as BaseModel;
use Prettus\Repository\Contracts\Presentable;
use Prettus\Repository\Traits\PresentableTrait;

class Model extends BaseModel implements Presentable
{
	use PresentableTrait;

	public $table = "uji_publik";

	public $fillable = [
	    "id",
		"created_at",
		"updated_at"
	];

}
