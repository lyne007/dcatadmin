<?php

namespace App\Admin\Repositories;

use App\Models\AttributeValue as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class AttributeValue extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
