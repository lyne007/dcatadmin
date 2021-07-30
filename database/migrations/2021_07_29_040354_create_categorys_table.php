<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategorysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categorys', function (Blueprint $table) {
            $table->increments('id');
            $table->string('c_name')->default('')->comment('分类名');
            $table->integer('c_parent_id')->comment('父类Id');
            $table->smallInteger('c_level')->default('1')->comment('分类等级：默认1级');
            $table->smallInteger('status')->default('1')->comment('禁用状态   0禁用，1正常  默认1');
            $table->string('c_image')->default('')->comment('分类图标');
            $table->smallInteger('sort_weight')->default('0')->comment('排序权重 数字越大排序越高');
            $table->smallInteger('show_index')->default('0')->comment('是否显示首页，默认0 不显示，1显示');
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
        Schema::dropIfExists('categorys');
    }
}
