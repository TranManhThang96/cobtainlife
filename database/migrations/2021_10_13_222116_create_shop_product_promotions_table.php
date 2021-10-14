<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopProductPromotionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop_product_promotions', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id');
            $table->integer('price_promotion')->default(0)->comment('giá khuyến mãi. Nếu ko có start, end thì lúc nào cũng khuyến mãi');
            $table->dateTime('start')->nullable();
            $table->dateTime('end')->nullable();
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
        Schema::dropIfExists('shop_product_promotions');
    }
}
