<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\AttributeKey;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class AttributeKeyController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new AttributeKey(['category']), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('category.c_name', _('所属分类'));
            $grid->column('attribute_name');
            $grid->column('created_at');
            $grid->column('updated_at')->sortable();
        
            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');
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
        return Show::make($id, new AttributeKey(['category']), function (Show $show) {
            $show->field('id');
            $show->field('category.c_name', _('所属分类'));
            $show->field('attribute_name');
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
        return Form::make(new AttributeKey(), function (Form $form) {
            $form->display('id');
            $form->select('category_id',_('所属分类'))->options('api/category/select');
            $form->text('attribute_name');
        
            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
