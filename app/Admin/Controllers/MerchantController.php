<?php

namespace App\Admin\Controllers;

use App\Models\Merchant;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class MerchantController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Merchant(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('m_code');
            $grid->column('m_name');
            $grid->column('m_logo_url')->display(function (){
                return '<img src="/storage/'.$this->m_logo_url.'" width="38"/>';
            });
//            $grid->column('m_contact');
//            $grid->column('m_phone');
//            $grid->column('m_email');
            $grid->column('status','状态')->display(function($released){
                return $released ? '正常' : '禁用';
            });

            $grid->column('created_at')->sortable();
//            $grid->column('updated_at')->sortable();
            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');
                // 设置created_at字段的范围查询
                $filter->between('created_at', 'Created Time')->datetime();
                $filter->equal('m_name');
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
        return Show::make($id, new Merchant(), function (Show $show) {
            $show->field('id');
            $show->field('m_code');
            $show->field('m_name');
            $show->m_logo_url()->unescape()->as(function ($m_logo_url) {
                return "<img src='/storage/{$m_logo_url}' width='200' />";
            });
            $show->field('m_contact');
            $show->field('m_phone');
            $show->field('m_email');
            $show->status()->unescape()->as(function ($status) {
                return $status?'正常':'禁用';
            });
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
        return Form::make(new Merchant(), function (Form $form) {
            $form->display('id');
            $form->text('m_code')->required();
            $form->text('m_name')->required();
            $form->image('m_logo_url')->required();
            $form->text('m_contact')->required();
            $form->tel('m_phone')->required();
            $form->email('m_email')->required();
            $form->radio('status')->options([0 => '禁用', 1 => '正常'])->default(1);
            $form->display('created_at');
            $form->display('updated_at');
        });
    }



}
