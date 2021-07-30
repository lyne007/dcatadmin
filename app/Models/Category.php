<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	use HasDateTimeFormatter;
    protected $table = 'categorys';

    public function merchant(){
        return $this->belongsTo(Merchant::class,'merchant_id');
    }

    public function attribute() {
        return $this->hasOne(AttributeKey::class);
    }
}
