<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Banner;
use App\Models\Merchant;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;
use function Doctrine\Common\Cache\Psr6\get;

class BannerController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Banner(['merchant']), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('merchant.m_name',_('所属商户'));

            $grid->column('b_image')->display(function(){
                return '<img src="/storage/'.$this->b_image.'" width="50" alt="">';
            });
            $grid->column('b_href')->display(function(){
                return '<a target="__blank" href="'.$this->b_href.'">查看</a>';
            });
            $grid->column('b_sort_weight');
            $grid->column('created_at');
            $grid->column('updated_at')->sortable();
        
            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');
                $filter->like('merchant.name',_('所属商户'));
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
        $model = Banner::with('merchant');
        return Show::make($id, $model, function (Show $show) {
            $show->field('id');
            $show->field('merchant.m_name',_('所属商户'));
            $show->b_href()->link();
            $show->b_image()->image();
            $show->field('b_sort_weight');
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
//        $model = Banner::with('merchant');
        return Form::make(new Banner(), function (Form $form) {
            $form->display('id');
            $form->text('b_href');
            $form->image('b_image')->required();
            $form->select('merchant_id',_('所属商户'))->options('api/merchant/select');
            $form->text('b_sort_weight')->default(0);
            $form->display('created_at');
            $form->display('updated_at');

        });
    }
}
