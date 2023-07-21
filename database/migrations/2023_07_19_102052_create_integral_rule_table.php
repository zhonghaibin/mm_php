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
        Schema::create('integral_rule', function (Blueprint $table) {
            $table->comment('积分规则');
            $table->uuid('id')->primary()->comment('uuid');
            $table->uuid('merchant_id')->nullable()->comment('所属商户');
            $table->string('name', 60)->nullable()->comment('积分规则名称');
            $table->uuid('shop_id')->nullable()->index('integral_rule_shop')->comment('所属门店');
            $table->longText('integral_rule')->nullable()->comment('积分规则');
            $table->dateTime('start_date')->nullable()->comment('生效日期');
            $table->dateTime('end_date')->nullable()->comment('失效日期');
            $table->tinyInteger('status')->nullable()->comment('状态');
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
        Schema::dropIfExists('integral_rule');
    }
};
