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
        Schema::create('vip', function (Blueprint $table) {
            $table->comment('会员表');
            $table->uuid('id')->primary()->comment('uuid');
            $table->uuid('merchant_id')->nullable()->comment('所属商户');
            $table->uuid('shop_id')->nullable()->index('vip_shop')->comment('所属门店');
            $table->string('name', 60)->nullable()->comment('姓名');
            $table->string('phone', 11)->nullable()->comment('手机号');
            $table->string('card_no', 20)->nullable()->comment('实体卡号');
            $table->decimal('money', 10)->nullable()->comment('余额');
            $table->integer('integral')->nullable()->comment('积分');
            $table->decimal('arrears', 10, 2)->nullable()->comment('欠款');
            $table->uuid('source_id')->nullable()->index('vip_source')->comment('来源');
            $table->string('birthday', 20)->nullable()->comment('生日');
            $table->string('consultant', 20)->nullable()->comment('顾问');
            $table->string('cks', 20)->nullable()->comment('专属产康师');
            $table->tinyInteger('is_bind_wx')->nullable()->comment('绑定微信');
            $table->tinyInteger('is_bind_qywx')->nullable()->comment('绑定企业微信');
            $table->uuid('grade_id')->nullable()->index('vip_grade')->comment('会员等级');
            $table->dateTime('expiry_date')->nullable()->comment('会员有效期');
            $table->tinyInteger('status')->nullable()->comment('会员状态');
            $table->tinyInteger('sex')->nullable()->comment('会员性别');
            $table->string('password', 120)->nullable()->comment('会员密码');
            $table->uuid('vip_type')->nullable()->comment('会员类型');
            $table->uuid('referees_id')->nullable()->comment('推荐人');
            $table->dateTime('pregnancy')->nullable()->comment('孕期');
            $table->string('address', 255)->nullable()->comment('会员地址');
            $table->integer('embryo_num')->nullable()->comment('当前胎数');
            $table->dateTime('delivery_date')->nullable()->comment('预产期');
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
        Schema::dropIfExists('vip');
    }
};
