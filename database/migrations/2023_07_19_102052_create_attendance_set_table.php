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
        Schema::create('attendance_set', function (Blueprint $table) {
            $table->comment('考勤设置');
            $table->uuid('id')->primary()->comment('uuid');
            $table->uuid('merchant_id')->nullable()->comment('所属商户');
            $table->uuid('shop_id')->nullable()->index('attendance_set_shop')->comment('所属门店');
            $table->string('lnt', 60)->nullable()->comment('维度');
            $table->string('lat', 60)->nullable()->comment('经度');
            $table->integer('meter')->nullable()->comment('门店范围');
            $table->tinyInteger('is_can_late')->nullable()->comment('是否允许迟到');
            $table->integer('can_late_minute')->nullable()->comment('上班允许迟到n分钟');
            $table->integer('can_leave_early_minute')->nullable()->comment('下班允许早退n分钟');
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
        Schema::dropIfExists('attendance_set');
    }
};
