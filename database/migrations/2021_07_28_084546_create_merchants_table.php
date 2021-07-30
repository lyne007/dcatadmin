<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMerchantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchants', function (Blueprint $table) {
            $table->increments('id');
            $table->string('m_code')->default('')->comment('商户编码');
            $table->string('m_name')->default('')->comment('商户名称');
            $table->string('m_logo_url')->default('')->comment('商户logo');
            $table->string('m_contact')->default('')->comment('联系人');
            $table->string('m_phone')->default('')->comment('联系人电话');
            $table->string('m_email')->default('')->comment('联系人邮箱');
            $table->string('status')->default('')->comment('禁用状态   0禁用，1正常  默认1');
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
        Schema::dropIfExists('merchants');
    }
}
