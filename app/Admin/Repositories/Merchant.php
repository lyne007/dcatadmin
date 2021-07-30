<?php

namespace App\Admin\Repositories;

use App\Models\Merchant as Model;
use Dcat\Admin\Repositories\EloquentRepository;
use App\Models\Merchant as MerchantModel;

class Merchant extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = MerchantModel::class;

}
