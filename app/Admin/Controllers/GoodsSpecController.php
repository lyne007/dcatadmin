<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\GoodsSpec;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class GoodsSpecController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new GoodsSpec(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('goods_id');
            $grid->column('goods_specs');
            $grid->column('specs_key');
            $grid->column('goods_stock');
            $grid->column('goods_price');
            $grid->column('market_price');
            $grid->column('spec_pic');
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
        return Show::make($id, new GoodsSpec(), function (Show $show) {
            $show->field('id');
            $show->field('goods_id');
            $show->field('goods_specs');
            $show->field('specs_key');
            $show->field('goods_stock');
            $show->field('goods_price');
            $show->field('market_price');
            $show->field('spec_pic');
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
        return Form::make(new GoodsSpec(), function (Form $form) {
            $form->display('id');
            $form->text('goods_id');
            $form->text('goods_specs');
            $form->text('specs_key');
            $form->text('goods_stock');
            $form->text('goods_price');
            $form->text('market_price');
            $form->text('spec_pic');
        
            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
