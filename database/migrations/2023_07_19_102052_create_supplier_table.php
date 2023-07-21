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
        Schema::create('supplier', function (Blueprint $table) {
            $table->comment('供应商表');
            $table->uuid('id')->primary()->comment('uuid');
            $table->uuid('merchant_id')->nullable()->comment('所属商户');
            $table->uuid('shop_id')->nullable()->index('supplier_shop')->comment('所属门店');
            $table->string('name', 60)->nullable()->comment('供应商名称');
            $table->string('contacts', 60)->nullable()->comment('联系人');
            $table->string('phone', 11)->nullable()->comment('联系方式');
            $table->string('address', 255)->nullable()->comment('地址信息');
            $table->string('balance_type', 255)->nullable()->comment('结算方式');
            $table->integer('balance_day')->nullable()->comment('结算天数');
            $table->string('bank_name', 60)->nullable()->comment('开户银行');
            $table->string('bank_no', 30)->nullable()->comment('银行卡号');
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
        Schema::dropIfExists('supplier');
    }
};
