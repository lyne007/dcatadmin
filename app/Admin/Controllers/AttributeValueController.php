<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\AttributeValue;
use App\Models\AttributeKey;
use App\Models\Category;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class AttributeValueController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new AttributeValue(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('attribute_id')->display(function($attribute_id){
                $attr = AttributeKey::where('id',$attribute_id)->first();
                return $attr->attribute_name;
            });
            $grid->column('attribute_value');
            $grid->column('created_at');
            $grid->column('updated_at')->sortable();
        
            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');
                $filter->equal('attribute_id');
            });
        });
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     *
     * @return Show
     */
    protected function detail($id)
    {
        return Show::make($id, new AttributeValue(), function (Show $show) {
            $show->field('id');
            $show->attribute_id()->as(function($attribute_id){
                $attr = AttributeKey::where('id',$attribute_id)->first();
                return $attr->attribute_name;
            });
            $show->field('attribute_value');
            $show->field('created_at');
            $show->field('updated_at');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new AttributeValue(), function (Form $form) {
            $form->display('id');
            $form->select('category_id',_('所属分类'))->options(Category::where('c_level',1)->get()->pluck('c_name','id'))->load('attribute_id','api/attribute/select');
            $form->select('attribute_id');
            $form->text('attribute_value');
        
            $form->display('created_at');
            $form->display('updated_at');

            $form->saving(function(Form $form){
                $form->deleteInput('category_id');
            });
        });
    }
}
