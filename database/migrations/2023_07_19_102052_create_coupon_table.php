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
        Schema::create('coupon', function (Blueprint $table) {
            $table->comment('优惠券');
            $table->uuid('id')->primary()->comment('uuid');
            $table->uuid('merchant_id')->nullable()->comment('所属商户');
            $table->string('name', 60)->nullable()->comment('券名称');
            $table->longText('available_shop')->nullable()->comment('适用门店');
            $table->uuid('shop_id')->nullable()->index('coupon_shop')->comment('所属门店');
            $table->decimal('price', 10)->nullable()->comment('统一售价');
            $table->decimal('money', 10)->nullable()->comment('券面额');
            $table->uuid('coupon_type_id')->nullable()->index('coupon_coupon_type')->comment('券分类');
            $table->longText('available_product')->nullable()->comment('使用范围');
            $table->tinyInteger('start_type')->nullable()->comment('开始生效时间类型');
            $table->tinyInteger('end_type')->nullable()->comment('结束时间类型');
            $table->tinyInteger('status')->nullable()->comment('券状态');
            $table->longText('restriction')->nullable()->comment('订单使用限制');
            $table->tinyInteger('is_allow_give')->nullable()->comment('是否允许赠送');
            $table->text('details')->nullable()->comment('券说明');
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
        Schema::dropIfExists('coupon');
    }
};
