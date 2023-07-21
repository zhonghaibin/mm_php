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
        Schema::create('vip_project_appointment', function (Blueprint $table) {
            $table->comment('会员项目预约表');
            $table->uuid('id')->primary()->comment('uuid');
            $table->uuid('merchant_id')->nullable()->comment('所属商户');
            $table->uuid('shop_id')->nullable()->index('vip_project_appointment_shop')->comment('所属门店');
            $table->uuid('vip_id')->nullable()->comment('所属会员');
            $table->uuid('staff_id')->nullable()->comment('所属员工');
            $table->uuid('project_id')->nullable()->comment('project_id');
            $table->dateTime('date')->nullable()->comment('所属日期');
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
        Schema::dropIfExists('vip_project_appointment');
    }
};
