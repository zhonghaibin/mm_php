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
        Schema::create('package', function (Blueprint $table) {
            $table->comment('套餐');
            $table->uuid('id')->primary()->comment('uuid');
            $table->uuid('merchant_id')->nullable()->comment('所属商户');
            $table->string('name', 60)->nullable()->comment('套餐名称');
            $table->uuid('shop_id')->nullable()->index('package_shop')->comment('所属门店');
            $table->uuid('套餐分类')->nullable()->index('package_package_type')->comment('套餐分类');
            $table->decimal('price', 10)->nullable()->comment('统一售价');
            $table->longText('content')->nullable()->comment('套餐内容');
            $table->longText('give')->nullable()->comment('购卡赠送');
            $table->longText('status')->nullable()->comment('套餐状态');
            $table->longText('picture')->nullable()->comment('套餐配图');
            $table->text('details')->nullable()->comment('套餐详情');
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
        Schema::dropIfExists('package');
    }
};
