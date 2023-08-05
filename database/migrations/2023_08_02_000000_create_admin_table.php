<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('admin', function (Blueprint $table) {
            $table->increments('id')->comment('用户ID');
            $table->string('name')->comment('用户名');
            $table->string('avatar')->default('')->comment('用户头像');
            $table->string('email')->unique()->comment('邮箱');
            $table->string('password')->comment('密码');
            $table->rememberToken()->comment('是否记住登录');
            $table->boolean('status')->default(1)->comment('状态 1正常 0限制');
            $table->timestamp('last_login_at')->nullable()->comment('最后登录时间');
            $table->string('last_login_ip')->nullable()->comment('最后登录IP');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin');
    }
};
