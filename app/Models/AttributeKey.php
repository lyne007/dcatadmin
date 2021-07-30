<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class AttributeKey extends Model
{
	use HasDateTimeFormatter;
    protected $table = 'attribute_keys';

    public function category() {
        return $this->belongsTo(Category::class,'category_id');
    }

}
