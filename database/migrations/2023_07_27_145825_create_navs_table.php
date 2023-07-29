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
        Schema::create('navs', function (Blueprint $table) {
            $table->uuid('id')->primary()->comment('uuid');
            $table->unsignedTinyInteger('type')->default(1)->comment('菜单类型');
            $table->uuid('parent_id')->default(0)->comment('父级ID');
            $table->string('name')->default('')->comment('菜单名');
            $table->string('url')->nullable()->comment('链接');
            $table->unsignedTinyInteger('sort')->default(1)->comment('排序');
            $table->boolean('status')->default(0)->comment('状态');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('navs');
    }
};
