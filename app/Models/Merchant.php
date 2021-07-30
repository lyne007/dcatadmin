<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class Merchant extends Model
{
	use HasDateTimeFormatter;

    public function banner() {
        return $this->hasOne(Banner::class);
    }

    public function category() {
        return $this->hasOne(Category::class);
    }



}
