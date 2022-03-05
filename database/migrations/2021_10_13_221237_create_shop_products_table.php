<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop_products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('alias');
            $table->string('image')->nullable();
            $table->string('keyword')->nullable();
            $table->text('description')->nullable();
            $table->text('content')->nullable();
            $table->string('sku')->nullable();
            $table->integer('brand_id')->nullable();
            $table->integer('supplier_id')->nullable();
            $table->integer('price')->default(0)->comment('giá công khai');
            $table->integer('cost')->default(0)->comment('giá cost');
            $table->integer('stock')->default(0)->comment('số lượng');
            $table->integer('sold')->default(0)->comment('đã bán');
            $table->string('weight_class')->nullable()->comment('gam, kg');
            $table->integer('weight')->nullable()->default(0);
            $table->string('length_class')->nullable()->comment('m, km');
            $table->integer('length')->nullable()->default(0);
            $table->integer('width')->nullable()->default(0);
            $table->integer('height')->nullable()->default(0);
            $table->integer('kind')->default(0)->comment('0:single, 1:bundle, 2:group');
            $table->tinyInteger('status')->default(1)->comment('1: on, 0: off');
            $table->tinyInteger('new_arrival')->default(0)->comment('1: sản phẩm mới về');
            $table->tinyInteger('hot')->default(0)->comment('1: sản phẩm hot');
            $table->integer('sort')->default(1)->comment('thứ tự');
            $table->integer('view')->default(1)->comment('lượt xem');
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
        Schema::dropIfExists('shop_products');
    }
}
