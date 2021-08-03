<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods', function (Blueprint $table) {
            $table->increments('id');
            $table->string('goods_code')->default('')->comment('商品编码');
            $table->string('goods_name')->default('')->comment('商品名称');
            $table->integer('cate_id_one')->comment('商品所属一级分类');
            $table->integer('cate_id_two')->comment('二级分类id');
            $table->text('attribute_list')->comment('前台显示使用，选择后拼接出goods_specs,再加上goods_id用于在商品规格表中查找具体的sku');
            $table->integer('vendor_id')->comment('关联供应商id');
            $table->smallInteger('goods_sales')->comment('产品销量');
            $table->string('goods_smallpic')->default('')->comment('产品缩略图   url  多个以|隔开，最多5个');
            $table->string('goods_bigpic')->default('')->comment('产品大图 url');
            $table->longText('goods_details')->comment('产品详情  以标签形式存储');
            $table->smallInteger('is_hot')->default('0')->comment('是否热销：默认为0否，1为是');
            $table->smallInteger('status')->default('1')->comment('商品状态：0为禁用，1为正常 默认1');
            $table->smallInteger('sort_weight')->default('0')->comment('产品排序,越大越前');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('goods');
    }
}
