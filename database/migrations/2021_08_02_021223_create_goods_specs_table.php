<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsSpecsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods_specs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('goods_id')->comment('商品ID');
            $table->text('goods_specs')->comment('规格值json');
            $table->integer('specs_key')->comment('规格值的序号');
            $table->integer('goods_stock')->default('0')->comment('库存');
            $table->decimal('goods_price')->comment('价格');
            $table->decimal('market_price')->comment('市场价');
            $table->string('spec_pic')->default('')->comment('属性图片');
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
        Schema::dropIfExists('goods_specs');
    }
}
