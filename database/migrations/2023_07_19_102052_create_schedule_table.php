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
        Schema::create('schedule', function (Blueprint $table) {
            $table->comment('排班表');
            $table->uuid('id')->primary()->comment('uuid');
            $table->uuid('merchant_id')->nullable()->comment('所属商户');
            $table->uuid('shop_id')->nullable()->index('schedule_shop')->comment('所属门店');
            $table->uuid('staff_id')->nullable()->comment('所属员工');
            $table->dateTime('date')->nullable()->comment('排班时间');
            $table->longText('content')->nullable()->comment('排班状态');
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
        Schema::dropIfExists('schedule');
    }
};
