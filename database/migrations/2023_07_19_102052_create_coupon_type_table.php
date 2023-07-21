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
        Schema::create('coupon_type', function (Blueprint $table) {
            $table->comment('优惠券分类表');
            $table->uuid('id')->primary()->comment('uuid');
            $table->uuid('merchant_id')->nullable()->comment('所属商户');
            $table->string('name', 60)->nullable()->comment('分类名称');
            $table->uuid('shop_id')->nullable()->index('coupon_type_shop')->comment('所属门店');
            $table->uuid('pid')->nullable()->comment('父级Id');
            $table->integer('sort')->nullable()->comment('排序');
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
        Schema::dropIfExists('coupon_type');
    }
};
