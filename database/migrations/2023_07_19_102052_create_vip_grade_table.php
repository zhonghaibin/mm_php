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
        Schema::create('vip_grade', function (Blueprint $table) {
            $table->comment('会员等级');
            $table->uuid('id')->primary()->comment('uuid');
            $table->uuid('merchant_id')->nullable()->comment('所属商户');
            $table->uuid('shop_id')->nullable()->index('vip_grade_shop')->comment('所属门店');
            $table->integer('sort')->nullable()->comment('优先级');
            $table->string('name', 60)->nullable()->comment('会员级别名称');
            $table->longText('upgrade_rule')->nullable()->comment('升级条件');
            $table->longText('effective_at')->nullable()->comment('生效时段');
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
        Schema::dropIfExists('vip_grade');
    }
};
