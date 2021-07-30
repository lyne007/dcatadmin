<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;
use Category as CategoryModel;

class Goods extends Model
{
	use HasDateTimeFormatter;

    protected $eloquentClass = CategoryModel::class;

}
