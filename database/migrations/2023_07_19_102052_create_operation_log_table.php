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
        Schema::create('operation_log', function (Blueprint $table) {
            $table->comment('操作记录');
            $table->uuid('id')->primary()->comment('uuid');
            $table->uuid('merchant_id')->nullable()->comment('所属商户');
            $table->tinyInteger('event_type')->nullable()->comment('事件类型');
            $table->longText('content')->nullable()->comment('操作事件');
            $table->dateTime('created_at')->nullable()->comment('操作时间');
            $table->uuid('shop_id')->nullable()->index('operation_log_shop')->comment('操作门店');
            $table->uuid('user_id')->nullable()->comment('操作人');
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
        Schema::dropIfExists('operation_log');
    }
};
