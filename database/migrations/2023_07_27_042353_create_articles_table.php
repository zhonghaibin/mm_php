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
        Schema::create('articles', function (Blueprint $table) {
            $table->uuid('id')->primary()->comment('uuid');
            $table->uuid('category_id')->default(0)->comment('分类id');
            $table->string('title')->comment('标题');
            $table->string('author')->comment('作者');
            $table->char('description')->comment('描述');
            $table->string('keywords')->comment('关键词');
            $table->boolean('status')->default(0)->comment('是否发布 1是 0否');
            $table->boolean('is_top')->default(0)->comment('是否置顶 1是 0否');
            $table->unsignedInteger('click')->default(0)->comment('点击数');
            $table->string('rank')->nullable()->comment('热度');
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
        Schema::dropIfExists('articles');
    }
};
