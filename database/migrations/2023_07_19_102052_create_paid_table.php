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
        Schema::create('paid', function (Blueprint $table) {
            $table->comment('支出列表');
            $table->uuid('id')->primary()->comment('uuid');
            $table->uuid('merchant_id')->nullable()->comment('所属商户');
            $table->uuid('shop_id')->nullable()->index('paid_shop')->comment('所属门店');
            $table->uuid('paid_shop_id')->nullable()->comment('支出门店');
            $table->uuid('paid_type')->nullable()->index('paid_paid_type')->comment('支出类型');
            $table->longText('paid_content')->nullable()->comment('支出内容');
            $table->uuid('paid_type_id')->nullable()->comment('支付方式');
            $table->decimal('money', 10)->nullable()->comment('支出金额');
            $table->dateTime('paid_at')->nullable()->comment('支出时间');
            $table->uuid('staff_id')->nullable()->comment('支出人');
            $table->longText('attachment')->nullable()->comment('附件');
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
        Schema::dropIfExists('paid');
    }
};
