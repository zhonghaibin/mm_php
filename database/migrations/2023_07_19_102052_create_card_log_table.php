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
        Schema::create('card_log', function (Blueprint $table) {
            $table->comment('办卡记录');
            $table->uuid('id')->primary()->comment('uuid');
            $table->uuid('merchant_id')->nullable()->comment('所属商户');
            $table->uuid('shop_id')->nullable()->index('card_bog_shop')->comment('所属门店');
            $table->uuid('vip_id')->nullable()->comment('下单会员');
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
        Schema::dropIfExists('card_log');
    }
};
