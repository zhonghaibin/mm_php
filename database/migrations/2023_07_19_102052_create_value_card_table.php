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
        Schema::create('value_card', function (Blueprint $table) {
            $table->comment('储值卡');
            $table->uuid('id')->primary()->comment('uuid');
            $table->uuid('merchant_id')->nullable()->comment('所属商户');
            $table->string('name', 60)->nullable()->comment('储值卡名称');
            $table->longText('available_shop')->nullable()->comment('适用门店');
            $table->uuid('shop_id')->nullable()->index('value_card_shop')->comment('所属门店');
            $table->decimal('price', 10)->nullable()->comment('统一售价');
            $table->decimal('money', 10)->nullable()->comment('储值卡面额');
            $table->uuid('value_card_type_id')->nullable()->index('value_card')->comment('储值卡分类');
            $table->longText('available_product')->nullable()->comment('使用范围');
            $table->tinyInteger('start_type')->nullable()->comment('开始生效时间类型');
            $table->tinyInteger('end_type')->nullable()->comment('结束时间类型');
            $table->longText('buy_give_product')->nullable()->comment('购买赠送');
            $table->longText('renew_give_product')->nullable()->comment('续充赠送');
            $table->tinyInteger('status')->nullable()->comment('储值卡状态');
            $table->text('details')->nullable()->comment('储值卡须知');
            $table->tinyInteger('is_limit')->nullable()->comment('限购');
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
        Schema::dropIfExists('value_card');
    }
};
