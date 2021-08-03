<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Goods;
use App\Models\Category;
use App\Models\GoodsSpec;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;
use App\Models\Category as CategoryModel;

class GoodsController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Goods(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('goods_code');
            $grid->column('goods_name');
            $grid->column('cate_id_one')->display(function($cate_id_one){
                $cate = Category::where('id',$cate_id_one)->first();
                if ($cate) return $cate->c_name;
            });
            $grid->column('cate_id_two')->display(function($cate_id_two){
                $cate = Category::where('id',$cate_id_two)->first();
                if ($cate) return $cate->c_name;
            });

            $grid->column('attribute_list');
            $grid->column('vendor_id');
            $grid->column('goods_sales');
            $grid->column('goods_smallpic')->display(function(){
                return '<img src="/storage/'.$this->goods_smallpic.'" width="50" alt="">';
            });
            $grid->column('is_hot');
            $grid->column('status');
            $grid->column('sort_weight');
            $grid->column('created_at');

            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');
                $filter->equal('goods_code');
                $filter->like('goods_name');
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
        return Show::make($id, new Goods(), function (Show $show) {
            $show->field('id');
            $show->field('goods_code');
            $show->field('goods_name');
            $show->cate_id_one()->as(function($cate_id_one){
                $cate = Category::select('c_name')->where('id',$cate_id_one)->first();
                if ($cate) return $cate->c_name;

            });
            $show->cate_id_two()->as(function($cate_id_two){
                $cate = Category::select('c_name')->where('id',$cate_id_two)->first();
                if ($cate) return $cate->c_name;
            });
            $show->field('attribute_list');
            $show->field('vendor_id');
            $show->field('goods_sales');
            $show->is_hot()->unescape()->as(function($is_hot){
                return $is_hot ?'是':'否';
            });
            $show->status()->unescape()->as(function($is_hot){
                return $is_hot ?'上架':'下架';
            });
            $show->field('sort_weight');
            $show->goods_smallpic()->image();
            $show->goods_bigpic()->image();
            $show->editor('goods_details');

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
        return Form::make(new Goods(), function (Form $form) {
            $form->display('id');

            $form->row(function($form) {
                $form->text('goods_code')->required();
                $form->text('goods_name')->required();
            });
            $form->row(function($form) {
                // 一级分类
                $form->width(4)->select('cate_id_one')->options(Category::where('c_level',1)->get()->pluck('c_name', 'id'))->rules('required')->load('cate_id_two', 'api/category/select');
                // 二级分类
                $form->width(4)->select('cate_id_two')->rules('required');
            });
            $form->row(function($form) {
                // $form->text('sku_id');
                $form->select('vendor_id', _('所属供应商'))->options('api/merchant/select')->required();
                // $form->text('goods_sales', _('销量'))->disable()->default(0);
                $form->radio('is_hot')->options([0 => '否', 1 => '是'])->default(0);
                $form->radio('status')->options([0 => '下架', 1 => '上架'])->default(1);
                $form->number('sort_weight')->default(0);
                $sku_params = [
                    [
                        'name'    => '市场价', // table 第一行 title
                        'field'   => 'price2', // input 的 field_name 名称
                        'default' => '', // 默认值
                    ]
                ];

                $form->sku('sku_tmp', json_encode($sku_params))->display(true)->customFormat(function ($value) use ($form){
                    if($value === null){
                        // 这里是给sku喂数据， 数据格式为
                        $data = new \stdClass();
                        $data->attrs = [
                            '颜色' => [
                                '红色',
                                '蓝色',
                            ],
                            '大小' => [
                                '20',
                            ],
                        ];
                        $data->sku = [
                            [
                                "颜色" => "红色",
                                "大小" => '20',
                                "pic" => '图片',
                                "stock" => '20',
                                "price" => '200',
                                "price2" => '200',
                                // 如果存在其他属性，则同样在这里塞进去
                            ],
                            [
                                "颜色" => "蓝色",
                                "大小" => '20',
                                "pic" => '图片',
                                "stock" => '10',
                                "price" => '100',
                                "price2" => '100',
                                // 如果存在其他属性，则同样在这里塞进去
                            ]
                            // 根据attrs做笛卡尔积，会有两种情况， 红色20 蓝色20，所以这两中都应该有，自行编辑数据
                        ];
                        return json_encode($data);
                    }
                    return null;
                });
                // $form->image('goods_smallpic');
                $form->image('goods_bigpic');
                $form->editor('goods_details');

            });
            $form->display('created_at');
            $form->display('updated_at');
            // 保存前回调，在此事件中可以修改、删除用户提交的数据或者中断提交操作
            $form->saving(function (Form $form) {
                $goods_data = $form->input();
                // 判断是否是新增操作
                if ($form->isCreating()) {

                    // 获取规格属性及sku信息，并保存
                    if ($form->input('sku_tmp')=='') {
                        // 中断后续逻辑
                        return $form->response()->error('请设置属性值~');
                    }
                    $sku_tmp = json_decode($form->input('sku_tmp'),true);
                    if (!isset($sku_tmp['sku']) || empty($sku_tmp['sku'])) {
                        // 中断后续逻辑
                        return $form->response()->error('sku有问题~');
                    }
                    $attribute_list = $sku_tmp['attrs'];
                    $goods_data['attribute_list'] = json_encode($attribute_list,JSON_UNESCAPED_UNICODE);
                    unset($goods_data['sku_tmp']);
                    $goods = \App\Models\Goods::create($goods_data);
                    $goodsId = $goods->id;
                    $goods_specs = $sku_tmp['sku'];
                    $stock_data = [];
                    array_walk($goods_specs,function($val,$key) use (&$stock_data,$goodsId){
                        $stock_data[$key]['goods_id'] = $goodsId;
                        $stock_data[$key]['specs_key'] = $key;
                        $stock_data[$key]['goods_stock'] = $val['stock'];
                        $stock_data[$key]['goods_price'] = $val['price'];
                        $stock_data[$key]['market_price'] = $val['price2'];
                        $stock_data[$key]['spec_pic'] = $val['pic'];
                        unset($val['pic']);
                        unset($val['stock']);
                        unset($val['price']);
                        unset($val['price2']);
                        $stock_data[$key]['goods_specs'] = json_encode($val,JSON_UNESCAPED_UNICODE);
                    });

                    // 保存到goods_specs表，生成sku数据
                    $res = GoodsSpec::insert($stock_data);
                    if (!$res) {
                        $goods = new \App\Models\Goods();
                        $goods->find($goodsId);
                        $goods->delete();
                        // 中断后续逻辑
                        return $form->response()->error('存储失败')->redirect('goods/create');

                    }

                    return $form->response()->success('保存成功')->redirect('goods/create');

                }
            });
            $form->saved(function (Form $form) {

            });
        });
    }
//{
//"attrs": {
//"尺寸": ["M", "L"],
//"颜色": ["红色"]
//},
//"sku": [{
//    "尺寸": "M",
//		"颜色": "红色",
//		"pic": "",
//		"stock": "100",
//		"price": "90",
//		"column1": "180"
//	}, {
//    "尺寸": "L",
//		"颜色": "红色",
//		"pic": "",
//		"stock": "100",
//		"price": "90",
//		"column1": "180"
//	}]
//}
}
