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
        Schema::create('goods', function (Blueprint $table) {
            $table->comment('商品表');
            $table->uuid('id')->primary()->comment('uuid');
            $table->uuid('merchant_id')->nullable()->comment('所属商户');
            $table->uuid('shop_id')->nullable()->index('goods_shop')->comment('所属门店');
            $table->string('name', 60)->nullable()->comment('商品名称');
            $table->longText('available_shop')->nullable()->comment('适用门店');
            $table->decimal('price', 10)->nullable()->comment('统一售价');
            $table->uuid('unit_id')->nullable()->index('goods_unit')->comment('商品单位');
            $table->uuid('goods_type_id')->nullable()->index('goods_goods_type')->comment('商品分类');
            $table->tinyInteger('status')->nullable()->comment('商品状态');
            $table->string('goods_no', 30)->nullable()->comment('商品编号');
            $table->uuid('brand_id')->nullable()->comment('商品品牌');
            $table->longText('form')->nullable()->comment('商品形态');
            $table->longText('capacity')->nullable()->comment('商品容量');
            $table->dateTime('expiration_date')->nullable()->comment('商品保质期');
            $table->longText('picture')->nullable()->comment('商品配图');
            $table->text('details')->nullable()->comment('商品详情');
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
        Schema::dropIfExists('goods');
    }
};
