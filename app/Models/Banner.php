<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
	use HasDateTimeFormatter;

//    public $timestamps = true;
//    protected $table = 'merchants';
//    protected $with = [
//        'merchant'
//    ];

    public function merchant(){
        return $this->belongsTo(Merchant::class,'merchant_id');
    }


}
