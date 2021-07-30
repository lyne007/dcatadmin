<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class AttributeValue extends Model
{
	use HasDateTimeFormatter;
    protected $table = 'attribute_values';

}
