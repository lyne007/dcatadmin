<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Category;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;
use \App\Models\Category as CategoryModel;
class CategoryController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Category(['merchant']), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('c_name');
//            $grid->column('c_parent_id');
            $grid->column('c_level')->display(function(){
                return $this->c_level==1?'一级分类':'二级分类';
            });
            $grid->column('merchant.m_name',_('所属商户'));
//            $grid->column('c_image');
            $grid->column('show_index')->status([1=>'显示',0=>'不显示'])->switch();

            $grid->column('sort_weight')->sortable()->editable(true);
            $grid->column('status',_('状态'))->status([1=>'正常',0=>'禁用'])->switch();
            $grid->column('created_at');

            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');
                $filter->like('merchant.m_name', _('所属商户'));
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
        $model = Category::with('merchant');

        return Show::make($id, $model, function (Show $show) {
            $show->field('id');
            $show->field('c_name');
            $show->field('merchant.m_name',_('所属商户'));
            $show->field('c_parent_id');
            $show->field('c_level');
            $show->field('status');
            $show->field('c_image');
            $show->field('sort_weight');
            $show->field('show_index');
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
        return Form::make(new Category(), function (Form $form) {
            $form->display('id');
            $form->text('c_name')->required();
            $form->select('c_parent_id','所属分类')->options('api/category/select');
            $form->radio('status','状态')->options([1=>'正常',0=>'禁用'])->default(1);
            $form->text('c_image');
            $form->select('merchant_id',_('所属商户'))->options('api/merchant/select');
            $form->number('sort_weight',_('排序'));
            $form->radio('show_index',_('是否显示首页'))->options([1=>'显示',0=>'不显示'])->default(0);
            $form->display('created_at');
            $form->display('updated_at');
        });
    }

    /**
     * 获取分类 select下拉菜单
     */

}
