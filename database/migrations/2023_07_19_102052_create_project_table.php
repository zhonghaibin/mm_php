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
        Schema::create('project', function (Blueprint $table) {
            $table->comment('项目表');
            $table->uuid('id')->primary()->comment('uuid');
            $table->uuid('merchant_id')->nullable()->comment('所属商户');
            $table->uuid('project_type_id')->nullable()->index('project_project_type')->comment('项目分类');
            $table->string('name', 60)->nullable()->comment('项目名称');
            $table->uuid('department_id')->nullable()->comment('所属部门');
            $table->decimal('price', 10)->nullable()->comment('统一售价');
            $table->tinyInteger('status')->nullable()->comment('项目状态');
            $table->longText('service_time')->nullable()->comment('服务时长');
            $table->tinyInteger('is_course')->nullable()->comment('是否课程');
            $table->tinyInteger('is_online_appointment')->nullable()->comment('线上可预约');
            $table->decimal('experience_price', 10)->nullable()->comment('项目体验价');
            $table->longText('picture')->nullable()->comment('项目配图');
            $table->text('details')->nullable()->comment('项目详情');
            $table->uuid('shop_id')->nullable()->index('project_shop')->comment('所属门店');
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
        Schema::dropIfExists('project');
    }
};
