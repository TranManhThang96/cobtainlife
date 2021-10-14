<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopProductAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop_product_attributes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('attribute_group_id');
            $table->integer('product_id');
            $table->integer('add_price')->default(0)->comment('cộng thêm giá');
            $table->tinyInteger('status')->default(1)->comment('1: on, 0: off');
            $table->integer('sort')->default(1)->comment('thứ tự');
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
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
        Schema::dropIfExists('shop_product_attributes');
    }
}
