<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchant', function (Blueprint $table) {
            $table->comment('商户表');
            $table->uuid('id')->comment('uuid');
            $table->string('name', 60)->nullable()->comment('商户名称');
            $table->string('type')->comment('商户类型');
            $table->string('address')->comment('商户地址');
            $table->string('description')->comment('商户描述或简介');
            $table->string('logo')->comment('商户logo');
            $table->string('license_number')->comment('营业执照号码');
            $table->string('license_image')->comment('营业执照图片链接');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('merchant');
    }
};
