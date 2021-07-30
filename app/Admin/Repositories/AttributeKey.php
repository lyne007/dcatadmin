<?php

namespace App\Admin\Repositories;

use App\Models\AttributeKey as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class AttributeKey extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
