<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop_categories', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('alias');
            $table->string('image')->nullable();
            $table->integer('parent')->default(0)->comment('danh mục cha');
            $table->text('description')->nullable();
            $table->tinyInteger('top')->default(0)->comment('Lên trang chủ');
            $table->tinyInteger('status')->default(1)->comment('1: on, 0: off');
            $table->integer('sort')->default(1)->comment('thứ tự');
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('shop_categories');
    }
}
