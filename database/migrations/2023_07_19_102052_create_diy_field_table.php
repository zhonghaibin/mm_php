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
        Schema::create('diy_field', function (Blueprint $table) {
            $table->comment('自定义字段');
            $table->uuid('id')->comment('uuid');
            $table->uuid('merchant_id')->nullable()->comment('所属商户');
            $table->uuid('shop_id')->nullable()->index('diy_field_shop')->comment('所属门店');
            $table->string('name', 60)->nullable()->comment('现有名称');
            $table->string('diy_name', 60)->nullable()->comment('自定义名称');
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
        Schema::dropIfExists('diy_field');
    }
};
