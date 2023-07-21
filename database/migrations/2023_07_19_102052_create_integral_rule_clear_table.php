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
        Schema::create('integral_rule_clear', function (Blueprint $table) {
            $table->comment('积分清空规则');
            $table->uuid('id')->primary()->comment('uuid');
            $table->uuid('merchant_id')->nullable()->comment('所属商户');
            $table->string('name', 60)->nullable()->comment('积分清零名称');
            $table->longText('clear_rule')->nullable()->comment('清零规则');
            $table->dateTime('clear_at')->nullable()->comment('清零时间');
            $table->dateTime('last_edit_at')->nullable()->comment('最后修改日期');
            $table->dateTime('created_at')->nullable()->comment('首次创建日期');
            $table->uuid('user_id')->nullable()->comment('操作人');
            $table->tinyInteger('status')->nullable()->comment('状态');
            $table->uuid('shop_id')->nullable()->index('integral_rule_clear_shop')->comment('所属门店');
            $table->timestamp('updated_at')->useCurrentOnUpdate()->nullable()->useCurrent()->comment('更新时间');
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
        Schema::dropIfExists('integral_rule_clear');
    }
};
