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
        Schema::create('feeds', function (Blueprint $table) {
            $table->uuid('id')->primary()->comment('uuid');
            $table->unsignedTinyInteger('target_type')->comment('类型0文章1单页');
            $table->uuid('target_id')->comment('关联类型ID');
            $table->mediumText('content')->comment('markdown内容');
            $table->mediumText('html')->comment('markdown转的html内容');
            $table->timestamps();
            $table->unique(['target_type', 'target_id'], 'idx_type_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('feeds');
    }
};
