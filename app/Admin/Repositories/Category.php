<?php

namespace App\Admin\Repositories;

//use App\Models\Category as Model;
use Dcat\Admin\Repositories\EloquentRepository;
use App\Models\Category as CategoryModel;

class Category extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = CategoryModel::class;
}
