<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopShippingCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // default: cart, compare: compare
        // bang nay dung de luu gio hang, hoac compare cho use dang đăng nhập
        Schema::create('shop_shipping_carts', function (Blueprint $table) {
            $table->id();
            $table->enum('instance', ['compare', 'default'])->default('default')->comment('default la don hang, compare la so sanh');
            $table->integer('customer_id');
            $table->text('content');
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
        Schema::dropIfExists('shop_shipping_carts');
    }
}
